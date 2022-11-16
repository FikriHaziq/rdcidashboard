@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section E: Innovation @endslot
@slot("submoduleLink") myra.section-e @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
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
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section E: Innovation
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-e"/>

{{-- <div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5 box p-5">
    <div class="w-full w-md-auto me-2 me-sm-2">
        <label for="" class="form-label">FACULTY</label>
        <select data-placeholder="Select faculty" class="tom-select w-full" multiple>
            @foreach (getFaculty() ?? [] as $faculty_data)
                <option value="{{ $faculty_data->code }}" @if($faculty==$faculty_data->code) selected @endif>{{ $faculty_data->short }} - {{ $faculty_data->long }}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full w-md-auto me-2 me-sm-2">
        <label>ALL FACULTY</label>
        <div class="form-check form-switch mt-2">
            <input id="checkbox-switch-7" class="form-check-input" type="checkbox">
            <label class="form-check-label" for="checkbox-switch-7">SELECT ALL FACULTY</label>
        </div>
    </div>
    <div class="w-full w-md-auto me-2 me-sm-2">
        <label class="form-label">START YEAR</label>
        <select id="start_year" class="form-select bg-white" onchange="getList('start_year', 'end_year')">
            @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
            <option value="{{$i}}" @if((int)$start_year===(int)$i) selected @endif>{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="w-full w-md-auto me-2 me-sm-2">
        <label class="form-label">END YEAR</label>
        <select id="end_year" class="form-select bg-white" onchange="getList('start_year', 'end_year')">
            @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
            <option value="{{$i}}" @if((int)$end_year===(int)$i) selected @endif>{{$i}}</option>
            @endfor
        </select>
    </div>
</div> --}}
<div class="p-5">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">PATENT GRANTED</span><br><canvas id="bar1"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">PATENT FILED</span><br><canvas id="bar2"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">OTHER IPRs</span><br><canvas id="bar3"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">COMMERCIALIZED PRODUCTS</span><br><canvas id="bar4"></canvas></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="box p-5"><span class="font-weight-bold">LICENSING/SOLD OUTRIGHT</span><br><canvas id="bar5"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>

    var data = {!! json_encode($data) !!};

    const customOptions = {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                reverse: 'true',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                }
            },
            // datalabels: {
            //     formatter: (value, ctx) => {
            //         let disable = '';
            //         let sum = 0;
            //         let i = ctx.dataIndex;
            //         let total = ctx.chart.data.datasets[0].data[i];
            //         let percentage = (value*100 / total).toFixed(2)+"%";
            //         if (total == 0) { return disable; }
            //         else { return percentage; }
            //     },
            // }
        },
        scales: {
            x: {
                stacked: true,
            },
            y: {
                beginAtZero: true,
            },
        }
    };

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_1.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_1.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_2.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_2.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar3 = document.getElementById('bar3');
    var barChart3 = new Chart(bar3, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_3.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_3.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar4 = document.getElementById('bar4');
    var barChart4 = new Chart(bar4, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_4.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_4.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });

    var bar5 = document.getElementById('bar5');
    var barChart5 = new Chart(bar5, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '100% TARGET',
                    data: data.bar_5.data_2,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgba(82, 0, 192)',
                    borderWidth: 1,
                    datalabels: {
                        display: false,
                    }
                },
                {
                    label: 'ACHIEVEMENT',
                    data: data.bar_5.data_1,
                    backgroundColor: 'rgb(192, 190, 255)',
                    borderColor: 'rgb(192, 190, 255)',
                    borderWidth: 1,
                    categoryPercentage: 0.75,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                    }
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: customOptions,
    });
</script>
@endsection
@endcomponent