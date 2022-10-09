@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section C: Quantity and Quality of Research @endslot
@slot("submoduleLink") myra.section-c @endslot
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section C: Quantity and Quality of Research
    </h2>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar1" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-stretch"><canvas id="mixed" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar2" width="800"></canvas></div>
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
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-stretch"><canvas id="bar5" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar6" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-center"><canvas id="bar7" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body d-flex align-items-center"><canvas id="bar8" width="800"></canvas></div>
        </div>
    </div>
    <div class="g-col-8 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="card-body d-flex align-items-stretch align-items-center font-weight-bold">
                BILANGAN & PERATUSAN STAF TERLIBAT DALAM PENERBITAN MENGIKUT TAHUN: TERLIBAT VS. TIDAK TERLIBAT<br>
                TOP 10: STAF YANG MEMPUNYAI BILANGAN PENERBITAN DALAM Q1Q2 JURNAL (MAIN AUTHOR)<br>
                BILANGAN & PERATUSAN STAF YANG TIADA PENERBITAN BERINDEKS (CORRESPONDING/UTM 1ST AUTHOR) DALAM TEMPOH 3 TAHUN TERAKHIR<br>
                UTM TOP CITED PAPER
            </div>
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
                    display: false
                },
                title: {
                    display: true,
                    text: 'Books, Chapters & Case Studies'
                }
            }
        }
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: ['2019', '2020'],
            datasets: [
                {
                    label: 'Research Books - Indexed',
                    data: [intRand(1), intRand(0)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'Research Books - Non-Indexed',
                    data: [intRand(25), intRand(15)],
                    backgroundColor: 'rgba(230, 130, 34)',
                    borderColor: 'rgba(230, 130, 34)',
                    borderWidth: 1
                },
                {
                    label: 'Book Chapters - Indexed',
                    data: [intRand(64), intRand(47)],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
                {
                    label: 'Book Chapters - Non-Indexed',
                    data: [intRand(108), intRand(184)],
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
                    text: 'Books, Chapters: Indexed vs Non-Indexed'
                }
            }
        }
    });

    var bar6 = document.getElementById('bar6');
    var barChart6 = new Chart(bar6, {
        type: 'bar',
        data: {
            labels: ['2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020'],
            datasets: [
                {
                    label: 'Trend',
                    data: [intRand(4), intRand(16), intRand(23), intRand(12), intRand(8), intRand(9), intRand(5), intRand(8)],
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
                },
                title: {
                    display: true,
                    text: 'Policy Papers'
                }
            }
        }
    });

    var bar7 = document.getElementById('bar7');
    var barChart7 = new Chart(bar7, {
        type: 'bar',
        data: {
            labels: ['2019', '2020'],
            datasets: [
                {
                    label: 'Trend',
                    data: [intRand(489), intRand(432)],
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
                },
                title: {
                    display: true,
                    text: 'MyCITE'
                }
            }
        }
    });

    var bar8 = document.getElementById('bar8');
    var barChart8 = new Chart(bar8, {
        type: 'bar',
        data: {
            labels: ['2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020'],
            datasets: [
                {
                    label: 'Non-Indexed Publication',
                    data: [intRand(2361), intRand(1892), intRand(1912), intRand(2293), intRand(1847), intRand(1731), intRand(2060), intRand(1308)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'Other Publication',
                    data: [intRand(728), intRand(493), intRand(535), intRand(556), intRand(590), intRand(420), intRand(441), intRand(541)],
                    backgroundColor: 'rgba(230, 130, 34)',
                    borderColor: 'rgba(230, 130, 34)',
                    borderWidth: 1
                }
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
                    text: 'Other Publications'
                }
            }
        }
    });
</script>
@endsection
@endcomponent