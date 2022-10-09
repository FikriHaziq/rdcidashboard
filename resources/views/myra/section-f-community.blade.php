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
        <a href="{{ route('myra.section-f', 'INCOME') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Income</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'PARTICIPATION') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Participation</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'COMMUNITY') }}" class="nav-link w-full py-2 active-tab" role="tab">Community & Joint Research</a>
    </li>
</ul>
<div class="tab-content box">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar8"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar9"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar10"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar11"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
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
            // indexAxis: 'y',
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
            // indexAxis: 'y',
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