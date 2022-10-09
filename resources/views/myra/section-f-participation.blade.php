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
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">FACULTY</div>
            <select class="form-select bg-white">
                <option value="">All</option>
                {{-- @foreach ($data->faculties ?? [] as $faculty)
                <option value="{{ $faculty->faculty }}">{{ $faculty->faculty }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group me-2 me-sm-2">
            <div class="input-group-text bg-theme-1 text-white">START YEAR</div>
            <select id="start_year" class="form-select bg-white" onchange="getList('start_year', 'end_year')">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$start_year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="w-full w-md-auto d-flex">
        <div class="input-group">
            <div class="input-group-text bg-theme-1 text-white">END YEAR</div>
            <select id="end_year" class="form-select bg-white" onchange="getList('start_year', 'end_year')">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$end_year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
<ul class="nav nav-link-tabs mt-5" role="tablist">
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'INCOME') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Income</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'PARTICIPATION') }}" class="nav-link w-full py-2 active-tab" role="tab">Participation</a>
    </li>
    <li class="nav-item flex-1" role="presentation">
        <a href="{{ route('myra.section-f', 'COMMUNITY') }}" class="nav-link w-full py-2 inactive-tab" role="tab">Community & Joint Research</a>
    </li>
</ul>
<div class="tab-content box">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar4"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar5"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar6"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5"><canvas id="bar7"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    function getList(start, end) {
        var start_year = $('#'+start).val();
        var end_year = $('#'+end).val();
        window.location = window.location.origin + '/myra/section-f?search=1&start_year=' + start_year + '&end_year=' + end_year;
    }
    var data = {!! json_encode($data) !!};

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
</script>
@endsection
@endcomponent