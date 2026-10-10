@component('layouts.app')
    @slot('module')
        RU Fund Allocation
    @endslot
    @push('custom-css')
        <link href="{{ asset('theme/css/dashboard.css') }}" rel="stylesheet" />
    @endpush
    @slot('content')
        <div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
            <h2 class="fs-lg fw-medium truncate me-5">
                RU STRATEGIC FOCUS AREAS
            </h2>
        </div>
        <div class="intro-y row mt-5">
            <div class="col-12">
                <div class="grid grid-cols-12 gap-5">
                    <div class="g-col-3">
                        <x-dru.dashboard-card theme="secondary" title="TD (TALENT DEVELOPMENT)" total-allocation="RM 1M"
                            total-programmes="32" avg-allocation-share="55.62%" avg-allocation-programme="RM 1.81M"
                            total-programmes-share="35.16%" />
                    </div>
                    <div class="g-col-3">
                        <x-dru.dashboard-card theme="info" title="RP (RESEARCH PROMINENCE)" total-allocation="RM 1M"
                            total-programmes="32" avg-allocation-share="55.62%" avg-allocation-programme="RM 1.81M"
                            total-programmes-share="35.16%" />
                    </div>
                    <div class="g-col-3">
                        <x-dru.dashboard-card theme="warning" title="BGC (BRIDGING THE GRAND CHALLENGE)"
                            total-allocation="RM 1M" total-programmes="32" avg-allocation-share="55.62%"
                            avg-allocation-programme="RM 1.81M" total-programmes-share="35.16%" />
                    </div>
                    <div class="g-col-3">
                        <x-dru.dashboard-card theme="success" title="WC (WEALTH CREATION)" total-allocation="RM 1M"
                            total-programmes="32" avg-allocation-share="55.62%" avg-allocation-programme="RM 1.81M"
                            total-programmes-share="35.16%" />
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-x mt-5">
            <div class="grid grid-cols-12 gap-3">
                <div class="g-col-3 card">
                    <h5 class="chart-title text-center p-2">TOTAL ALLOCATION BY YEAR</h5>
                    <x-dru.chart type="mixed" chart-id="total_allocation_by_year" :colors="[
                        'bar' => '#25d1e3',
                        'line' => '#1597a5',
                    ]" :infos="[
                        'bar' => [17, 15, 37, 22],
                        'line' => [25180874.47, 24955737.94, 36950800.0, 12341495.25],
                    ]" />
                </div>
                <div class="g-col-3 card">
                    <h5 class="chart-title text-center p-2">ALLOCATION COMPOSITION BY YEAR (%)</h5>
                    <x-dru.chart type="stacked" chart-id="allocation_composition_by_year" :colors="['#ff9811', '#0f4db8', '#6f42c1', '#119c58']" :infos="[
                        [
                            'name' => 'BGC',
                            'data' => [6, 5, 14, 7],
                        ],
                        [
                            'name' => 'RP',
                            'data' => [8, 7, 18, 14],
                        ],
                        [
                            'name' => 'TD',
                            'data' => [3, 3, 5, 1],
                        ],
                        [
                            'name' => 'WC',
                            'data' => [3, 3, 5, 1],
                        ],
                    ]" />
                </div>
                <div class="g-col-6 card">
                    <h5 class="chart-title text-center p-2">TOP 10 FUNDING PROGRAMMES BY ALLOCATION</h5>
                    <x-dru.chart type="basic_bar" chart-id="top_10_fund" :colors="['#1597a5']" :infos="[
                        'categories' => [
                            'GERAN UNIVERSITI PENYELIDIKAN (GUP)',
                            'PELANTIKAN PASCA DOCTORAL',
                            'INSENTIF PENERBITAN PENYELIDIKAN - JURNAL BERINDEKS',
                            'GERAN HITECH (F4+)',
                            'PENYELENGGARAAN MAKMAL PENYELIDIKAN',
                            'PENYELENGGARAAN MAKMAL PENYELIDIKAN',
                            'PENYELENGGARAAN MAKMAL PENYELIDIKAN',
                            'PENYELENGGARAAN MAKMAL PENYELIDIKAN',
                            'PENYELENGGARAAN MAKMAL PENYELIDIKAN',
                            'PENYELENGGARAAN MAKMAL PENYELIDIKAN',
                        ],
                        'values' => [
                            [
                                'name' => 'Allocation (RM)',
                                'data' => [
                                    35250000,
                                    11430000,
                                    5150000,
                                    5000000,
                                    4840000,
                                    4000000,
                                    3660000,
                                    3320000,
                                    3000000,
                                    2400000,
                                ],
                            ],
                        ],
                    ]" />
                </div>
            </div>
            <div class="card w-full mt-5">
                <h5 class="chart-title text-center p-2">PROGRAMMES & ALLOCATION TREND</h5>
                <div class="grid grid-cols-12 gap-3">
                    <div class="g-col-3">
                        <x-dru.chart title="TD (TALENT DEVELOPMENT)" type="mixed" chart-id="td_allocation" :colors="[
                            'bar' => '#9674d2',
                            'line' => '#6f42c1',
                        ]"
                            :infos="[
                                'bar' => [17, 15, 37, 22],
                                'line' => [25180874.47, 24955737.94, 36950800.0, 12341495.25],
                            ]" />
                    </div>
                    <div class="g-col-3">
                        <x-dru.chart title="RP (RESEARCH PROMINENCE)" type="mixed" chart-id="rp_allocation" :colors="[
                            'bar' => '#3d7def',
                            'line' => '#0f4db8',
                        ]"
                            :infos="[
                                'bar' => [17, 15, 37, 22],
                                'line' => [25180874.47, 24955737.94, 36950800.0, 12341495.25],
                            ]" />
                    </div>
                    <div class="g-col-3">
                        <x-dru.chart title="BGC (BRIDGING THE GRAND CHALLENGE)" type="mixed" chart-id="bgc_allocation" :colors="[
                            'bar' => '#ffab3b',
                            'line' => '#ff9811',
                        ]"
                            :infos="[
                                'bar' => [17, 15, 37, 22],
                                'line' => [25180874.47, 24955737.94, 36950800.0, 12341495.25],
                            ]" />
                    </div>
                    <div class="g-col-3">
                        <x-dru.chart title="WC (WEALTH CREATION)" type="mixed" chart-id="wc_allocation"
                            :colors="[
                                'bar' => '#17db79',
                                'line' => '#119c58',
                            ]" :infos="[
                                'bar' => [17, 15, 37, 22],
                                'line' => [25180874.47, 24955737.94, 36950800.0, 12341495.25],
                            ]" />
                    </div>
                </div>
            </div>
        </div>
    @endslot
    @push('custom-js')
        @parent
    @endpush
@endcomponent
