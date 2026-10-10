<div id="{{ $chartId }}" class="pt-3"></div>
@once
    @push('custom-js')
        <script src="{{ asset('theme/js/apexchart.js') }}"></script>
    @endpush
@endonce

@push('custom-js')
    <script>
        @if ($type === 'column')
            (function() {
                const options = {
                    @if ($title)
                        title: {
                            text: @json($title),
                            align: 'center'
                        },
                    @endif
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center'
                    },
                    series: @json($infos),
                    colors: @json($colors),
                    chart: {
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    grid: {
                        show: false
                    },
                    annotations: {
                        yaxis: [{
                            y: 0,
                            borderColor: '#999',
                            strokeDashArray: 0,
                            borderWidth: 1
                        }]
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -20,
                        formatter: function(val) {
                            if (val > 0) {
                                return '+' + val + 'pp';
                            } else {
                                return val + 'pp';
                            }
                        },
                        style: {
                            fontSize: '12px',
                            fontWeight: 'normal',
                            colors: [
                                function() {
                                    return '#000';
                                }
                            ]
                        },
                        background: {
                            enabled: false
                        },
                        dropShadow: {
                            enabled: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                position: 'top'
                            }
                        }
                    },
                    labels: [
                        2022, 2023, 2024, 2025
                    ],
                    yaxis: {
                        title: {
                            text: 'Percentage Point (pp)',
                        },
                        labels: {
                            formatter: function(val) {
                                if (val > 0) {
                                    return '+' + val + 'pp';
                                } else {
                                    return val + 'pp';
                                }
                            }
                        }
                    },
                    xaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                if (val > 0) {
                                    return '+' + val + 'pp';
                                } else {
                                    return val + 'pp';
                                }
                            }
                        },
                    }
                };

                const chart = new window.ApexCharts(document.querySelector('#{{ $chartId }}'), options)
                chart.render()
            })();
        @elseif ($type === 'mixed')
            (function() {
                const options = {
                    @if ($title)
                        title: {
                            text: @json($title),
                            align: 'center'
                        },
                    @endif
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center',
                    },
                    series: [{
                            name: 'No. of Programmes',
                            type: 'column',
                            data: @json($infos['bar']),
                        },
                        {
                            name: 'Allocation',
                            type: 'line',
                            data: @json($infos['line']),
                        },
                    ],
                    colors: [
                        @json($colors['bar']),
                        @json($colors['line'])
                    ],
                    chart: {
                        type: 'line',
                        toolbar: {
                            show: false
                        }
                    },
                    grid: {
                        show: false
                    },
                    stroke: {
                        width: [0, 4],
                    },
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [0, 1],
                        offsetY: -8,
                        formatter: function(val, opts) {
                            // Bar - No. of Programmes
                            if (opts.seriesIndex === 0) {
                                return val;
                            }

                            // Line - Allocation
                            if (opts.seriesIndex === 1) {
                                return val.toLocaleString('en-MY', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        },
                        style: {
                            fontSize: '9px',
                            fontWeight: 'normal',
                            colors: [
                                function({
                                    seriesIndex
                                }) {
                                    // Bar = white, Line = black
                                    return seriesIndex === 0 ? '#fff' : '#000';
                                }
                            ]
                        },
                        background: {
                            enabled: false
                        },
                        dropShadow: {
                            enabled: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                position: 'center'
                            }
                        }
                    },
                    labels: [
                        2022, 2023, 2024, 2025
                    ],
                    yaxis: [{
                            title: {
                                text: 'No. of Programmes',
                            },
                            labels: {
                                formatter: function(val) {
                                    return Math.round(val);
                                }
                            }
                        },
                        {
                            opposite: true,
                            title: {
                                text: 'RM million',
                            },
                            labels: {
                                formatter: function(val) {
                                    return 'RM ' + (val / 1000000).toFixed(2) + 'M';
                                },
                            },
                        },
                    ],
                    tooltip: {
                        y: {
                            formatter: function(val, opts) {
                                // Allocation series
                                if (opts.seriesIndex === 1) {
                                    return 'RM ' + val.toLocaleString('en-MY', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                }
                                // No. of Programmes series
                                return val;
                            }
                        }
                    },
                }

                const chart = new window.ApexCharts(document.querySelector('#{{ $chartId }}'), options)
                chart.render()
            })();
        @elseif ($type === 'stacked')
            (function() {
                var options = {
                    @if ($title)
                        title: {
                            text: @json($title),
                            align: 'center'
                        },
                    @endif
                    series: @json($infos),
                    chart: {
                        type: 'bar',
                        stacked: true,
                        stackType: '100%',
                        toolbar: {
                            show: false
                        }
                    },
                    colors: @json($colors),
                    grid: {
                        show: false
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center'
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom',
                                offsetX: -10,
                                offsetY: 0,
                            },
                        },
                    }, ],
                    xaxis: {
                        categories: [
                            2022, 2023, 2024, 2025
                        ],
                    },
                    yaxis: [{
                        title: {
                            text: '% of Allocation',
                        }
                    }],
                    fill: {
                        opacity: 1,
                    },
                }

                var chart = new ApexCharts(document.querySelector('#{{ $chartId }}'), options)
                chart.render()
            })();
        @elseif ($type === 'basic_bar')
            (function() {
                var options = {
                    @if ($title)
                        title: {
                            text: @json($title),
                            align: 'center'
                        },
                    @endif
                    series: @json($infos['values']),
                    chart: {
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return 'RM ' + (val / 1000000).toFixed(2) + 'M';
                        },
                        style: {
                            fontSize: '9px',
                            fontWeight: 'normal',
                            colors: [
                                function() {
                                    return '#000';
                                }
                            ]
                        },
                        background: {
                            enabled: false
                        },
                        dropShadow: {
                            enabled: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        },
                    },
                    colors: @json($colors),
                    xaxis: {
                        categories: @json($infos['categories']),
                        labels: {
                            formatter: function(val) {
                                return 'RM ' + (val / 1000000).toFixed(2) + 'M';
                            },
                        },
                    },
                    tooltip: {
                        x: {
                            formatter: function(val) {
                                return 'RM ' + val.toLocaleString('en-MY', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        }
                    },
                }

                var chart = new ApexCharts(document.querySelector('#{{ $chartId }}'), options)
                chart.render()
            })();
        @endif
    </script>
@endpush
