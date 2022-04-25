@component("dashboard.layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Proposal in Year @endslot
@slot("content")
<div class="intro-y col-6 items-center mt-8 bg-white">
    <div class="input-group mt-2">
        <div class="input-group-text"><i class="p-1" style="color: limegreen" data-feather="thumbs-up"></i></div>
        <input type="text" readonly class="form-control" placeholder="Email" value="file.xlsx is selected" aria-describedby="input-group-email">
        <div class="input-group-text m-0 p-0">
            <a href="{{ route('grant.proposal.file') }}" class="btn btn-primary" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px">Manage File</a>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-5">
    <div class="g-col-3 box p-5 cursor-pointer zoom-in">
        <div class="fw-medium fs-xs">No of Proposal Submitted</div>
        <div class="fw-bold fs-lg">828</div>
    </div>
    <div class="g-col-3">
        <div class="py-5"> 
            <select class="tom-select w-full">
                <option>FACULTY</option>
                <option>UTMSPACE-KL</option>
                <option>MJIIT</option>
                <option>FSSH-KL</option>
                <option>FSSH-JB</option>
            </select>
        </div>
    </div>
    <div class="g-col-3">
        <div class="py-5"> 
            <select class="tom-select w-full">
                <option>PROJECT LEADER</option>
                <option>AHMAD FAUZI BIN ISMAIL</option>
                <option>THAREK BIN ABD RAHMAN</option>
                <option>ROSLI BIN MD. ILLIAS</option>
            </select>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="pie" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="bar1" width="800" class=""></canvas></div>
        </div>
    </div>
    {{-- <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">&nbsp;</div>
    </div> --}}
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6">
        <div class="card w-100 d-flex align-items-stretch">
            <div class="card-body"><canvas id="bar2" width="800" height="300"></canvas></div>
        </div>
    </div>
    <div class="g-col-6">
        <div class="card w-100 d-flex align-items-stretch">
            <div class="card-body"><canvas id="bar3" width="800" height="300"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var pie = document.getElementById('pie');
    var pieChart = new Chart(pie, {
        type: 'doughnut',
        data: {
            labels: ['FRGS', 'UTMER', 'IIIG', 'MG', 'NAPREC', 'PRGS', 'AADK', 'LPPKN', 'KKP', 'PPRN 2.0', 'PENDIDIKAN KHAS', 'MPC', 'LRGS-JSU', 'MYLAB', 'SKMM'],
            datasets: [
                {
                    label: 'DATA',
                    data: [intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400), intRand(400)],
                    backgroundColor: ['rgb(230, 74, 25)', 'rgb(232, 84, 38)', 'rgb(233, 96, 53)', 'rgb(235, 107, 66)', 'rgb(236, 117, 80)', 'rgb(238, 128, 94)', 'rgb(239, 139, 109)', 'rgb(241, 150, 122)', 'rgb(242, 161, 135)', 'rgb(244, 172, 149)', 'rgb(245, 183, 163)', 'rgb(247, 193, 177)', 'rgb(248, 204, 191)', 'rgb(252, 215, 204)', 'rgb(251, 226, 218)'],
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
                            size: 10,
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
            labels: ['FRGS', 'UTMER', 'IIIG', 'MG', 'NAPREC', 'PRGS', 'AADK', 'LPPKN', 'KKP', 'PPRN'],
            datasets: [
                {
                    label: 'No of Proposal',
                    data: ['383', '225', '66', '39', '35', '24', '15', '13', '10', '9'],
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
                    display: false,
                }
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['SMART DIGITAL COMMUNITY', 'RESOURCE SUSTAINABILITY', 'INNOVATIVE ENGINEERING', 'FRONTIER MATERIALS', 'HEALTH & WELLNESS'],
            datasets: [
                {
                    label: 'No of Proposal',
                    data: ['252', '224', '182', '110', '60'],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
                x: {
                    ticks: {
                        // callback: function(val, index) {
                        //     return this.getLabelForValue(val).substring(0,15);
                        // },
                        font: {
                            size: 7,
                        },
                    },
                },
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
            labels: ['FE', 'FABU', 'FSSK', 'FS', 'MJIIT', 'RAZAK', 'AHIBS', 'ICC'],
            datasets: [
                {
                    label: 'No of Proposal',
                    data: ['337', '128', '115', '80', '65', '63', '39', '1'],
                    backgroundColor: 'rgba(32, 40, 62172, 62, 49)',
                    borderColor: 'rgba(32, 40, 62)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });
</script>
@endsection
@endcomponent