<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Atm;
use Illuminate\Http\Request;

class AtmReportController extends Controller
{
    // Get all ATMs, optionally filtered
    public function index(Request $request)
    {
        $query = Atm::query();

        if ($request->branch_id) {
            $query->where('branch_id', $request->branch_id);
        }

        if ($request->networkType) {
            $query->where('networkType', $request->networkType);
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        return response()->json($query->get());
    }

    // Summary report
    public function summary()
    {
        $total = Atm::count();
        $byNetwork = Atm::select('networkType')
            ->selectRaw('count(*) as count')
            ->groupBy('networkType')
            ->get();

        $byBranch = Atm::select('branch_id')
            ->selectRaw('count(*) as count')
            ->groupBy('branch_id')
            ->get();

        return response()->json([
            'total_atms' => $total,
            'by_network' => $byNetwork,
            'by_branch' => $byBranch
        ]);
    }
}
