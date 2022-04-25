@component("dashboard.layouts.app")
@slot('module') UTM Research @endslot
@slot("submodule") Research MyRA @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y col-6 items-center mt-8 bg-white">
    <div class="input-group mt-2">
        <div class="input-group-text"><i class="p-1" style="color: limegreen" data-feather="thumbs-up"></i></div>
        <input type="text" readonly class="form-control" placeholder="Email" value="file.csv is selected" aria-describedby="input-group-email">
        <div class="input-group-text m-0 p-0">
            <a href="{{ route('grant.myra.file') }}" class="btn btn-primary" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px">Manage File</a>
        </div>
    </div>
</div>
<div class="intro-y row mt-5">
    <div class="col-6">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: rgb(229, 115, 115);">
                <div class="fw-medium fs-xs text-white">Total Active Projects</div>
                <div class="fw-bold fs-lg text-white">2,821</div>
            </div>
            <div class="g-col-3 box p-5 cursor-pointer zoom-in bg-theme-1">
                <div class="fw-medium fs-xs text-white">Target PI</div>
                <div class="fw-bold fs-lg text-white">1302</div>
            </div>
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: rgb(129, 199, 132)">
                <div class="fw-medium fs-xs text-white">Total PI</div>
                <div class="fw-bold fs-lg text-white">1,139</div>
            </div>
            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: rgb(76, 208, 225);">
                <div class="fw-medium fs-xs text-white">New PI</div>
                <div class="fw-bold fs-lg text-white">50</div>
            </div>
            <div class="g-col-4 box p-5 cursor-pointer zoom-in bg-theme-1">
                <div class="fw-medium fs-xs text-white">Active Staff</div>
                <div class="fw-bold fs-lg text-white">1626</div>
            </div>
            <div class="g-col-4 box p-5 cursor-pointer zoom-in bg-theme-1">
                <div class="fw-medium fs-xs text-white">New PI Increment</div>
                <div class="fw-bold fs-lg text-white">10%</div>
            </div>
            <div class="g-col-4 box p-5 cursor-pointer zoom-in bg-theme-1">
                <div class="fw-medium fs-xs text-white">Amount Pledged <b>(RM)</b></div>
                <div class="fw-bold fs-lg text-white">43,001,975.34</div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6">
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
                        <option>SPONSOR</option>
                        <option>UNIVERSITI TEKNOLOGI MALAYSIA</option>
                        <option>MINISTRY OF EDUCATION</option>
                        <option>RUG OF UTM</option>
                    </select>
                </div>      
            </div>
            <div class="col-6">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>FACULTY</option>
                        <option>UTMSPACE-KL</option>
                        <option>MJIIT</option>
                        <option>FSSH-KL</option>
                        <option>FSSH-JB</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="mixed" width="800" height="300"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">&nbsp;</div>
    </div>
    <div class="g-col-3 grid grid-cols-12 gap-3">
        <div class="g-col-12"><div class="card w-full">&nbsp;</div></div>
        <div class="g-col-12">
            <div class="card w-full">
                <div class="card-body"><canvas id="pie1" width="800" height="300"></canvas></div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="bar1" width="1100" height="300"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body"><canvas id="pie2" width="800" height="300"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var mixed = document.getElementById('mixed');
    var mixedChart = new Chart(mixed, {
        data: {
            labels: ['UNIVERSITY', 'PRIVATE', 'NATIONAL', 'INTERNATIONAL'],
            datasets: [
                {
                    type: 'line',
                    label: 'Active Projects',
                    yAxisID: 'project-axis',
                    data: [1548, 265, 841, 167],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                },
                {
                    type: 'bar',
                    label: 'Amount Pledged',
                    data: [intRand(86000000), intRand(19000000), intRand(126000000), intRand(37000000)],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                },
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
                ],
            }
        }
    });

    var pie1 = document.getElementById('pie1');
    var pieChart1 = new Chart(pie1, {
        type: 'doughnut',
        data: {
            labels: ['UNIVERSITY', 'PRIVATE', 'NATIONAL', 'INTERNATIONAL'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['433', '116', '476', '114'],
                    backgroundColor: ['rgb(172, 62, 49)', 'rgb(218, 174, 89)', 'rgb(72, 72, 72)', 'rgb(72, 138, 153)'],
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
                        font: {
                            size: 8,
                        },
                        usePointStyle: true,
                    },
                    position: 'right',
                }
            },
        }
    });

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: ['NATIONAL', 'UNIVERSITY', 'PRIVATE', 'INTERNATIONAL'],
            datasets: [
                {
                    label: 'J51',
                    data: ['225', '182', '63', '58'],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'J53',
                    data: ['57', '66', '9', '4'],
                    backgroundColor: 'rgb(72, 138, 153)',
                    borderColor: 'rgb(72, 138, 153)',
                    borderWidth: 1
                },
                {
                    label: 'J54',
                    data: ['61', '52', '10', '9'],
                    backgroundColor: 'rgba(218, 174, 89)',
                    borderColor: 'rgba(218, 174, 89)',
                    borderWidth: 1
                },
                {
                    label: 'J52',
                    data: ['46', '40', '7', '10'],
                    backgroundColor: 'rgba(218, 218, 218)',
                    borderColor: 'rgba(218, 218, 218)',
                    borderWidth: 1
                },
                {
                    label: 'K56',
                    data: ['33', '48', '15', '3'],
                    backgroundColor: 'rgba(32, 40, 62)',
                    borderColor: 'rgba(32, 40, 62)',
                    borderWidth: 1
                },
                {
                    label: 'K43',
                    data: ['23', '13', '7', '26'],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
                {
                    label: 'J55',
                    data: ['18', '15', '1', '0'],
                    backgroundColor: 'rgba(245, 56, 160)',
                    borderColor: 'rgba(245, 56, 160)',
                    borderWidth: 1
                },
                {
                    label: 'K55',
                    data: ['8', '5', '3', '3'],
                    backgroundColor: 'rgba(191, 28, 111)',
                    borderColor: 'rgba(191, 28, 111)',
                    borderWidth: 1
                },
                {
                    label: 'K53',
                    data: ['2', '6', '1', '0'],
                    backgroundColor: 'rgba(171, 77, 95)',
                    borderColor: 'rgba(171, 77, 95)',
                    borderWidth: 1
                },
                {
                    label: 'J11',
                    data: ['0', '0', '4', '0'],
                    backgroundColor: 'rgba(107, -0, -0)',
                    borderColor: 'rgba(107, -0, -0)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },

            }
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
                    labels: {
                        font: {
                            size: 8,
                        },
                        usePointStyle: true,
                    },
                    position: 'right',
                }
            },
        }
    });
</script>
@endsection
@endcomponent