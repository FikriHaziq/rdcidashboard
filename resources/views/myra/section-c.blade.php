@component("layouts.app")
@slot("module") UTM Research @endslot
@slot("submodule") Research Overview @endslot
@slot("content")
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar1" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-stretch"><canvas id="mixed" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar2" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
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
            {{-- <div class="card-body d-flex align-items-stretch"><canvas id="mixed" width="800"></canvas></div> --}}
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            {{-- <div class="card-body d-flex align-items-center"><canvas id="bar2" width="800"></canvas></div> --}}
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            {{-- <div class="card-body d-flex align-items-center"><canvas id="bar3" width="800"></canvas></div> --}}
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
            labels: ['2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020'],
            datasets: [
                {
                    label: 'Citations',
                    data: [intRand(29107), intRand(41382), intRand(58871), intRand(46290), intRand(65898), intRand(84447), intRand(97597), intRand(111401)],
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
                    display: true
                },
                title: {
                    display: true,
                    text: 'Five-Year-Citations Trend'
                }
            }
        }
    });

    var mixed = document.getElementById('mixed');
    var mixedChart = new Chart(mixed, {
        data: {
            labels: ['2013','2014','2015','2016','2017','2018','2019','2020', '2021'],
            datasets: [
                {
                    type: 'line',
                    label: 'No Of Project',
                    yAxisID: 'project-axis',
                    data: [732, 1288, 972, 1120, 734, 1078, 1251, 1023, 378],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                },
                {
                    type: 'bar',
                    label: 'Allocation',
                    data: [82466000, 99418000, 91490000, 81964000, 59946000, 98336000, 99297000, 82184000, 39198000],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                }
            ],
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [
                    {
                        display: false,
                        stacked: false,
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
            },
            plugins: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Indexed Publications'
                }
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020'],
            datasets: [
                {
                    label: 'Percentage',
                    data: [intRand(31), intRand(34), intRand(30), intRand(33), intRand(30), intRand(33), intRand(27), intRand(35)],
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
                    display: true
                },
                title: {
                    display: true,
                    text: 'Percentage Q1/Q2'
                }
            }
        }
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: ['2018', '2019', '2020'],
            datasets: [
                {
                    label: 'International',
                    data: [intRand(1131), intRand(1706), intRand(1733)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'National',
                    data: [intRand(928), intRand(999), intRand(1321)],
                    backgroundColor: 'rgba(230, 130, 34)',
                    borderColor: 'rgba(230, 130, 34)',
                    borderWidth: 1
                },
                {
                    label: 'Industrial',
                    data: [intRand(22), intRand(33), intRand(52)],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
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
                    display: true
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
        labels: ['2018', '2019', '2020'],
        datasets: [
            {
                label: 'Research Books',
                data: [intRand(10), intRand(26), intRand(15)],
                backgroundColor: 'rgba(172, 62, 49)',
                borderColor: 'rgba(172, 62, 49)',
                borderWidth: 1
            },
            {
                label: 'Book Chapters',
                data: [intRand(214), intRand(172), intRand(231)],
                backgroundColor: 'rgba(230, 130, 34)',
                borderColor: 'rgba(230, 130, 34)',
                borderWidth: 1
            },
            {
                label: 'Case Studies/Technical Reports',
                data: [intRand(0), intRand(56), intRand(79)],
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
        plugins: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Books, Chapters & Case Studies'
            }
        }
    }
});
</script>
@endsection
@endcomponent