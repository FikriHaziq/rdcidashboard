@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B: Quantity and Quality of Researchers @endslot
@slot("trimoduleLink") myra.section-b @endslot
@slot("trimodule") Cohort @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
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
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section B: Quantity and Quality of Researchers - Cohort
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-b/COHORT"/>
        
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'INVESTIGATOR', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Principal Investigator</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'COHORT', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Qualification & Cohort</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'AWARD', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Award</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B2 - <b>QUALIFICATION: PhD & PROFESSIONAL QUALIFICATION</b></span><br><canvas id="line1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B3 - <b>COHORT</b></span><br><canvas id="bar1"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>

    var data = {!! json_encode($data) !!};

    var bar1 = document.getElementById('bar1');
    //Percentage
    var bar1_1_percent = data.bar_1.data_4;
    var bar1_2_percent = data.bar_1.data_5;
    var bar1_3_percent = data.bar_1.data_6;
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '< 40 years old',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgba(180, 207, 168)',
                    borderColor: 'rgba(180, 207, 168)',
                    borderWidth: 1
                },
                {
                    label: '40 - 50 years old',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgb(112, 173, 71)',
                    borderColor: 'rgb(112, 173, 71)',
                    borderWidth: 1
                },
                {
                    label: '> 50 years old',
                    data: data.bar_1.data_3,
                    backgroundColor: 'rgb(91, 142, 57)',
                    borderColor: 'rgb(91, 142, 57)',
                    borderWidth: 1
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
                        pointStyle: 'rectRot',
                    }
                },
                datalabels: {
                    color: 'rgb(0, 0, 0)'
                }
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
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: {
                        display: false
                    },
                    ticks: {
                        callback: ((value, index, ticks) => {
                            return value + '%';
                        })
                    },
                    title: {
                        display: true,
                        text: 'Percentage (%)'
                    }
                },
            }
        }
    });

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'PhD',
                    data: data.line_1.data_1,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'PRO-Q',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRot',
                    }
                }
            },
            stacked: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    },
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 6000,
                    // min: 0,
                    // ticks: {
                    //     stepSize: 2000
                    // }
                },
            }
        },
    });
</script>
@endsection
@endcomponent