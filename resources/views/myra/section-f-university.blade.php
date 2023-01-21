@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section F: Professional Services and Gifts @endslot
@slot("submoduleLink") myra.section-f @endslot
@section('custom-css')
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
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        Section F: Professional Services and Gifts
    </h2>
</div>
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-f/UNIVERSITY"/>

<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F1(a) - <b>TRAINING COURSES</b></span><br><div id="bar1"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F1(b) - <b>PG FEES</b></span><br><div id="bar2"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F2 - <b>CONFERENCE, SEMINAR</b></span><br><div id="bar3"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F3 - <b>PRODUCT COMM & LICENSING</b></span><br><div id="bar4"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F4a - <b>CONSULTANCY</b></span><br><div id="bar5"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F4c - <b>LAB SERVICES</b></span><br><div id="bar6"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F5 - <b>ENDOWMENT</b></span><br><div id="bar7"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F5b - <b>INCOME/DIVIDEND FROM EXISTING ENDOWMENT</b></span><br><div id="bar9"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F6 - <b>GIFTS/DONATIONS</b></span><br><div id="bar8"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. F7 - <b>PERCENTAGE OF OPERATIONAL EXPENDITURE FOR R&D DEVELOPMENT</b></span><br><div id="bar10"></div></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var data = {!! json_encode($data) !!};
    console.log(data);
    Highcharts.setOptions({
        title: {
            text: ''
        },
        tooltip: {
            shared: true,
            formatter: function () {
                return this.points.reduce(function (s, point) {
                    return s + '<br/>' + point.series.name + ': <b>' +
                        Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(point.y) + '</b>';
                }, '<b>' + this.x + '</b>');
            }
        },
        legend: {
            useHTML: true,
            symbolWidth:0,
            labelFormatter: function() {
                var legend = '';
                if (this.name == 'ACHIEVEMENT') {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/legendA.png" class="custom-legend-img" width="20" height="20"/>';
                } else if (this.name == '100% TARGET') {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/legendH.png" class="custom-legend-img" width="20" height="20"/>';
                } else {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/legendE.png" class="custom-legend-img" width="20" height="20"/>';
                }
                return legend + '<span>' + this.name + '</span></div>';
            }
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'Amount (RM)'
            },
            labels: {
                format: 'RM {text}'
            },
            gridLineWidth: 0
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                        return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(this.y);
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
    
    var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar1',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_1.data_2, data.bar_1.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_1.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_1.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar2',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_2.data_2, data.bar_2.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_2.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_2.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart3 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar3',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_3.data_2, data.bar_3.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_3.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_3.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart4 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar4',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_4.data_2, data.bar_4.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_4.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_4.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart5 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar5',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_5.data_2, data.bar_5.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_5.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_5.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart6 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar6',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_6.data_2, data.bar_6.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_6.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_6.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart7 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar7',
            type: 'column'
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_7.data_2, data.bar_7.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_7.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_7.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart8 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar8',
            type: 'column'
        },
        yAxis: {
            type: 'logarithmic',
            max: 100000000
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_8.data_2, data.bar_8.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_8.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_8.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart9 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar9',
            type: 'column'
        },
        yAxis: {
            type: 'logarithmic',
            max: 100000000
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: data.bar_9.data_1,
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
    
    var chart10 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar10',
            type: 'column'
        },
        yAxis: {
            type: 'logarithmic',
            max: 100000000
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_10.data_2, data.bar_10.data_1, '#b9dba5', '#c0beff'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_10.data_2, '#6600cc', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, data.bar_10.data_3, '#6600cc', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 2,
            }
        },
    });
</script>
@endsection
@endcomponent