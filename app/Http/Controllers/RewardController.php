<?php

namespace App\Http\Controllers;

use App\Models\RowData;
use App\Models\Winner;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    public function index(){
        $campaign = Campaign::where('status','active')->first();
        return view('reward', compact('campaign'));
    }


    public function check(Request $request)
    {

        if(!$request->code){
            return response()->json(['status'=>'error','message'=>'Coupon missing']);
        }

        $row = RowData::where('unique_code',$request->code)->first();

        if(!$row){
            return response()->json(['status'=>'error','message'=>'Invalid coupon']);
        }

        if($row->reward_status === 'used'){
            return response()->json([
                'status'=>'error',
                'message'=>"Already used by {$row->used_by} ({$row->used_by_phone})"
            ]);
        }

        // IMPORTANT: use getRawOriginal
        $expiry = Carbon::parse($row->getRawOriginal('expiry_date'));
        if(now()->gt($expiry)){
            return response()->json(['status'=>'error','message'=>'Coupon expired']);
        }

        return response()->json([
            'status'=>'success',
            'amount'=>$row->amount
        ]);
    }



public function claim(Request $request)
{

    $request->validate([
        'full_name'      => 'required|string',
        'phone_number'   => 'required|string',
        'upi'            => 'required|string',
        'coupon_code'    => 'required|string',
        'customer_photo' => 'nullable|image|max:2048',
        'product_photo'  => 'nullable|image|max:2048',
    ]);

    DB::beginTransaction();

    try {

        /* ================= COUPON / ROWDATA FIND ================= */
        $row = RowData::where('unique_code', $request->coupon_code)->first();

        if (!$row) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid coupon'
            ]);
        }

        if ($row->reward_status === 'used') {
            return response()->json([
                'status'  => 'error',
                'message' => "Already claimed by {$row->used_by}"
            ]);
        }

        /* ================= CAMPAIGN CHECK ================= */
        $today = now()->toDateString();
        $campaign = Campaign::where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$campaign) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Campaign expired'
            ]);
        }

        /* ================= EXPIRY CHECK ================= */
        $expiry = Carbon::parse($row->getRawOriginal('expiry_date'));
        if (now()->gt($expiry)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Coupon expired'
            ]);
        }

        /* ================= CREATE WINNER (AMOUNT FROM ROWDATA) ================= */
        $winner = Winner::create([
            'full_name'    => $request->full_name,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'upi'          => $request->upi,
            'product_name' => $request->product_name,
            'pin_code'     => $request->pin_code,
            'coupon_code'  => $request->coupon_code,

            // 🔥 YAHI MAIN CHEEZ
            'amount'       => $row->amount,
            'status'       =>'pending',
        ]);

        /* ================= SAVE IMAGES ================= */
        if ($request->hasFile('customer_photo')) {
            $winner
                ->addMediaFromRequest('customer_photo')
                ->toMediaCollection('customer_photo');
        }

        if ($request->hasFile('product_photo')) {
            $winner
                ->addMediaFromRequest('product_photo')
                ->toMediaCollection('product_photo');
        }

        /* ================= ATTACH COUPON ================= */
        $winner->cupon_numbers()->attach($row->id);

        /* ================= UPDATE ROWDATA ================= */
        $row->update([
            'reward_status' => 'used',
            'used_by'       => $request->full_name,
            'used_by_phone' => $request->phone_number,
        ]);

        DB::commit();

        return redirect()
            ->route('thankyou')
            ->with('success', '🎉 Reward claimed successfully');

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status'  => 'error',
            'message' => 'Something went wrong. Please try again.'
        ], 500);
    }
}
public function status($coupon)
{
    $winner = Winner::where('coupon_code', $coupon)
        ->with(['media'])
        ->first();

    if (!$winner) {
        return response()->json([
            'status' => 'error',
            'message' => 'No record found'
        ]);
    }

    return response()->json([
        'status' => 'success',
        'data' => [
            'full_name'    => $winner->full_name,
            'phone_number' => $winner->phone_number,
            'email'        => $winner->email,
            'upi'          => $winner->upi,
            'amount'       => $winner->amount,
            'claim_status' => $winner->status,
            'created_at'   => $winner->created_at->format('d M Y, h:i A'),
            'updated_at'   => $winner->updated_at->format('d M Y, h:i A'),
            'customer_photo' => $winner->customer_photo?->url,
            'product_photo'  => $winner->product_photo->first()?->url,
        ]
    ]);
}


}
