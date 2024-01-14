<?php

namespace App\Http\Controllers;

use App\Models\ChartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

        if ($request->ajax()) {
            // If it's an AJAX request, return JSON data
            return Response::json([
                'labels' => $labels,
                'monthLabel' => date('F', mktime(0, 0, 0, $selectedMonth, 1)),
                'values' => $values,
            ]);
        } else {
            // If it's a regular request, return the view
            return view('bar-chart', compact('labels', 'values', 'selectedMonth', 'selectedYear'));
        }
    }
}
