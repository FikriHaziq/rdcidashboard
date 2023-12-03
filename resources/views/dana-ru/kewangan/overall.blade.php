@component("layouts.app")
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: rgb(100, 181, 246)">
                <div class="fw-medium fs-xs text-white">Registered Projects</div>
                <div class="fw-bold fs-lg text-white">15,503</div>
            </div>
            <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: rgb(229, 115, 115);">
                <div class="fw-medium fs-xs text-white">Active Projects</div>
                <div class="fw-bold fs-lg text-white">2,861</div>
            </div>
            <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: rgb(129, 199, 132);">
                <div class="fw-medium fs-xs text-white">2021 Projects</div>
                <div class="fw-bold fs-lg text-white">378</div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-4">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>SPONSOR CATEGORY</option>
                        <option>UNIVERSITY</option>
                        <option>PRIVATE</option>
                        <option>NATIONAL</option>
                        <option>INTERNATIONAL</option>
                    </select>
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>SUBSPONSOR</option>
                        <option>RESEARCH UNIVERSITY GRANT</option>
                        <option>POST DOCTORAL FELLOWSHIP</option>
                        <option>MINISTRY OF EDUCATION</option>
                    </select>
                </div>      
            </div>
            <div class="col-4">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>FACULTY</option>
                        <option>UTMSPACE-KL</option>
                        <option>MJIIT</option>
                        <option>FSSH-KL</option>
                        <option>FSSH-JB</option>
                    </select>
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>SCHOOL</option>
                        <option>SEKOLAH KEJURUTERAAN KIMIA & TENAGA | J5105</option>
                        <option>SEKOLAH KEJURUTERAAN ELEKTRIK | J5104</option>
                        <option>FAKULTI ALAM BINA & UKUR | J5200</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>YEAR START</option>
                        <option>2019</option>
                        <option>2014</option>
                        <option>2016</option>
                    </select> 
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>STAFF NAME</option>
                        <option>AHMAD FAUZI BIN ISMAIL</option>
                        <option>THAREK BIN ABD RAHMAN</option>
                        <option>ROSLI BIN MD. ILLIAS</option>
                    </select> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="pie1" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="pie2" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">&nbsp;</div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">&nbsp;</div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-4">
        <div class="row">
            <div class="col"><div class="card w-full">&nbsp;</div></div>
        </div>
        <div class="row mt-3">
            <div class="col"><div class="card w-full d-flex align-items-stretch">&nbsp;</div></div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col"><div class="card w-full">&nbsp;</div></div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="card w-100 d-flex align-items-stretch">
                    <div class="card-body"><canvas id="mixed" width="800" height="300"></canvas></div>
                </div>
            </div>
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
            labels: ['ACTIVE', 'END WITHOUT FINAL REPORT', 'ENDED', 'COMPLETED', 'TERMINATED'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['2399', '187', '173', '92', '10'],
                    backgroundColor: ['rgb(172, 62, 49)', 'rgb(218, 174, 89)', 'rgb(72, 72, 72)', 'rgb(218, 218, 218)', 'rgb(32, 40, 62)'],
                },
            ]
        },
        options: {
            aspectRatio: 1,
            elements: {
                arc: {
                    borderWidth: 0,
                }
            },
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                    },
                    display: false,
                }
            },
        }
    });

    var pie2 = document.getElementById('pie2');
    var pieChart2 = new Chart(pie2, {
        type: 'doughnut',
        data: {
            labels: ['FRGS', 'UTM-TDR', 'UTMER', 'TIER 2', 'OTR', 'IIIG', 'CR DTD', 'CRG', 'PDRU', 'ETC'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['434', '247', '229', '196', '189', '186', '173', '140', '126', '941'],
                    backgroundColor: ['rgb(172, 62, 49)', 'rgb(72, 72, 72)', 'rgb(201, 84, 66)', 'rgb(156, 43, 34)', 'rgb(218, 174, 89)', 'rgb(252, 181, 244)', 'rgb(218, 218, 218)', 'rgb(32, 40, 62)', 'rgb(72, 138, 153)', 'rgb(136, 17, 72)'],
                },
            ]
        },
        options: {
            aspectRatio: 1,
            elements: {
                arc: {
                    borderWidth: 0,
                }
            },
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

    var mixed = document.getElementById('mixed');
    var mixedChart = new Chart(mixed, {
        data: {
            labels: ['1979', '1980', '1981', '1982', '1983', '1984', '1985', '1986', '1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999','2000','2001','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020', '2021'],
            datasets: [
                {
                    type: 'line',
                    label: 'No Of Project',
                    yAxisID: 'project-axis',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 2, 1, 150, 471, 216, 488, 342, 1198, 1095, 732, 1288, 972, 1120, 734, 1078, 1251, 1023, 378],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                },
                {
                    type: 'bar',
                    label: 'Allocation',
                    data: [0, 0, 0, 0, 0, 2711700, 3638000, 5908007, 3580000, 2837000, 2873000, 5832000, 7721000, 23301000, 8422000, 10589000, 23576000, 26546000, 5843000, 98943000, 22423000, 29517000, 6372000, 0, 132000, 1590000, 545786, 23180000, 122612000, 28604000, 78955000, 27904000, 108603000, 99052000, 82466000, 99418000, 91490000, 81964000, 59946000, 98336000, 99297000, 82184000, 39198000],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
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