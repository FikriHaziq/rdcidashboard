<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6 d-flex">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div id="chart1">
                </div>
            </div>
        </div>
    </div>
    <div class="g-col-6 d-flex">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div id="chart2">
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
                        @foreach ($chart_data['allocations'] as $allocation)
                        <tr>
                            <td class="text-center">{{ $allocation['bpki'] }}</td>
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
@section('custom-js')
@parent
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>
    var chart_data = {!! json_encode($chart_data) !!};
    $('#file-table').DataTable({
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false
    });
    var bar_options1 = {
        series: [
            {
                name: 'Amount',
                type: 'column',
                data: chart_data.bar1_amount
            },
            {
                name: 'Cumulative Amount (Percent)',
                type: 'line',
                data: chart_data.bar1_cumulative
            },
        ],
          chart: {
          type: 'line',
          height: 500,
          stacked: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 3,
          colors: ['#4472C4', '#ED7D31'],
        },
        colors: ['#4472C4', '#ED7D31'],
        title: {
          text: 'BPKI',
          align: 'center',
        },
        xaxis: {
          categories: chart_data.bar1_title,
          tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'Amount',
                axisBorder: {
                    show: true,
                },
                labels: {
                    formatter: function (value) {
                        return value.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
                    }
                },
            },
            {
                seriesName: 'Cumulative Amount (Percent)',
                max: 100,
                opposite: true,
                axisBorder: {
                    show: true,
                },
                labels: {
                    formatter: function (value) {
                        return value + '%';
                    }
                },
            },
            
        ],
        fill: {
          opacity: 1
        },
        tooltip: {
            y:[{
                formatter: function (val) {
                    return val.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
                }
            },
            {
                formatter: function (val) {
                return val + "%"
                }
            }]
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), bar_options1);
    chart1.render();

    var bar_options2 = {
        series: [
            {
                name: 'Amount',
                type: 'column',
                data: chart_data.bar2_amount
            },
            {
                name: 'Cumulative Amount (Percent)',
                type: 'line',
                data: chart_data.bar2_cumulative
            },
        ],
          chart: {
          type: 'line',
          height: 500,
          stacked: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 3,
          colors: ['#4472C4', '#ED7D31'],
        },
        colors: ['#4472C4', '#ED7D31'],
        title: {
          text: 'Program',
          align: 'center',
        },
        xaxis: {
          categories: chart_data.bar2_title,
          tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'Amount',
                axisBorder: {
                    show: true,
                },
                labels: {
                    formatter: function (value) {
                        return value.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
                    }
                },
            },
            {
                seriesName: 'Cumulative Amount (Percent)',
                max: 100,
                opposite: true,
                axisBorder: {
                    show: true,
                },
                labels: {
                    formatter: function (value) {
                        return value + '%';
                    }
                },
            },
            
        ],
        fill: {
          opacity: 1
        },
        tooltip: {
            y:[{
                formatter: function (val) {
                    return val.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
                }
            },
            {
                formatter: function (val) {
                return val + "%"
                }
            }]
        }
    };

    var chart2 = new ApexCharts(document.querySelector("#chart2"), bar_options2);
    chart2.render();

    var pie_options = {
          series: chart_data.pie_expenses,
          chart: {
          type: 'pie',
          width: '100%'
        },
        labels: chart_data.pie_title,
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
        }],
        tooltip: {
            y:{
                formatter: function (val) {
                    return val.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
                }
            }
        }
        };

    var pie = new ApexCharts(document.querySelector("#pie1"), pie_options);
    pie.render();
</script>
@endsection