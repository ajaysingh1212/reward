<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RowData;
use App\Models\Winner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /* ---------------- ROW DATA COUNTS ---------------- */

        $totalRowData   = RowData::count();
        $usedRowData    = RowData::where('reward_status', 'used')->count();
        $unusedRowData  = RowData::where('reward_status', 'unused')->count();
        $totalAmount    = RowData::sum('amount');

        /* ---------------- WINNER COUNTS ---------------- */

        $totalWinners      = Winner::count();
        $pendingAmount     = Winner::where('status', 'pending')->sum('amount');
        $processingAmount  = Winner::where('status', 'processing')->sum('amount');
        $totalWinnerAmount = Winner::sum('amount');

        /* ---------------- DATE FILTER ---------------- */

        $from = $request->from ? Carbon::parse($request->from) : null;
        $to   = $request->to ? Carbon::parse($request->to) : null;

        $rowDataQuery = RowData::query();
        $winnerQuery  = Winner::query();

        if ($from && $to) {
            $rowDataQuery->whereBetween('created_at', [$from, $to]);
            $winnerQuery->whereBetween('created_at', [$from, $to]);
        }

        /* ---------------- CHART DATA ---------------- */

        $rowChart = $rowDataQuery
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $winnerChart = $winnerQuery
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('home', compact(
            'totalRowData',
            'usedRowData',
            'unusedRowData',
            'totalAmount',
            'totalWinners',
            'pendingAmount',
            'processingAmount',
            'totalWinnerAmount',
            'rowChart',
            'winnerChart'
        ));
    }
}
