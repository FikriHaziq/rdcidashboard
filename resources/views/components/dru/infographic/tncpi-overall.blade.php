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
@push('custom-js')
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
    var options1 = {
        series: [
            {
                name: 'Jumlah Peruntukan Kumulatif',
                group: 'allocation_cumulative',
                data: chart_data.bar1_year_allocation_cumulative
            },
            {
                name: 'Peruntukan',
                group: 'allocation',
                data: chart_data.bar1_year_allocation
            }, 
            {
                name: 'Peruntukan Tambahan',
                group: 'allocation',
                data: chart_data.bar1_year_additional_allocation
            },
            {
                name: 'Perbelanjaan',
                group: 'expenses',
                data: chart_data.bar1_year_expenses
            },
            {
                name: 'Agihan Semula',
                group: 'distribution',
                data: chart_data.bar1_year_distribution
            }, 
        ],
          chart: {
          type: 'bar',
          height: 500,
          stacked: true,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
          },
        },
        dataLabels: {
          enabled: false,
        },
        title: {
          text: 'Jumlah Peruntukan Mengikut Tahun',
          align: 'center',
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: chart_data.bar1_year,
        },
        yaxis: {
          title: {
            text: 'RM '
          },
          labels: {
              formatter: function (value) {
                  return value.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
              }
          },
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
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
        }],
        tooltip: {
            y:{
                formatter: function (val) {
                    return val.toLocaleString('en-MY', { style: 'currency', currency: 'MYR' });
                }
            }
        }
        };

    var chart = new ApexCharts(document.querySelector("#pie1"), options);
    chart.render();
</script>
@endpush