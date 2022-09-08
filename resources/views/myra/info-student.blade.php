@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submoduleLink") myra.info.student @endslot
@slot("submodule") eMyRA General Info @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        eMyRA Overview
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
<div class="intro-y box py-10 sm:py-20 mt-5">
    {{-- @include('myra.self-assessment.tabs', compact('year')) --}}
    <div class="d-flex justify-content-center">
        <a href="{{ route('myra.info.staff') }}" class="intro-y h-10 btn @if(is_active('myra.info.staff')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">Academic Staff</a>
        <a href="{{ route('myra.info.student') }}" class="intro-y h-10 btn @if(is_active('myra.info.student')) btn-primary @else bg-gray-200 dark:bg-dark-1 text-gray-600 @endif mx-2">Student</a>
    </div>
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg text-uppercase">STUDENT SECTION</div>
    </div>
</div>
<div class="intro-y row mt-5">
    <div class="col-md-6 col-sm-12 mb-5">
        <div class="box p-5"><span class="font-weight-bold">POSTGRADUATES STUDY MODE</span><br><canvas id="line1"></canvas></div>
    </div>
    <div class="col-md-6 col-sm-12 mb-5">
        <div class="box p-5"><span class="font-weight-bold">POSTGRADUATES BY RESEARCH</span><br><canvas id="bar1"></canvas></div>
    </div>
    <div class="col-md-6 col-sm-12 mb-5">
        <div class="box p-5"><span class="font-weight-bold">POSTGRADUATES AREA OF STUDY</span><br><canvas id="bar2"></canvas></div>
    </div>
    <div class="col-md-6 col-sm-12 mb-5">
        <div class="box p-5"><span class="font-weight-bold">STUDENT: UNDERGRADUATE VS POSTGRADUATE</span><br><canvas id="bar3"></canvas></div>
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
                    label: 'PROFESSOR',
                    data: ['200', '200', '200', '200', '200', '230'],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'ASSOCIATE PROFESSOR',
                    data: ['390', '390', '390', '390', '390', '380'],
                    backgroundColor: 'rgb(72, 138, 153)',
                    borderColor: 'rgb(72, 138, 153)',
                    borderWidth: 1
                },
                {
                    label: 'SENIOR LECTURER',
                    data: ['1000', '1100', '1200', '1150', '1200', '1250'],
                    backgroundColor: 'rgba(218, 174, 89)',
                    borderColor: 'rgba(218, 174, 89)',
                    borderWidth: 1
                },
                {
                    label: 'LECTURER',
                    data: ['200', '300', '200', '100', '100', '100'],
                    backgroundColor: 'rgba(218, 218, 218)',
                    borderColor: 'rgba(218, 218, 218)',
                    borderWidth: 1
                },
                {
                    label: 'RESEARCH FELLOW',
                    data: ['0', '0', '0', '0', '20', '50'],
                    backgroundColor: 'rgba(32, 40, 62)',
                    borderColor: 'rgba(32, 40, 62)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    max: 1200,
                    min: 0,
                    ticks: {
                        stepSize: 400
                    }
                },
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['ENGINEERING', 'FINANCE/BUSINESS', 'EDUCATION', 'COMPUTER SCIENCE', 'ARCHITECTURE', 'SOCIAL SCIENCE', 'SCIENCE', 'TECHNOLOGY', 'ISLAMIC STUDY', 'LANGUAGE', 'TECHNICAL STUDY', 'SCIENCE EDUCATION', 'SCIENCE MANAGEMENT', 'TECHNICAL', 'COMMUNICATION', 'ENVIRONMENT', 'INFORMATION TECHNOLOGY'],
            datasets: [
                {
                    data: ['4100', '1400', '1300', '1350', '1200', '1100', '1000', '700', '700', '600', '300', '250', '200', '100', '100', '100', '80'],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                x: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    max: 4500,
                    min: 0,
                    ticks: {
                        stepSize: 1500
                    }
                },
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [
                {
                    label: 'A (> 50 years old)',
                    data: ['650', '600', '580', '560', '550', '540'],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'B (40 - 50 years old)',
                    data: ['530', '550', '570', '590', '620', '650'],
                    backgroundColor: 'rgb(72, 138, 153)',
                    borderColor: 'rgb(72, 138, 153)',
                    borderWidth: 1
                },
                {
                    label: 'C (< 40 years old)',
                    data: ['500', '490', '470', '480', '490', '510'],
                    backgroundColor: 'rgba(218, 174, 89)',
                    borderColor: 'rgba(218, 174, 89)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    max: 800,
                    min: 0,
                    ticks: {
                        stepSize: 200
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
                    label: 'DATA',
                    data: ['1600', '1650', '1700', '1680', '1630', '1640'],
                    borderColor: ['rgb(72, 72, 72)'],
                    backgroundColor: ['rgb(72, 72, 72)'],
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
                    display: false,
                }
            },
            stacked: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    max: 2000,
                    min: 0,
                    ticks: {
                        stepSize: 500
                    }
                },
            }
        },
    });
</script>
@endsection
@endcomponent