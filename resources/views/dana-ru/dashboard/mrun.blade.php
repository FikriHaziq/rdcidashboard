@component('layouts.app')
    @slot('module')
        RU Fund Allocation
    @endslot
    @push('custom-css')
        <link href="{{ asset('theme/css/dashboard.css') }}?v=5" rel="stylesheet" />
    @endpush
    @slot('content')
        <div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
            <h2 class="fs-lg fw-medium truncate me-5">
                RU STRATEGIC FOCUS AREAS
            </h2>
        </div>
        @include('dana-ru.dashboard.year-filter', ['route' => 'dana-ru.dashboard.mrun'])
        <div class="intro-y row mt-5">
            <div class="col-12">
                <div class="grid grid-cols-12 gap-5">
                    @foreach ($components as $component)
                        @php($card = $dashboard['cards'][$component->code])
                        <div class="g-col-12 g-col-md-6 g-col-xl-3">
                            <x-dru.dashboard-card :theme="$styles[$component->code]['theme'] ?? 'info'"
                                :title="$component->code . ' (' . $component->description_1 . ')'"
                                :total-allocation="'RM ' . number_format($card['total_allocation'] / 1000000, 2) . 'M'"
                                :total-programmes="$card['total_programmes']"
                                :avg-allocation-share="number_format($card['allocation_share'], 2) . '%'"
                                :avg-allocation-programme="'RM ' . number_format($card['avg_allocation_programme'] / 1000000, 2) . 'M'"
                                :total-programmes-share="number_format($card['programmes_share'], 2) . '%'" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="intro-x mt-5">
            <div class="grid grid-cols-12 gap-3">
                <div class="g-col-12 g-col-lg-6 card">
                    <h5 class="chart-title text-center p-2">TOTAL ALLOCATION BY YEAR</h5>
                    <x-dru.chart type="mixed" chart-id="total_allocation_by_year" :colors="[
                        'bar' => '#25d1e3',
                        'line' => '#1597a5',
                    ]" :infos="$dashboard['total_by_year']" :labels="$dashboard['years']" />
                </div>
                <div class="g-col-12 g-col-lg-6 card">
                    <h5 class="chart-title text-center p-2">ALLOCATION COMPOSITION BY YEAR (%)</h5>
                    <x-dru.chart type="stacked" chart-id="allocation_composition_by_year" :colors="$chart_colors"
                        :infos="$dashboard['composition']" :labels="$dashboard['years']" />
                </div>
            </div>
            <div class="card w-full mt-5">
                <h5 class="chart-title text-center p-2">PROGRAMMES & ALLOCATION TREND</h5>
                <div class="grid grid-cols-12 gap-3">
                    @foreach ($components as $component)
                        <div class="g-col-12 g-col-md-6">
                            <x-dru.chart :title="$component->code . ' (' . $component->description_1 . ')'" type="mixed"
                                :chart-id="strtolower($component->code) . '_allocation'" :colors="[
                                    'bar' => $styles[$component->code]['bar'] ?? '#25d1e3',
                                    'line' => $styles[$component->code]['line'] ?? '#1597a5',
                                ]"
                                :infos="$dashboard['trends'][$component->code]" :labels="$dashboard['years']" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-12 gap-3 mt-5">
                <div class="g-col-12 card">
                    <h5 class="chart-title text-center p-2">TOP 10 FUNDING PROGRAMMES BY ALLOCATION</h5>
                    <x-dru.chart type="basic_bar" chart-id="top_10_fund" :colors="['#1597a5']" :infos="$dashboard['top_programmes']" />
                </div>
            </div>
        </div>
    @endslot
    @push('custom-js')
        @parent
    @endpush
@endcomponent
