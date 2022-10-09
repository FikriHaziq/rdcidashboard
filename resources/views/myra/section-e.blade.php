@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section E: Quantity and Quality of Postgraduates @endslot
@slot("submoduleLink") myra.section-e @endslot
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
        Section E: Quantity and Quality of Postgraduates - Enrollment
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
<div class="p-5">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">PATENT GRANTED</span><br><canvas id="bar1"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">PATENT FILED</span><br><canvas id="bar2"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">OTHER IPRs</span><br><canvas id="bar3"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">COMMERCIALIZED PRODUCTS</span><br><canvas id="bar4"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">LICENSING/SOLD OUTRIGHT</span><br><canvas id="bar5"></canvas></div>
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
                    label: 'ACHIEVEMENT',
                    data: ['193', '166', '139', '147', '154', '168'],
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1
                },
                {
                    label: '100% TARGET',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
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
                y: {
                    beginAtZero: true,
                },
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: ['193', '166', '139', '147', '154', '168'],
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1
                },
                {
                    label: '100% TARGET',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
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
                y: {
                    beginAtZero: true,
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
                    label: 'ACHIEVEMENT',
                    data: ['193', '166', '139', '147', '154', '168'],
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1
                },
                {
                    label: '100% TARGET',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
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
                y: {
                    beginAtZero: true,
                },
            }
        }
    });

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: ['193', '166', '139', '147', '154', '168'],
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1
                },
                {
                    label: '100% TARGET',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
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
                y: {
                    beginAtZero: true,
                },
            }
        }
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [
                {
                    label: 'ACHIEVEMENT',
                    data: ['193', '166', '139', '147', '154', '168'],
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1
                },
                {
                    label: '100% TARGET',
                    data: ['1766', '1632', '1447', '1402', '1234', '1198'],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
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
                y: {
                    beginAtZero: true,
                },
            }
        }
    });
</script>
@endsection
@endcomponent