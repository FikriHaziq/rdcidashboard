<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GraphDanaRUTrait;
use App\Models\MasterList\MasterlistDruAllocation;

class DashboardController extends Controller
{
    use GraphDanaRUTrait;

    public function bpki(Request $request)
    {
        // Card theme & chart colours follow the dashboard.css themes
        $styles = [
            'GP' => ['theme' => 'success', 'bar' => '#17db79', 'line' => '#119c58'],
            'DO' => ['theme' => 'info', 'bar' => '#3d7def', 'line' => '#0f4db8'],
            'PP' => ['theme' => 'warning', 'bar' => '#ffab3b', 'line' => '#ff9811'],
        ];
        $components = getBpkiList()->sortBy(function($component) use ($styles) {
            return array_search($component->code, array_keys($styles));
        })->values();

        [$year_list, $year_from, $year_to] = $this->yearFilter($request);
        $dashboard = $this->allocationDashboard('bpki_id', $components, $year_from, $year_to);
        $chart_colors = $components->map(function($component) use ($styles) { return $styles[$component->code]['line'] ?? '#1597a5'; })->values();

        return view('dana-ru.dashboard.bpki', compact('components', 'styles', 'chart_colors', 'year_list', 'year_from', 'year_to', 'dashboard'));
    }

    public function mrun(Request $request)
    {
        $styles = [
            'TD' => ['theme' => 'secondary', 'bar' => '#9674d2', 'line' => '#6f42c1'],
            'RP' => ['theme' => 'info', 'bar' => '#3d7def', 'line' => '#0f4db8'],
            'BGC' => ['theme' => 'warning', 'bar' => '#ffab3b', 'line' => '#ff9811'],
            'WC' => ['theme' => 'success', 'bar' => '#17db79', 'line' => '#119c58'],
        ];
        $components = getMrunList()->sortBy(function($component) use ($styles) {
            return array_search($component->code, array_keys($styles));
        })->values();

        [$year_list, $year_from, $year_to] = $this->yearFilter($request);
        $dashboard = $this->allocationDashboard('program_id', $components, $year_from, $year_to);
        $chart_colors = $components->map(function($component) use ($styles) { return $styles[$component->code]['line'] ?? '#1597a5'; })->values();

        return view('dana-ru.dashboard.mrun', compact('components', 'styles', 'chart_colors', 'year_list', 'year_from', 'year_to', 'dashboard'));
    }

    // Default to the latest 4 years in masterlist_dru_allocations, ending at the latest year with net allocation
    private function yearFilter(Request $request)
    {
        $year_list = MasterlistDruAllocation::distinct()->orderBy('year')->pluck('year')->toArray();
        $max_year = MasterlistDruAllocation::groupBy('year')->havingRaw('SUM(amount) <> 0')->pluck('year')->max() ??(end($year_list) ?: (int)date('Y'));
        $min_year = reset($year_list) ?: $max_year;

        $year_to = (int)($request->year_to ?? $max_year);
        $year_from = (int)($request->year_from ?? max($min_year, $year_to - 3));
        if($year_from > $year_to){
            [$year_from, $year_to] = [$year_to, $year_from];
        }

        return [$year_list, $year_from, $year_to];
    }
}
