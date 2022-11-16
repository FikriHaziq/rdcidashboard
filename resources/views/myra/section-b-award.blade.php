@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B: Quantity and Quality of Researchers @endslot
@slot("trimoduleLink") myra.section-b @endslot
@slot("trimodule") Awards @endslot
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
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section B: Quantity and Quality of Researchers - Awards
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-b/AWARD"/>                 
                                    
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'INVESTIGATOR', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Principal Investigator</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'COHORT', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Qualification & Cohort</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'AWARD', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Award</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">INTERNATIONAL AWARDS</span><br><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">INTERNATIONAL RECOGNITION/STEWARDSHIP</span><br><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NATIONAL AWARDS</span><br><canvas id="bar3"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">NATIONAL RECOGNITION/STEWARDSHIP</span><br><canvas id="bar4"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">EXHIBITION AWARDS</span><br><canvas id="bar5"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">OTHER RESEARCH AWARDS</span><br><canvas id="bar6"></canvas></div>
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
                    pointStyle: 'circle',
                }
            },
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                stacked: true,
            },
            y: {
                grace: '5%',
                grid: {
                    display: false
                },
                beginAtZero: true,
            },
        }
    };

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_2.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_2.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_3.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_3.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_4.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_4.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_5.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_5.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
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
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_6.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_6.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'end'
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