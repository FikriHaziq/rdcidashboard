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
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                {{-- @foreach ($data->faculties ?? [] as $faculty)
                <option value="{{ $faculty->faculty }}">{{ $faculty->faculty }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
            <select class="form-select bg-white">
                <option value="">2016</option>
                {{-- @foreach ($data->schools ?? [] as $school)
                <option value="{{ $school->school }}">{{ $school->school }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group">
            <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
            <select class="form-select bg-white">
                <option value="">2021</option>
                {{-- @foreach ($data->schools ?? [] as $school)
                <option value="{{ $school->school }}">{{ $school->school }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
</div>
        
<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-b', 'INVESTIGATOR') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Principal Investigator</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-b', 'COHORT') }}" class="nav-link w-full py-2 active-tab" role="tab">Qualification & Cohort</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-b', 'AWARD') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Award</a>
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
    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [
                {
                    label: '< 40 years old',
                    data: ['1957', '1854', '1713', '1876', '2104', '2482'],
                    backgroundColor: 'rgba(10, 0, 192)',
                    borderColor: 'rgba(10, 0, 192)',
                    borderWidth: 1
                },
                {
                    label: '40 - 50 years old',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(26, 198, 5)',
                    borderColor: 'rgba(26, 198, 5)',
                    borderWidth: 1
                },
                {
                    label: '> 50 years old',
                    data: ['193', '166', '139', '147', '154', '168'],
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
                    max: 10000,
                    min: 0,
                    ticks: {
                        stepSize: 5000
                    }
                },
            }
        }
    });

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [
                {
                    label: 'PhD',
                    data: ['5000', '4500', '4300', '4600', '4700', '4800'],
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                },
                {
                    label: 'PRO-Q',
                    data: ['2000', '3100', '2100', '2000', '1800', '1700'],
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
                    max: 6000,
                    min: 0,
                    ticks: {
                        stepSize: 2000
                    }
                },
            }
        },
    });
</script>
@endsection
@endcomponent