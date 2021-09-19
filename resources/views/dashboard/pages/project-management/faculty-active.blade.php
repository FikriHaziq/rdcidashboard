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
    <div class="col-4">
        <div class="row">
            <div class="col-6">
                <div class="card w-100">
                    <div class="card-header"><small>TOTAL APPROVED, 2021</small></div>
                    <div class="card-body h3">302.615M</div>
                </div>
            </div>
            <div class="col-6">
                <div class="card w-100">
                    <div class="card-header"><small>TOTAL PROJECTS</small></div>
                    <div class="card-body h3">2861</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col card card-plain">
                <div style="font-size: 20px; font-weight: bold;">
                    <label>Filter: </label>
                </div>
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="subSponsor">
                        <option>SUBSPONSOR</option>
                        <option>RESEARCH UNIVERSITY GRANT</option>
                        <option>POST DOCTORAL FELLOWSHIP</option>
                        <option>MINISTRY OF EDUCATION</option>
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
                    <select class="form-control select2" id="school">
                        <option>SCHOOL</option>
                        <option>SEKOLAH KEJURUTERAAN KIMIA & TENAGA | J5105</option>
                        <option>SEKOLAH KEJURUTERAAN ELEKTRIK | J5104</option>
                        <option>FAKULTI ALAM BINA & UKUR | J5200</option>
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
    <div class="col-8">
        <div class="row">
            <div class="col-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body"><canvas id="pie1" width="800" height="300"></canvas></div>
                </div>
            </div>
            <div class="col-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body"><canvas id="pie2" width="800"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col card card-plain">
        Grant Approved vs Received by Sponsor
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="mixed" width="800" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            &nbsp;
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="bar1" width="400" height="100"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var pie1 = document.getElementById('pie1');
    var pieChart1 = new Chart(pie1, {
        type: 'pie',
        data: {
            labels: ['PRIVATE', 'NATIONAL', 'INTERNATIONAL', 'UNIVERSITY'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['4080701.5', '14544335', '8385183.62', '12187796.2'],
                    backgroundColor: ['rgb(106, 207, 220)', 'rgb(135, 104, 88)', 'rgb(186, 204, 128)', 'rgb(255, 107, 107)'],
                },
            ]
        },
        options: {
            aspectRatio: 2,
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                    position: 'right',
                }
            }
        }
    });

    var pie2 = document.getElementById('pie2');
    var pieChart2 = new Chart(pie2, {
        type: 'pie',
        data: {
            labels: ['FRONTIER MATERIALS', 'SMART DIGITAL COMMUNITY', 'RESOURCE SUSTAINABILITY', 'INNOVATIVE ENGINEERING', 'HEALTH & WELLNESS'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['85', '68', '98', '90', '37'],
                    backgroundColor: ['rgb(106, 207, 220)', 'rgb(135, 104, 88)', 'rgb(186, 204, 128)', 'rgb(255, 107, 107)', 'rgb(189, 175, 194)'],
                },
            ]
        },
        options: {
            aspectRatio: 2,
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                    position: 'right',
                }
            }
        }
    });

    var mixed = document.getElementById('mixed');
    var mixedChart = new Chart(mixed, {
        data: {
            labels: ['UNIVERSITY', 'PRIVATE', 'NATIONAL', 'INTERNATIONAL'],
            datasets: [
                {
                    type: 'line',
                    label: 'No Of Project',
                    yAxisID: 'project-axis',
                    data: [194, 67, 62, 55],
                    backgroundColor: 'rgba(135, 104, 88)',
                    borderColor: 'rgba(135, 104, 88)',
                },
                {
                    type: 'bar',
                    label: 'Approved',
                    data: [12187796, 4080701, 14544335, 8385183],
                    backgroundColor: 'rgba(186, 204, 128)',
                    borderColor: 'rgba(186, 204, 128)',
                },
                {
                    type: 'bar',
                    label: 'Received',
                    data: [9499074, 1807967, 5682633, 3972091],
                    backgroundColor: 'rgba(255, 107, 107)',
                    borderColor: 'rgba(255, 107, 107)',
                }
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        display: true,
                        stacked: true,
                        beginAtZero: true
                    },
                    {
                        id: 'project-axis',
                        display: false,
                        stacked: false,
                        beginAtZero: true,
                        suggestedMax: 200
                    }
                ]
            }
        }
    });

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: ['J51', 'J52', 'K43', 'J54', 'K56', 'J53', 'J55', 'K55', 'K11', 'K53'],
            datasets: [
                {
                    label: 'UNIVERSITY',
                    data: ['107', '20', '24', '17', '12', '8', '3', '1', '2', '0'],
                    backgroundColor: 'rgb(255, 107, 107)',
                    borderColor: 'rgb(255, 107, 107)',
                    borderWidth: 1
                },
                {
                    label: 'PRIVATE',
                    data: ['31', '2', '6', '4', '13', '6', '2', '3', '0', '0'],
                    backgroundColor: 'rgb(106, 207, 220)',
                    borderColor: 'rgb(106, 207, 220)',
                    borderWidth: 1
                },
                {
                    label: 'NATIONAL',
                    data: ['32', '8', '0', '9', '6', '3', '3', '0', '0', '1'],
                    backgroundColor: 'rgba(135, 104, 88)',
                    borderColor: 'rgba(135, 104, 88)',
                    borderWidth: 1
                },
                {
                    label: 'INTERNATIONAL',
                    data: ['25', '11', '8', '7', '2', '0', '0', '2', '0', '0'],
                    backgroundColor: 'rgba(186, 204, 128)',
                    borderColor: 'rgba(186, 204, 128)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    stacked: true,
                    beginAtZero: true
                },
                x: {
                    stacked: true
                }
            }
        }
    });
</script>
@endsection
@endcomponent