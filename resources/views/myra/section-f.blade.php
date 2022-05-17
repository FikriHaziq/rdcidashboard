@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section F: Professional Services and Gifts @endslot
@slot("content")
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="pie1" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar1" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-stretch"><canvas id="pie2" width="800"></canvas></div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-stretch"><canvas id="bar2" width="800" height="500"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar3" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar4" width="800"></canvas></div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-stretch"><canvas id="bar5" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar6" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar7" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar8" width="800"></canvas></div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar9" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar10" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar11" width="800"></canvas></div>
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
                    },
                    display: false,
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
                    display: false,
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
            indexAxis: 'y',
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

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: ['AGENCY', 'INDUSTRY', 'UNIVERSITY'],
            datasets: [
                {
                    label: 'CA',
                    data: [0, 2, 0],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
                    borderWidth: 1
                },
                {
                    label: 'MOA',
                    data: [10, 16, 28],
                    backgroundColor: 'rgba(230, 101, 34)',
                    borderColor: 'rgba(230, 101, 34)',
                    borderWidth: 1
                },
                {
                    label: 'RA',
                    data: [0, 8, 7],
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
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
                    display: true
                },
                title: {
                    display: true,
                    text: 'Participation in National Activities in Active Agreement'
                }
            }
        }
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: ['AHBS', 'FABU', 'FK', 'FS', 'FSSH', 'FTIR', 'MJIIT'],
            datasets: [
                {
                    label: 'Leader',
                    data: [1, 1, 5, 0, 0, 0, 1],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
                    borderWidth: 1
                },
                {
                    label: 'Member',
                    data: [20, 3, 164, 16, 2, 6, 9],
                    backgroundColor: 'rgba(230, 101, 34)',
                    borderColor: 'rgba(230, 101, 34)',
                    borderWidth: 1
                },
                {
                    label: 'Project Leader',
                    data: [1, 0, 41, 4, 0, 2, 2],
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
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
                    text: 'Staff Participation in National Activities in Active Agreement'
                }
            }
        }
    });

    var bar6 = document.getElementById('bar6');
    var barChart6 = new Chart(bar6, {
        type: 'bar',
        data: {
            labels: ['AHBS', 'FABU', 'FK', 'FS', 'FSSK', 'FTIR', 'MJIIT'],
            datasets: [
                {
                    label: 'Advisory Board',
                    data: [0, 0, 0, 0, 0, 1, 0],
                    backgroundColor: 'rgba(53, 91, 83)',
                    borderColor: 'rgba(53, 91, 83)',
                    borderWidth: 1
                },
                {
                    label: 'Chairman',
                    data: [0, 0, 0, 0, 1, 0, 0],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
                    borderWidth: 1
                },
                {
                    label: 'Commitee',
                    data: [1, 1, 6, 1, 1, 0, 2],
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
                    borderWidth: 1
                },
                {
                    label: 'Member',
                    data: [22, 12, 154, 54, 28, 28, 12],
                    backgroundColor: 'rgba(246, 181, 10)',
                    borderColor: 'rgba(246, 181, 10)',
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
                    text: 'Staff in International Professional Bodies'
                }
            }
        }
    });

    var bar7 = document.getElementById('bar7');
    var barChart7 = new Chart(bar7, {
        type: 'bar',
        data: {
            labels: ['SPACE', 'MJIIT', 'FTIR', 'FSSK', 'FS', 'FK', 'FABU', 'AHBS'],
            datasets: [
                {
                    label: 'Chairman',
                    data: [0, 0, 1, 1, 1, 3, 0, 1],
                    backgroundColor: 'rgba(53, 91, 83)',
                    borderColor: 'rgba(53, 91, 83)',
                    borderWidth: 1
                },
                {
                    label: 'Commitee',
                    data: [0, 3, 4, 6, 12, 19, 5, 2],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
                    borderWidth: 1
                },
                {
                    label: 'Member',
                    data: [1, 4, 12, 47, 88, 86, 43, 32],
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
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
                    text: 'Staff in International Professional Bodies'
                }
            }
        }
    });

    var bar8 = document.getElementById('bar8');
    var barChart8 = new Chart(bar8, {
        type: 'bar',
        data: {
            labels: ['FTIR', 'FSSK', 'FS', 'FK', 'FABU', 'AHBS'],
            datasets: [
                {
                    label: '',
                    data: [4, 3, 2, 9, 7, 1],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            indexAxis: 'y',
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
                    text: 'Number of New Community-Related Research Projects'
                }
            }
        }
    });

    var bar9 = document.getElementById('bar9');
    var barChart9 = new Chart(bar9, {
        type: 'bar',
        data: {
            labels: ['AHBS', 'FABU', 'FK', 'FS', 'FSSK', 'FTIR'],
            datasets: [
                {
                    label: 'Star Rating 3',
                    data: [1, 6, 12, 1, 7, 5],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
                    borderWidth: 1
                },
                {
                    label: 'Star Rating 4',
                    data: [0, 1, 7, 3, 4, 5],
                    backgroundColor: 'rgba(235, 100, 30)',
                    borderColor: 'rgba(235, 100, 30)',
                    borderWidth: 1
                },
                {
                    label: 'Star Rating 5',
                    data: [1, 1, 5, 1, 3, 2],
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
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
                    text: 'Number of Communities Benefiting The Knowledge/Technology Projects'
                }
            }
        }
    });

    var bar10 = document.getElementById('bar10');
    var barChart10 = new Chart(bar10, {
        type: 'bar',
        data: {
            labels: ['MJIIT', 'FTIR', 'FS', 'FK', 'AHBS'],
            datasets: [
                {
                    label: '',
                    data: [2, 3, 2, 20, 1],
                    backgroundColor: 'rgba(235, 100, 30)',
                    borderColor: 'rgba(235, 100, 30)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            indexAxis: 'y',
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
                    text: 'Joint Research Projects between Institution'
                }
            }
        }
    });

    var bar11 = document.getElementById('bar11');
    var barChart11 = new Chart(bar11, {
        type: 'bar',
        data: {
            labels: ['AHBS', 'FK', 'FTIR'],
            datasets: [
                {
                    label: '',
                    data: [1, 4, 1],
                    backgroundColor: 'rgba(95, 160, 55)',
                    borderColor: 'rgba(95, 160, 55)',
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
                    text: 'Joint Research Projects between Research Universities'
                }
            }
        }
    });
</script>
@endsection
@endcomponent