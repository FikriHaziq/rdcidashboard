@component("layouts.app")
@slot("module") Peruntukan Keseluruhan @endslot
@section('custom-css')
<link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@slot("content")
<div class="intro-y d-block d-sm-flex align-items-center h-10 mt-5">
    <h2 class="fs-lg fw-medium truncate me-5">
        PERUNTUKAN KESELURUHAN
    </h2>
</div>
<div class="intro-y row mt-5">
    <div class="col-8">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-6 box p-5 cursor-pointer zoom-in" style="background-color: #8430CE;">
                <div class="fw-medium fs-base text-white">Jumlah Peruntukan KPT</div>
                <div class="fw-bold fs-lg text-white">RM {{ number_format($chart_data['total_allocation'], 2, '.', ',') }}</div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card" style="width: 100%">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 text-center">
                <h2 class="font-medium text-base mr-auto" style="font-size: 20px">Peruntukan Dana RU</h2>
            </div>
            <div class="card-body">
                <div id="bar1"></div>
            </div>
            <hr class="mb-5" style="border: 1px solid black">
            <div class="card-body" style="margin-left:150px; margin-right:150px;">
                <div id="pie1"></div>
            </div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card" style="width: 100%">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 text-center">
                <h2 class="font-medium text-base mr-auto" style="font-size: 20px">Peruntukan KPT Program</h2>
            </div>
            <div class="card-body">
                <div id="bar2"></div>
            </div>
            <hr class="mb-5" style="border: 1px solid black">
            <div class="card-body">
                <div id="pie2"></div>
            </div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card" style="width: 100%">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 text-center">
                <h2 class="font-medium text-base mr-auto" style="font-size: 20px">Peruntukan KPT BPKI</h2>
            </div>
            <div class="card-body">
                <div id="bar3"></div>
            </div>
            <hr class="mb-5" style="border: 1px solid black">
            <div class="card-body">
                <div id="pie3"></div>
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
        series: [
            {
                name: 'KPT',
                data: chart_data.bar1_kpt
            }, 
            {
                name: 'Pelarasan',
                data: chart_data.bar1_pelarasan
            }
        ],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar:{
                horizontal: false,
                borderRadius: 10,
                dataLabels: {
                    enabled: false,
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: chart_data.bar1_title,
        },
        legend: {
            position: 'top',
        },
        fill: {
            opacity: 1
        }
    };

    var bar1 = new ApexCharts(document.querySelector("#bar1"), options1);
    bar1.render();

    var options2 = {
          series: chart_data.pie1_value,
          chart: {
          type: 'donut',
          width: '100%'
        },
        labels: chart_data.bar1_title,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 100
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var pie1 = new ApexCharts(document.querySelector("#pie1"), options2);
    pie1.render();

    var options3 = {
          series: [{
          name: 'Allocation',
          data: chart_data.bar2_expenses
        }, {
          name: 'Expenses',
          data: chart_data.bar2_allocations
        }],
          chart: {
          type: 'bar',
          height: '100%'
        },
        plotOptions: {
          bar: {
            horizontal: false,
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
          categories: chart_data.bar2_title,
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

    var bar2 = new ApexCharts(document.querySelector("#bar2"), options3);
    bar2.render();

    var options4 = {
          series: chart_data.pie2_value,
          chart: {
          type: 'donut',
          width: '100%'
        },
        labels: chart_data.bar2_title,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 100
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var pie2 = new ApexCharts(document.querySelector("#pie2"), options4);
    pie2.render();

    var options5 = {
          series: [{
          name: 'Allocation',
          data: chart_data.bar3_expenses
        }, {
          name: 'Expenses',
          data: chart_data.bar3_allocations
        }],
          chart: {
          type: 'bar',
          height: '100%'
        },
        plotOptions: {
          bar: {
            horizontal: false,
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
          categories: chart_data.bar3_title,
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

    var bar3 = new ApexCharts(document.querySelector("#bar3"), options5);
    bar3.render();

    var options6 = {
          series: chart_data.pie3_value,
          chart: {
          type: 'donut',
          width: '100%'
        },
        labels: chart_data.bar3_title,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 100
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var pie3 = new ApexCharts(document.querySelector("#pie3"), options6);
    pie3.render();
</script>
@endsection
@endcomponent