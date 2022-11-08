@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B: Quantity and Quality of Researchers @endslot
@slot("trimoduleLink") myra.section-b @endslot
@slot("trimodule") Cohort @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
    .bg-whitesmoke {
        background-color: whitesmoke;
    }
    
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
        
<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-b', ['tabs'=>'INVESTIGATOR', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 inactive-tab" role="tab">Principal Investigator</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-b', ['tabs'=>'COHORT', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active-tab" role="tab">Qualification & Cohort</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-b', ['tabs'=>'AWARD', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 inactive-tab" role="tab">Award</a>
    </li>
</ul>
<div class="tab-content box">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">QUALIFICATION: PhD & PROFESSIONAL QUALIFICATION</span><br><canvas id="line1"></canvas></div>
            </div>
            
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><span class="font-weight-bold">COHORT</span><br><canvas id="bar1"></canvas></div>
            </div>
            
            
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>

    var data = {!! json_encode($data) !!};

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '< 40 years old',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgba(10, 0, 192)',
                    borderColor: 'rgba(10, 0, 192)',
                    borderWidth: 1
                },
                {
                    label: '40 - 50 years old',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgba(26, 198, 5)',
                    borderColor: 'rgba(26, 198, 5)',
                    borderWidth: 1
                },
                {
                    label: '> 50 years old',
                    data: data.bar_1.data_3,
                    backgroundColor: 'rgb(145, 0, 26)',
                    borderColor: 'rgb(145, 0, 26)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 10000,
                    // min: 0,
                    // ticks: {
                    //     stepSize: 5000
                    // }
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
                },
                {
                    label: 'PRO-Q',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
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
                        pointStyle: 'circle',
                    }
                }
            },
            stacked: false,
            scales: {
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