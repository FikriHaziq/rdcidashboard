@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section G: Networking and Linkages @endslot
@slot("content")
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar1" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-stretch"><canvas id="bar2" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar3" width="800"></canvas></div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar4" width="800"></canvas></div>
        </div>
    </div>
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
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar8" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar9" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar10" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar11" width="800"></canvas></div>
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
            labels: ['AGENCY', 'INDUSTRY', 'UNIVERSITY'],
            datasets: [
                {
                    label: 'LOA',
                    data: [intRand(5), intRand(1), intRand(5)],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
                    borderWidth: 1
                },
                {
                    label: 'MOA',
                    data: [intRand(16), intRand(14), intRand(20)],
                    backgroundColor: 'rgba(230, 101, 34)',
                    borderColor: 'rgba(230, 101, 34)',
                    borderWidth: 1
                },
                {
                    label: 'MOU',
                    data: [intRand(10), intRand(10), intRand(10)],
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
                    text: 'Participation in International Activities in Active Agreement'
                }
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['AHBS', 'FABU', 'FK', 'FS', 'FSSH', 'FTIR', 'MJIIT'],
            datasets: [
                {
                    label: 'Member',
                    data: [10, 5, 72, 18, 8, 9, 21],
                    backgroundColor: 'rgba(49, 89, 119)',
                    borderColor: 'rgba(49, 89, 119)',
                    borderWidth: 1
                },
                {
                    label: 'Project Leader',
                    data: [1, 1, 29, 1, 1, 1, 16],
                    backgroundColor: 'rgba(235, 100, 30)',
                    borderColor: 'rgba(235, 100, 30)',
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
                    text: 'Staff Participation in International Activities in Active Agreement'
                }
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['Canada', 'Finland', 'Indonesia', 'Japan', 'Singapore', 'Taiwan'],
            datasets: [
                {
                    label: 'Visiting Researcher',
                    data: [0, 0, 1, 3, 1, 0],
                    backgroundColor: 'rgba(75, 136, 203)',
                    borderColor: 'rgba(75, 136, 203)',
                    borderWidth: 1
                },
                {
                    label: 'Training',
                    data: [0, 3, 0, 1, 0, 1],
                    backgroundColor: 'rgba(246, 181, 10)',
                    borderColor: 'rgba(246, 181, 10)',
                    borderWidth: 1
                },
                {
                    label: 'Sabatical Leave',
                    data: [0, 0, 0, 2, 0, 0],
                    backgroundColor: 'rgba(148, 148, 148)',
                    borderColor: 'rgba(148, 148, 148)',
                    borderWidth: 1
                },
                {
                    label: 'Post Doctoral',
                    data: [1, 0, 0, 1, 2, 0],
                    backgroundColor: 'rgba(230, 104, 38)',
                    borderColor: 'rgba(230, 104, 38)',
                    borderWidth: 1
                },
                {
                    label: 'Fellowship',
                    data: [0, 0, 0, 2, 0, 0],
                    backgroundColor: 'rgba(53, 91, 183)',
                    borderColor: 'rgba(53, 91, 183)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Joint Collaborations'
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