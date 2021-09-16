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
                    <div class="card-body h3">1.516B</div>
                </div>
            </div>
            <div class="col-6">
                <div class="card w-100">
                    <div class="card-header"><small>TOTAL PROJECTS</small></div>
                    <div class="card-body h3">15,596</div>
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
            <div class="card-body"><canvas id="mixed1" width="800" height="300"></canvas></div>
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
            <div class="card-body"><canvas id="mixed2" width="400" height="100"></canvas></div>
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

    var mixed1 = document.getElementById('mixed1');
    var mixedChart1 = new Chart(mixed1, {
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

    var mixed2 = document.getElementById('mixed2');
    var mixedChart2 = new Chart(mixed2, {
        data: {
            labels: ['1979', '1980', '1981', '1982', '1983', '1984', '1985', '1986', '1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999','2000','2001','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020', '2021'],
            datasets: [
                {
                    type: 'line',
                    label: 'No Of Project',
                    yAxisID: 'project-axis',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 2, 1, 150, 471, 216, 488, 342, 1198, 1095, 732, 1288, 972, 1120, 734, 1078, 1251, 1023, 378],
                    backgroundColor: 'rgba(135, 104, 88)',
                    borderColor: 'rgba(135, 104, 88)',
                },
                {
                    type: 'bar',
                    label: 'Allocation',
                    data: [0, 0, 0, 0, 0, 2711700, 3638000, 5908007, 3580000, 2837000, 2873000, 5832000, 7721000, 23301000, 8422000, 10589000, 23576000, 26546000, 5843000, 98943000, 22423000, 29517000, 6372000, 0, 132000, 1590000, 545786, 23180000, 122612000, 28604000, 78955000, 27904000, 108603000, 99052000, 82466000, 99418000, 91490000, 81964000, 59946000, 98336000, 99297000, 82184000, 39198000],
                    backgroundColor: 'rgba(186, 204, 128)',
                    borderColor: 'rgba(186, 204, 128)',
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
                        suggestedMax: 1300
                    }
                ]
            }
        }
    });
</script>
@endsection
@endcomponent