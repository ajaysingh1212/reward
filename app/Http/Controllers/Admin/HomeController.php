<?php

namespace App\Http\Controllers\Admin;
use App\Models\RowData;
use App\Models\Winner;
use Carbon\Carbon;
use Illuminate\Http\Request;
class HomeController
{
public function index()
    {
        /* COUNTS */
        $totalRowData   = RowData::count();
        $usedRowData    = RowData::where('reward_status','used')->count();
        $unusedRowData  = RowData::where('reward_status','unused')->count();
        $totalAmount    = RowData::sum('amount');

        $totalWinners      = Winner::count();
        $pendingAmount     = Winner::where('status','pending')->sum('amount');
        $processingAmount  = Winner::where('status','processing')->sum('amount');
        $totalWinnerAmount = Winner::sum('amount');

        /* DEFAULT = TOTAL */
        $rowChart = RowData::selectRaw('DATE(created_at) date, COUNT(*) total')
            ->groupBy('date')->orderBy('date')->get();

        $winnerChart = Winner::selectRaw('DATE(created_at) date, SUM(amount) total')
            ->groupBy('date')->orderBy('date')->get();

        $winnerStartDate = $winnerChart->first()?->date;

        return view('home', compact(
            'totalRowData','usedRowData','unusedRowData','totalAmount',
            'totalWinners','pendingAmount','processingAmount','totalWinnerAmount',
            'rowChart','winnerChart','winnerStartDate'
        ));
    }

    /* ================= ROW DATA AJAX ================= */
    public function rowDataAjax(Request $request)
    {
        [$from,$to] = $this->resolveRange($request->range);

        $data = RowData::whereBetween('created_at',[$from,$to])
            ->selectRaw('DATE(created_at) date, COUNT(*) total')
            ->groupBy('date')->orderBy('date')->get();

        return response()->json($data);
    }

    /* ================= WINNER AJAX ================= */
    public function winnerDataAjax(Request $request)
    {
        [$from,$to] = $this->resolveRange($request->range);

        $data = Winner::whereBetween('created_at',[$from,$to])
            ->selectRaw('DATE(created_at) date, SUM(amount) total')
            ->groupBy('date')->orderBy('date')->get();

        return response()->json($data);
    }

    /* ================= RANGE RESOLVER ================= */
    private function resolveRange($range)
    {
        $to = Carbon::now();
        $from = match($range){
            'today'     => Carbon::today(),
            'week'      => Carbon::now()->startOfWeek(),
            'month'     => Carbon::now()->startOfMonth(),
            '3month'    => Carbon::now()->subMonths(3),
            '6month'    => Carbon::now()->subMonths(6),
            'year'      => Carbon::now()->subYear(),
            default     => Carbon::create(2000,1,1), // TOTAL
        };
        return [$from,$to];
    }

}
