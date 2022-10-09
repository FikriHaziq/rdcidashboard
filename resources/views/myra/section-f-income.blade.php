@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section F: Professional Services and Gifts @endslot
@slot("submoduleLink") myra.section-f @endslot
@section('custom-css')
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
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section F: Professional Services and Gifts
    </h2>
</div>

<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'INCOME') }}" class="nav-link w-full py-2 active-tab" role="tab">Income</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'PARTICIPATION') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Participation</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'COMMUNITY') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Community & Joint Research</a>
    </li>
</ul>
<div class="tab-content box">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="pie1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="pie2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar3"></canvas></div>
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
            labels: ['Conference, Seminar', 'Consultancy, Lab Services', 'Endowment', 'Gifts', 'Product Comm, Tech Know-How', 'Training Courses, PG Fees'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['2399', '187', '173', '92', '10', '10'],
                    backgroundColor: ['rgb(172, 62, 49)', 'rgb(243, 131, 55)', 'rgb(218, 174, 89)', 'rgb(72, 72, 72)', 'rgb(218, 218, 218)', 'rgb(32, 40, 62)'],
                },
            ]
        },
        options: {
            aspectRatio: 1.5,
            elements: {
                arc: {
                    borderWidth: 0,
                }
            },
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    },
                    display: true,
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Total Income from Research Activity'
                }
            },
        }
    });

    var pie2 = document.getElementById('pie2');
    var pieChart2 = new Chart(pie2, {
        type: 'doughnut',
        data: {
            labels: ['Operational Expenditure', 'Operational Research Expenditure'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['41577027', '558825153'],
                    backgroundColor: ['rgb(172, 62, 49)', 'rgb(72, 138, 153)'],
                },
            ]
        },
        options: {
            aspectRatio: 1.5,
            elements: {
                arc: {
                    borderWidth: 0,
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                },
                title: {
                    display: true,
                    text: 'Total Operational Expenditure in Research Activity'
                }
            }
        }
    });

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: ['Income', 'Expenditure'],
            datasets: [
                {
                    label: 'LOA',
                    data: [49000000, 40500000],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
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
                },
                title: {
                    display: true,
                    text: 'Total Income and Expenditure from Research Activity'
                }
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['WCC', 'MTC', 'MAGIC-X', 'IBD', 'FTIR', 'FS', 'FABU', 'CRC', 'CFE', 'AB'],
            datasets: [
                {
                    label: 'Member',
                    data: [intRand(208999), intRand(208999), intRand(208999), intRand(208999), intRand(208999), intRand(208999), intRand(208999), intRand(208999), intRand(208999), intRand(208999)],
                    backgroundColor: 'rgba(207, 130, 130)',
                    borderColor: 'rgba(207, 130, 130)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            // indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Income from Training Courses'
                }
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['AHIBS', 'FABU', 'FE', 'FS', 'FSSK', 'FTIR', 'MJIIT', 'SPS'],
            datasets: [
                {
                    label: 'DATA',
                    data: [intRand(8021475), intRand(8021475), intRand(8021475), intRand(8021475), intRand(8021475), intRand(8021475), intRand(8021475), intRand(8021475)],
                    backgroundColor: 'rgba(184, 177, 133)',
                    borderColor: 'rgba(184, 177, 133)',
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
                },
                title: {
                    display: true,
                    text: 'Income from PG Fees'
                }
            }
        }
    });
</script>
@endsection
@endcomponent