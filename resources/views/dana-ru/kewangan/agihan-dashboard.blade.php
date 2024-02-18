@component("layouts.app")
@slot("module") Agihan Program @endslot
@section('custom-css')
<link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
    <h2 class="fs-lg fw-medium truncate me-5">
        AGIHAN PROGRAM
    </h2>
</div>
<div class="intro-y row mt-5">
    <div class="col-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-6 box p-5 cursor-pointer zoom-in" style="background-color: #4AC4D2">
                <div class="fw-medium fs-base text-white">Belanja</div>
                <div class="fw-bold fs-lg text-white">RM {{ number_format($chart_data['total_expenses'], 2, '.', ',') }}</div>
            </div>
            <div class="g-col-6 box p-5 cursor-pointer zoom-in" style="background-color: #8430CE;">
                <div class="fw-medium fs-base text-white">Agihan</div>
                <div class="fw-bold fs-lg text-white">RM {{ number_format($chart_data['total_allocation'], 2, '.', ',') }}</div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-6">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>TITLE</option>
                        @foreach ($title_options as $title)
                        <option>{{ strtoupper($title->jenis_agihan) }}</option>
                        @endforeach
                    </select>
                </div>     
            </div>
            <div class="col-6">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>All</option>
                        @foreach ($year_options as $year)
                        <option>{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>     
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-12 d-flex">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div id="chart1">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card w-full p-5">
            <div class="intro-y overflow-x-auto overflow-y-auto mt-8 mt-sm-0">
                <table class="table table-bordered table-hover" id="file-table">
                    <thead>
                        <tr style="background-color: #1C3FAA; color: white">
                            <th class="whitespace-nowrap">BPKI</th>
                            <th class="whitespace-nowrap">PROGRAM</th>
                            <th class="whitespace-nowrap">PROGRAM</th>
                            <th class="whitespace-nowrap">TITLE</th>
                            <th class="whitespace-nowrap">ALLOCATION (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allocations as $allocation)
                        <tr>
                            <td class="text-center" back>{{ $allocation['bpki'] }}</td>
                            <td class="text-center">{{ $allocation['program'] }}</td>
                            <td class="text-center">{{ $allocation['tabung_induk'] }}</td>
                            <td class="text-center">{{ $allocation['jenis_agihan'] }}</td>
                            @php
                                $colorAmount = getColorAmount($allocation['amount']);
                            @endphp
                            <td class="text-center" style="background-color: rgb(132, 48, 206, {{ $colorAmount['opacity'] }}); color: {{ $colorAmount['text_color'] }}">{{ number_format($allocation['amount'], 2, '.', ',') }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{-- <table class="table table-bordered">
                    <thead class="table-dark border-b-0">
                        <tr>
                            <th class="text-nowrap">BPKI</th>
                            <th class="text-nowrap">PROGRAM UTAMA</th>
                            <th class="text-nowrap">KOD PROGRAM</th>
                            <th class="text-nowrap">TITLE</th>
                            <th class="text-nowrap">ALLOCATION</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @for ($i = 1; $i < 5; $i++)
                        <tr>
                            <td class="text-center">DO</td>
                            <td class="text-center">TD</td>
                            <td class="text-center">21A1.00A00</td>
                            <td class="text-center">SKIM ZAMALAH</td>
                            <td class="text-center">134.279 M</td>
                        </tr>
                        <tr>
                            <td class="text-center">DO</td>
                            <td class="text-center">TD</td>
                            <td class="text-center">21A1.00A00</td>
                            <td class="text-center">SKIM ZAMALAH</td>
                            <td class="text-center">134.279 M</td>
                        </tr>
                        @endfor
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div id="pie1"></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
    var chart_data = {!! json_encode($chart_data) !!};
    console.log(chart_data);
    $('#file-table').DataTable({
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false
    });
    var options1 = {
          series: [{
          name: 'Allocation',
          data: chart_data.bar1_allocation
        }, {
          name: 'Expenses',
          data: chart_data.bar1_expenses
        }],
          chart: {
          type: 'bar',
          height: 500
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: chart_data.bar1_title,
        },
        yaxis: {
          title: {
            text: 'RM '
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "RM " + val
            }
          }
        }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();

    var options = {
          series: chart_data.bar1_expenses,
          chart: {
          type: 'pie',
          width: '100%'
        },
        labels: chart_data.bar1_title,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var chart = new ApexCharts(document.querySelector("#pie1"), options);
    chart.render();
</script>
@endsection
@endcomponent