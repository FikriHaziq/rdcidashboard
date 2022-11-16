@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submoduleLink") myra.index @endslot
@slot("submodule") eMyRA Overview @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        eMyRA Overview
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/overview"/>

<div class="intro-y row mt-5">
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5"><b>TOTAL MARKS</b><br><canvas id="line1"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION B - <b>RESEARCHERS</b><br><canvas id="line2"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION C - <b>RESEARCH</b><br><canvas id="line3"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION D - <b>POSTGRADUATES</b><br><canvas id="line4"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION E - <b>INNOVATION</b><br><canvas id="line5"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION F - <b>PROFESSIONAL SERVICES & GIFTS</b><br><canvas id="line6"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION G - <b>NETWORKING & LINKAGES</b><br><canvas id="line7"></canvas></div>
    </div>
    <div class="col-md-4 col-sm-12 mb-5">
        <div class="box p-5">SECTION H - <b>SUPPORT FACILITIES</b><br><canvas id="line8"></canvas></div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var data = {!! json_encode($data) !!};

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_1.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line2 = document.getElementById('line2');
    var lineChart2 = new Chart(line2, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_2.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_2.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line3 = document.getElementById('line3');
    var lineChart3 = new Chart(line3, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_3.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_3.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line4 = document.getElementById('line4');
    var lineChart4 = new Chart(line4, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_4.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_4.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line5 = document.getElementById('line5');
    var lineChart5 = new Chart(line5, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_5.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_5.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line6 = document.getElementById('line6');
    var lineChart6 = new Chart(line6, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_6.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_6.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line7 = document.getElementById('line7');
    var lineChart7 = new Chart(line7, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_7.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_7.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
    
    var line8 = document.getElementById('line8');
    var lineChart8 = new Chart(line8, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'MyRA I',
                    data: data.line_8.data_1,
                    borderColor: ['rgb(253, 180, 7)'], 
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                },
                {
                    label: 'MyRA II',
                    data: data.line_8.data_2,
                    borderColor: ['rgb(21, 164, 63)'], 
                    backgroundColor: ['rgb(21, 164, 63)'],
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
                    // max: 150,
                    min: 0,
                    // ticks: {
                        // stepSize: 50
                    // }
                },
            }
        },
    });
</script>
@endsection
@endcomponent