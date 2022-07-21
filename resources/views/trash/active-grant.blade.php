<<<<<<< HEAD
@component("dashboard.layouts.app")
=======
@component("layouts.app")
>>>>>>> master
@slot("title") Active Grant In Year @endslot
@section('custom-css') @endsection
@slot("content")
<div class="card card-plain d-flex flex-row align-items-center">
    <div style="font-size: 20px; font-weight: bold;">
        <label>Filter: </label>
    </div>

    <div class="w-25 ml-2">
        <select class="form-control select2" id="grantType">
            <option>GRANT TYPE</option>
            <option>[443] FUNDAMENTAL RESEARCH GRANT SCHEME</option>
            <option>[229] UTM ENCOURAGEMENT RESEARCH</option>
            <option>[199] UTM TRANDICIPLINARY RESEARCH GRANT</option>
        </select>
    </div>

    <div class="w-25 ml-2">
        <select class="form-control select2" id="sponsorCategory">
            <option>SPONSOR CATEGORY</option>
            <option>UNIVERSITY</option>
            <option>NATIONAL</option>
            <option>PRIVATE</option>
            <option>INTERNATIONAL</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Research Grants Year 2021</div>
            <div class="card-body"><canvas id="bar1" width="400" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Research Grant with Extrension</div>
            <div class="card-body"><canvas id="pie" width="400" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Research Grant vs End Year</div>
            <div class="card-body"><canvas id="bar2" width="400" height="300"></canvas></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Grant by Faculty</div>
            <div class="card-body"><canvas id="bar3" width="800" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Research Grant Secured by Yearly Basis</div>
            <div class="card-body"><canvas id="line" width="400" height="300"></canvas></div>
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
            labels: ['UNIVERSITY', 'NATIONAL', 'PRIVATE', 'INTERNATIONAL'],
            datasets: [
                {
                    label: 'ST',
                    data: [intRand(1501), intRand(1501), intRand(1501), intRand(1501)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'NON-ST (SS)',
                    data: [intRand(1501), intRand(1501), intRand(1501), intRand(1501)],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var pie = document.getElementById('pie');
    var pieChart = new Chart(pie, {
        type: 'doughnut',
        data: {
            labels: ['NO EXTEND', 'EXTEND'],
            datasets: [
                {
                    label: 'Active Research Grant with Extension',
                    data: ['2429', '134'],
                    backgroundColor: ['rgb(216, 173, 88)', 'rgb(218, 218, 218)',],
                },
            ]
        },
        options: {
            aspectRatio: 1.5,
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['2021', '2022', '2023', '2024', '2025'],
            datasets: [
                {
                    label: 'NO EXTEND',
                    data: [intRand(1501), intRand(1501), intRand(300), intRand(100), intRand(50)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'EXTEND',
                    data: [intRand(300), intRand(300), intRand(100), intRand(50), intRand(10)],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['FK', 'FS', 'MJIIT', 'FSSH-JB', 'FABU', 'FITR', 'AHIBS-JB', 'AHIBS-KL', 'FSSH-KL', 'CANSELERI', 'UTMSPACE-KL', 'N/A'],
            datasets: [
                {
                    label: 'ST',
                    data: [intRand(1501), intRand(1301), intRand(1101), intRand(500), intRand(400), intRand(300), intRand(300), intRand(100), intRand(100), intRand(50), intRand(40), intRand(30),],
                    backgroundColor: 'rgba(72, 138, 153)',
                    borderColor: 'rgba(72, 138, 153)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    var line = document.getElementById('line');
    var lineChart = new Chart(line, {
        type: 'line',
        data: {
            labels: ['2011', '2013', '2015', '2017', '2019', '2021', '2023', '2025'],
            datasets: [
                {
                    label: 'ST',
                    data: [intRand(50), intRand(50), intRand(100), intRand(500), intRand(2000), intRand(2000), intRand(300), intRand(30),],
                    backgroundColor: 'rgba(0, 0, 0)',
                    borderColor: 'rgba(0, 0, 0)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
{{-- Active Research Grant with Extension --}}
@endsection
@endcomponent