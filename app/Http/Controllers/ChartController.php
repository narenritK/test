<?php

namespace App\Http\Controllers;

use App\Models\ChartModel;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function barChart(Request $request)
    {
        $selectedMonth = $request->input('selected_month', now()->format('m'));
        $selectedYear = $request->input('selected_year', now()->format('Y'));

        $dataFromDatabase = ChartModel::whereYear('form_date', $selectedYear)
            ->whereMonth('form_date', $selectedMonth)
            ->orderBy('form_date', 'asc') 

            ->get();

        $labels = $dataFromDatabase->pluck('form_date')->map(function ($date) {
            return date('วันที่ j', strtotime($date));
        })->toArray();

        $values = $dataFromDatabase->pluck('form_code')->toArray();

        return view('bar-chart', compact('labels', 'values', 'selectedMonth', 'selectedYear'));
    }
}
