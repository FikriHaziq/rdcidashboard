@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B: Quantity and Quality of Researchers @endslot
@slot("trimoduleLink") myra.section-b @endslot
@slot("trimodule") Cohort @endslot
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
    
    .highcharts-legend-item rect{
        display: none;
    }

    .custom-legend > img,
        .custom-legend > span {
            display: inline-block;
    }

    .custom-legend-img {
        padding-bottom: 2px;
        padding-right: 5px;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section B: Quantity and Quality of Researchers - Cohort
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" :schoolCode="$school" endpoint="myra/section-b/COHORT"/>
        
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'INVESTIGATOR', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Principal Investigator</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'COHORT', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Qualification & Cohort</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'AWARD', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Award</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B2a - <b>PhD</b></span><br><div id="bar2"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B2b - <b>PROFESSIONAL QUALIFICATION</b></span><br><div id="bar3"></div></div>
            </div>
            <div class="col-md-12 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B3 - <b>COHORT</b></span><br><canvas id="bar1"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>

    var data = {!! json_encode($data) !!};

    var bar1 = document.getElementById('bar1');
    //Percentage
    var type1_percent = data.bar_1.data_4;
    var type2_percent = data.bar_1.data_5;
    var type3_percent = data.bar_1.data_6;
    var type1_data = data.bar_1.data_1;
    var type2_data = data.bar_1.data_2;
    var type3_data = data.bar_1.data_3;

    console.log(type2_data);
    console.log(type2_percent);

    let type1 = type1_data.map((data, i) => {
        return { "data": type1_data[i], "percent": type1_percent[i] }
    });

    let type2 = type2_data.map((data, i) => {
        return { "data": type2_data[i], "percent": type2_percent[i] }
    });

    let type3 = type3_data.map((data, i) => {
        return { "data": type3_data[i], "percent": type3_percent[i] }
    });

    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: '< 40 years old',
                    data: data.bar_1.data_4,
                    backgroundColor: 'rgba(180, 207, 168)',
                    borderColor: 'rgba(180, 207, 168)',
                    borderWidth: 1
                },
                {
                    label: '40 - 50 years old',
                    data: data.bar_1.data_5,
                    backgroundColor: 'rgb(112, 173, 71)',
                    borderColor: 'rgb(112, 173, 71)',
                    borderWidth: 1
                },
                {
                    label: '> 50 years old',
                    data: data.bar_1.data_6,
                    backgroundColor: 'rgb(91, 142, 57)',
                    borderColor: 'rgb(91, 142, 57)',
                    borderWidth: 1
                },
            ]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRot',
                    }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        let type;
                        let i = ctx.dataIndex;
                        let v1 = ctx.chart.data.datasets[0].data[i];
                        let v2 = ctx.chart.data.datasets[1].data[i];
                        let v3 = ctx.chart.data.datasets[2].data[i];
                        if (value == v1) { type = 1; }
                        else if (value == v2) { type = 2; }
                        else if (value == v3) { type = 3; }
                        switch (type) {
                            case 1:
                                return [type1[i].data];
                                break;
                            case 2:
                                return [type2[i].data];
                                break;
                            case 3:
                                return [type3[i].data];
                                break;
                        }
                    },
                    color: 'rgb(0, 0, 0)',
                    anchor: 'end',
                    align: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            let i = ctx.dataIndex;
                            let label = ctx.dataset.label + ': ' + ctx.dataset.data[i] + '%';
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    },
                    // stacked: true,
                },
                y: {
                    grid: {
                        display: false
                    },
                    // stacked: true,
                    type: 'linear',
                    display: true,
                    position: 'left',
                    // max: 100,
                    grid: {
                        display: false
                    },
                    ticks: {
                        stepSize: 20,
                        callback: ((value, index, ticks) => {
                            return value + '%';
                        })
                    },
                    title: {
                        display: true,
                        text: 'Percentage (%)'
                    }
                },
            }
        }
    });

    Highcharts.setOptions({
        title: {
            text: ''
        },
        legend: {
            useHTML:true,
            symbolWidth:0,
            labelFormatter: function() {
                var legend = '';
                if (this.name == 'ACHIEVEMENT') {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/a-legend.png" class="custom-legend-img" width="20" height="20"/>';
                } else if (this.name == '100% TARGET') {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/e-legend.png" class="custom-legend-img" width="20" height="20"/>';
                }
                return legend + '<span>' + this.name + '</span></div>';
            }
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
                dataLabels: {
                    enabled: true,
                    inside: false,
                    formatter: function () {
                        return Intl.NumberFormat('en-MY').format(this.y);
                    }
                }
            }
        },
        accessibility: {
            enabled: false
        },
        credits: {
            enabled: false
        }
    });

    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar2',
            type: 'column'
        },
        tooltip: {
            shared: true,
        },
        legend: {
            symbolRadius: 0
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Achievement'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_2.data_2, data.bar_2.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_2.data_2, '#000000', 'solid'),
                pointWidth: 45
            },
        ],
    });

    var chart3 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar3',
            type: 'column'
        },
        tooltip: {
            shared: true,
        },
        legend: {
            symbolRadius: 0
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Achievement'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_3.data_2, data.bar_3.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_3.data_2, '#000000', 'solid'),
                pointWidth: 45
            },
        ],
    });
</script>
@endsection
@endcomponent