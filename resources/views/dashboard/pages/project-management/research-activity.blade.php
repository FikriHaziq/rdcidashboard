@component("dashboard.layouts.app")
@slot("title") Active Grant In Year @endslot
@section('custom-css') 
<style>
    .paper-range {
        background-color: #FFF;
        padding: 3px;
        border: 1px solid #AAA;
        border-radius: 5px;
    }
</style>
@endsection
@slot("content")
<div class="card card-plain d-flex flex-row align-items-center">
    <div class="w-25 ml-2">
        <select class="form-control select2" id="faculty">
            <option>FACULTY</option>
            <option>FK</option>
            <option>FSSH-JB</option>
            <option>FABU</option>
        </select>
    </div>

    <div class="w-25 ml-2">
        <select class="form-control select2" id="grantAcronym">
            <option>GRANT ACRONYM</option>
            <option>PERMANENT</option>
            <option>CONTRACT</option>
        </select>
    </div>

    <div class="w-25 ml-2">
        <select class="form-control select2" id="activityType">
            <option>ACTIVITY TYPE</option>
            <option>FK</option>
            <option>FSSH-JB</option>
            <option>FABU</option>
        </select>
    </div>

    <div class="w-25 ml-2">
        <select class="form-control select2" id="approvedStatus">
            <option>APPROVED BY STATUS</option>
            <option>APPROVED BY RMC</option>
            <option>APPROVED BY RMC FACULTY</option>
            <option>APPROVED BY RMC DIRECTOR</option>
            <option>APPROVED BY RMC DEPUTY DIRECTOR</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Staff by Cohort and Faculty</div>
            <div class="card-body"><canvas id="bar1" width="800" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Staff Who Have Grant</div>
            <div class="card-body"><canvas id="bar2" width="400" height="300"></canvas></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Staff Who Have Grant by Cohort</div>
            <div class="card-body"><canvas id="bar3" width="400" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">ST-SS > FACULTY > STAFF</div>
            <div class="card-body"></div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">ST & SS Staff</div>
            <div class="card-body"><canvas id="bar4" width="400" height="300"></canvas></div>
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
            labels: ['FK', 'FSSH-JB', 'FABU', 'FS', 'FTIR', 'MJIIT', 'AHIBS-JB', 'UTMSPACE-KL', 'FSSH-KL', 'AHIBS-KL', 'UTMSPACE-JB', 'PENDAFTAR'],
            datasets: [
                {
                    label: 'Cohort A (>50 y/o)',
                    data: [intRand(1501), intRand(1301), intRand(1101), intRand(500), intRand(400), intRand(300), intRand(300), intRand(100), intRand(100), intRand(50), intRand(40), intRand(30),],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'Cohort B (40-50 y/o)',
                    data: [intRand(1501), intRand(1301), intRand(1101), intRand(500), intRand(400), intRand(300), intRand(300), intRand(100), intRand(100), intRand(50), intRand(40), intRand(30),],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
                {
                    label: 'Cohort C (<40 y/o)',
                    data: [intRand(1501), intRand(1301), intRand(1101), intRand(500), intRand(400), intRand(300), intRand(300), intRand(100), intRand(100), intRand(50), intRand(40), intRand(30),],
                    backgroundColor: 'rgb(216, 173, 88)',
                    borderColor: 'rgb(216, 173, 88)',
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

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['TRUE', 'FALSE'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['69.31', '30.69'],
                    backgroundColor: 'rgba(32, 40, 62)',
                    borderColor: 'rgba(32, 40, 62)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['TRUE', 'FALSE'],
            datasets: [
                {
                    label: 'Cohort A (>50 y/o)',
                    data: ['259', '235'],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'Cohort B (40-50 y/o)',
                    data: ['480', '161'],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
                {
                    label: 'Cohort C (<40 y/o)',
                    data: ['388', '103'],
                    backgroundColor: 'rgb(216, 173, 88)',
                    borderColor: 'rgb(216, 173, 88)',
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

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: ['ST', 'SS'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['1190', '436'],
                    backgroundColor: 'rgba(72, 138, 153)',
                    borderColor: 'rgba(72, 138, 153)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1600
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