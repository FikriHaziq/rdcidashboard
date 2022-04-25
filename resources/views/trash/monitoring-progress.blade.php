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
<div class="row">
    <div class="col-2">
        <div class="row">
            <div class="col card card-plain">
                <div style="font-size: 20px; font-weight: bold;">
                    <label>Filter: </label>
                </div>
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="startYear">
                        <option>START YEAR</option>
                        <option>2021</option>
                        <option>2020</option>
                        <option>2019</option>
                    </select>
                </div>  
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="grantType">
                        <option>GRANT TYPE</option>
                        <option>FUNDAMENTAL RESEARCH GRANT SCHEME</option>
                        <option>UTM ENCOURAGEMENT RESEARCH</option>
                        <option>UTM TRANDICIPLINARY RESEARCH GRANT</option>
                    </select>
                </div>      
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="faculty">
                        <option>FACULTY</option>
                        <option>UTMSPACE-KL</option>
                        <option>MJIIT</option>
                        <option>FSSH-KL</option>
                        <option>FSSH-JB</option>
                    </select>
                </div>            
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="ra">
                        <option>RA</option>
                        <option>INNOVATIVE ENGINEERING</option>
                        <option>RESOURCE SUSTAINABILITY</option>
                        <option>SMART DIGITAL COMMUNITY</option>
                        <option>FRONTIER MATERIALS</option>
                    </select>
                </div>      
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="row">
            <div class="col-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header">Active Grant End In Year</div>
                    <div class="card-body"><canvas id="pie1" width="800" height="300"></canvas></div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header">Project Extension Status</div>
                    <div class="card-body d-flex align-items-center"><canvas id="bar1" width="800"></canvas></div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header">Overview</div>
                    <div class="card-body d-flex align-items-center"><canvas id="bar2" width="800"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Grant - Project Status</div>
            <div class="card-body"><canvas id="bar3" width="400" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Percentage Spent</div>
            <div class="card-body d-flex align-items-center"><canvas id="pie2" width="400" height="300"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var pie1 = document.getElementById('pie1');
    var pieChart1 = new Chart(pie1, {
        type: 'doughnut',
        data: {
            labels: ['2021', '2022', '2023', '2024', '2025'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['998', '1309', '231', '23', '0'],
                    backgroundColor: ['rgb(72, 138, 153)', 'rgb(106, 159, 171)', 'rgb(138, 180, 190)', 'rgb(172, 201, 208)', 'rgb(204, 221, 226)'],
                },
            ]
        },
        options: {
            aspectRatio: 1.5,
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: ['NO EXTEND', 'EXTEND'],
            datasets: [
                {
                    label: 'DATA',
                    data: [intRand(2429), intRand(500)],
                    backgroundColor: 'rgba(32, 40, 62)',
                    borderColor: 'rgba(32, 40, 62)',
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

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['<= 3 MONTHS', '<= 6 MONTHS', 'ACTIVE'],
            datasets: [
                {
                    label: 'DATA',
                    data: [intRand(500), intRand(500), intRand(2000)],
                    backgroundColor: 'rgba(218, 174, 89)',
                    borderColor: 'rgba(218, 174, 89)',
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
                    display: false,
                }
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['ACTIVE', 'ENDED', 'END WITHOUT FINAL REPORT', 'COMPLETED', 'TERMINATED'],
            datasets: [
                {
                    label: 'NO EXTEND',
                    data: [intRand(2100), intRand(200), intRand(100), intRand(50), intRand(50)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'EXTEND',
                    data: [intRand(100), intRand(50), intRand(100), intRand(50), intRand(10)],
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
            },
        }
    });

    var pie2 = document.getElementById('pie2');
    var pieChart2 = new Chart(pie2, {
        type: 'pie',
        data: {
            labels: ['0%', '1%-25%', '26%-50%', '51%-75%', '76%-100%', '<0%', '>100%'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['319', '510', '621', '427', '675', '0', '10'],
                    backgroundColor: ['rgb(172, 62, 49)', 'rgb(183, 87, 75)', 'rgb(193, 112, 102)', 'rgb(203, 136, 128)', 'rgb(215, 161, 155)', 'rgb(225, 186, 181)', 'rgb(236, 211, 208)'],
                },
            ]
        },
        options: {
            aspectRatio: 2,
        }
    });
</script>
@endsection
@endcomponent