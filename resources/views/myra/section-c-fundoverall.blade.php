@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section C: Quantity and Quality of Research @endslot
@slot("trimodule") Funding @endslot
@slot("trimoduleLink") myra.section-c @endslot
@section('custom-css')
<style>
    .active-tab {
        background-color:white;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }

    .inactive-tab {
        opacity: 0.5;
        background-color:rgb(193, 193, 193);
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }
</style>
@endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section C: Quantity and Quality of Research
    </h2>
</div>
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-c/FUNDING-ALL"/>

<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-c', ['tabs'=>'PUBLICATION-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Publication</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-c', ['tabs'=>'FUNDING-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Funding</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            @if ($faculty)
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW PUBLIC FUND (UNIVERSITY) APPROVED</span><br><canvas id="bar5"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW PUBLIC FUND (NATIONAL) APPROVED</span><br><canvas id="bar6"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW PRIVATE FUND APPROVED</span><br><canvas id="bar7"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW INTERNATIONAL FUND APPROVED</span><br><canvas id="bar8"></canvas></div>
            </div>
            @else
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NEW FUNDING APPROVED</span><br><canvas id="bar1"></canvas></div>
            </div>
            @endif
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">AMOUNT RECEIVED FOR PUBLIC FUND</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">AMOUNT RECEIVED FOR PRIVATE FUND</span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">AMOUNT RECEIVED FOR INTERNATIONAL FUND</span><br><canvas id="bar4"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var data = {!! json_encode($data) !!};

    const basicOptions = {
        plugins: {
            legend: {
                display: false
            },
            datalabels: {
                formatter: (value, ctx) => {
                    return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                },
                color: 'rgb(0, 0, 0)',
            }
        },
        scales: {
            x: {
                grid: {
                display: false
                },
                stacked: true,
            },
            y: {
                grid: {
                display: false
                },
                beginAtZero: true,
                ticks: {
                    callback: (value, index, values) => {
                        return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                    }
                }
            },
        }
    }
    const customOptions = {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                }
            },
            datalabels: {
                formatter: (value, ctx) => {
                    return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                },
                color: 'rgb(0, 0, 0)',
            }
        },
        scales: {
            x: {
                grid: {
                display: false
                },
                stacked: true,
            },
            y: {
                grid: {
                display: false
                },
                beginAtZero: true,
                ticks: {
                    callback: (value, index, values) => {
                        return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(value);
                    }
                }
            },
        }
    };

    const customLabels = data.year_range;

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'UNIVERSITY',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(95, 160, 56)',
                    borderColor: 'rgb(95, 160, 56)',
                },
                {
                    label: 'NATIONAL',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgb(53, 92, 183)',
                    borderColor: 'rgb(53, 92, 183)',
                },
                {
                    label: 'PRIVATE',
                    data: data.bar_1.data_3,
                    backgroundColor: 'rgba(253, 180, 7)',
                    borderColor: 'rgba(253, 180, 7)',
                },
                {
                    label: 'INTERNATIONAL',
                    data: data.bar_1.data_4,
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        let fund = "RM"+(value/1000000).toFixed(2)+"mil";
                        return fund;
                    },
                    color: 'rgb(0, 0, 0)',
                }
            },
            locale: 'en-MY',
            scales: {
                x: {
                    grid: {
                    display: false
                    },
                    stacked: true,
                },
                y: {
                    grid: {
                    display: false
                    },
                    stacked: true,
                    ticks: {
                        callback: (value, index, values) => {
                            return new Intl.NumberFormat('en-MY', {
                                style: 'currency',
                                currency: 'MYR',
                                notation: 'compact',
                            }).format(value);
                        }
                    }
                },
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_2.data_4,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_2.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        display: false,
                    },
                },
                {
                    label: 'UNIVERSITY',
                    data: data.bar_2.data_1,
                    backgroundColor: 'rgb(67, 113, 40)',
                    borderColor: 'rgb(67, 113, 40)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        formatter: (value, ctx) => {
                            let fund = "RM"+(value/1000000).toFixed(2)+"mil";
                            return fund;
                        },
                        color: 'rgb(0, 0, 0)',
                    }
                },
                {
                    label: 'NATIONAL',
                    data: data.bar_2.data_2,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'bottom',
                        formatter: (value, ctx) => {
                            let i = ctx.dataIndex;
                            let x = ctx.chart.data.datasets[2].data[i];
                            let fund = 0;
                            if (value >= x) { fund = "RM"+((value - x)/1000000).toFixed(2)+"mil"; }
                            else { fund = "RM"+((x - value)/1000000).toFixed(2)+"mil"; }
                            console.log(fund);
                            return fund;
                        },
                        color: 'rgb(0, 0, 0)',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            locale: 'en-MY',
            scales: {
                x: {
                    grid: {
                    display: false
                    },
                    stacked: true,
                },
                y: {
                    grid: {
                    display: false
                    },
                    beginAtZero: true,
                    ticks: {
                        callback: (value, index, values) => {
                            return new Intl.NumberFormat('en-MY', {
                                style: 'currency',
                                currency: 'MYR',
                                notation: 'compact',
                            }).format(value);
                        }
                    }
                },
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_3.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_3.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        display: false,
                    },
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_3.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_4.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_4.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        display: false,
                    },
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_4.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_5.data_1,
                    backgroundColor: 'rgb(253, 180, 7)',
                    borderColor: 'rgb(253, 180, 7)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar6 = document.getElementById('bar6');
    var barChart6 = new Chart(bar6, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_6.data_1,
                    backgroundColor: 'rgb(21, 164, 63)',
                    borderColor: 'rgb(21, 164, 63)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar7 = document.getElementById('bar7');
    var barChart7 = new Chart(bar7, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_7.data_1,
                    backgroundColor: 'rgb(19, 160, 236)',
                    borderColor: 'rgb(19, 160, 236)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

    var bar8 = document.getElementById('bar8');
    var barChart8 = new Chart(bar8, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_8.data_1,
                    backgroundColor: 'rgb(230, 104, 38)',
                    borderColor: 'rgb(230, 104, 38)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: basicOptions,
    });

</script>
@endsection
@endcomponent