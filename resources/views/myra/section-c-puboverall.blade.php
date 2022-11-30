@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section C: Quantity and Quality of Research @endslot
@slot("trimodule") Publication @endslot
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
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-c/PUBLICATION-ALL"/>

<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-c', ['tabs'=>'PUBLICATION-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active">
                    Publication
                </a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-c', ['tabs'=>'FUNDING-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2">
                    Funding
                </a>
            </li>
        </ul>
    </div>
</div>
{{-- Faculty Link OlD --}}
{{-- <li class="nav-item flex-1" role="presentation">
    <a href="{{ route('myra.section-c', ['tabs'=>'PUBLICATION-FACULTY', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Publication by Faculty</a>
</li> --}}
{{-- <li class="nav-item flex-1" role="presentation">
    <a href="{{ route('myra.section-c', ['tabs'=>'FUNDING-FACULTY', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Funding by Faculty</a>
</li> --}}
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1a(i,iii) - <b>INDEXED JOURNAL</b></span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1a(i,iii) - <b>ARTICLES IN Q1/Q2 JOURNAL</b></span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1a(ii) - <b>INDEXED PROCEEDING</b></span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold"><b>MyCITE</b></span><br><canvas id="bar4"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1d(i) - <b>RESEARCH BOOK</b></span><br><canvas id="bar5"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1d(ii) - <b>BOOK CHAPTER</b></span><br><canvas id="bar6"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1d(iii) - <b>CASE STUDY/TECHNICAL REPORT</b></span><br><canvas id="bar7"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1e - <b>POLICY PAPER</b></span><br><canvas id="bar8"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">SEC. C1f - <b>OTHER PUBLICATIONS</b></span><br><canvas id="bar9"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var data = {!! json_encode($data) !!};

    const customOptions = {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                reverse: 'true',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'rectRot',
                }
            },
            // datalabels: {
            //     formatter: (value, ctx) => {
            //         let sum = 0;
            //         let i = ctx.dataIndex;
            //         let total = ctx.chart.data.datasets[1].data[i];
            //         let percentage = (value*100 / total).toFixed(2)+"%";
            //         return percentage;
            //     },
            // }
        },
        scales: {
            x: {
                grid: {
                display: false
                },
                title: {
                    display: true,
                    text: 'Year'
                },
                stacked: true,
            },
            y: {
                grace: '5%',
                grid: {
                display: false
                },
                title: {
                    display: true,
                    text: 'No. of Publication'
                },
                beginAtZero: true,
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
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_1.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'INDEXED JOURNAL',
                    data: data.bar_2.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_2.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
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
                    reverse: 'true',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRot',
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let sum = 0;
                            let i = context.dataIndex;
                            let total = context.chart.data.datasets[0].data[i];
                            let percentage = (value*100 / total).toFixed(2)+"%";
                            return percentage;
                        }
                    }
                }
                // datalabels: {
                //     formatter: (value, ctx) => {
                //         let sum = 0;
                //         let i = ctx.dataIndex;
                //         let total = ctx.chart.data.datasets[0].data[i];
                //         let percentage = (value*100 / total).toFixed(2)+"%";
                //         return percentage;
                //     },
                // }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    },
                    stacked: true,
                },
                y: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'No. of Article'
                    },
                    beginAtZero: true,
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
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_3.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
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
                        align: 'end',
                        color: '#000'
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
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_4.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
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
                        align: 'end',
                        color: '#000'
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
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_5.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_5.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_5.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar6 = document.getElementById('bar6');
    var barChart6 = new Chart(bar6, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_6.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_6.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_6.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar7 = document.getElementById('bar7');
    var barChart7 = new Chart(bar7, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_7.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_7.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_7.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar8 = document.getElementById('bar8');
    var barChart8 = new Chart(bar8, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_8.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_8.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_8.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar9 = document.getElementById('bar9');
    var barChart9 = new Chart(bar9, {
        type: 'bar',
        data: {
            labels: customLabels,
            datasets: [
                {
                    label: 'MyRA II TARGET (200%)',
                    data: data.bar_9.data_3,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'MyRA II TARGET (100%)',
                    data: data.bar_9.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(44, 73, 26)',
                    borderWidth: 0.2,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        display: 'auto',
                        color: '#2C491A'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_9.data_1,
                    backgroundColor: 'rgb(185, 219, 165)',
                    borderColor: 'rgb(185, 219, 165)',
                    borderWidth: 1,
                    categoryPercentage: 0.78,
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#000'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });
</script>
@endsection
@endcomponent