@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section D: Quantity and Quality of Postgraduates @endslot
@slot("trimoduleLink") myra.section-d @endslot
@slot("trimodule") Enrollment @endslot
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
        Section D: Quantity and Quality of Postgraduates - Enrollment
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" :schoolCode="$school" endpoint="myra/section-d/ENROLLMENT"/>
                                    
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-d', ['tabs'=>'ABSORPTION','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Postgraduates</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-d', ['tabs'=>'ABSORPTION','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Enrollment</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D5 - <b>% OF INTERNATIONAL POSTGRADUATES ENROLLED</b></span><br><div id="bar1"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D6 - <b>% OF POSTGRADUATES ENROLLED WITH CGPA ≥ 3.00</b></span><br><div id="bar2"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D7 - <b>% OF POSTGRADUATES ENROLLED WITH FELLOWSHIP/GRANTS</b></span><br><div id="bar3"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. D8 - <b>POSTDOCTORAL APPOINTMENT</b></span><br><div id="bar4"></div></div>
            </div>
            <!-- <div class="col-md-12 mb-5">
                <div id="container" style="width:100%; height:400px;"></div>
            </div> -->
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var data = {!! json_encode($data) !!};

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
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/h-legend.png" class="custom-legend-img" width="20" height="20"/>';
                } else {
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

    var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar1',
            type: 'column'
        },
        tooltip: {
            shared: true,
            formatter: function () {
                return this.points.reduce(function (s, point) {
                    return s + '<br/>' + point.series.name + ': <b>' +
                        point.y.toFixed(2) + '%</b>';
                }, '<b>' + this.x + '</b>');
            }
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
                text: 'Percentage (%)'
            },
            labels: {
                format: '{text}%'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_1.data_2, data.bar_1.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_1.data_2, '#000000', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, doubleTarget(data.bar_1.data_2), '#000000', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                dataLabels: {
                    // format: '{y}%',
                    formatter: function () {
                        return Highcharts.numberFormat(this.y,2) + '%';
                    }
                }
            }
        }
    });

    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar2',
            type: 'column'
        },
        tooltip: {
            shared: true,
            formatter: function () {
                return this.points.reduce(function (s, point) {
                    return s + '<br/>' + point.series.name + ': <b>' +
                        point.y.toFixed(2) + '%</b>';
                }, '<b>' + this.x + '</b>');
            }
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
                text: 'Percentage (%)'
            },
            labels: {
                format: '{text}%'
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
                data: targetedData(data.year_range, data.bar_2.data_2, '#000000', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, doubleTarget(data.bar_2.data_2), '#000000', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                dataLabels: {
                    formatter: function () {
                        return Highcharts.numberFormat(this.y,2) + '%';
                    }
                }
            }
        }
    });
    
    var chart3 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar3',
            type: 'column'
        },
        tooltip: {
            shared: true,
            formatter: function () {
                return this.points.reduce(function (s, point) {
                    return s + '<br/>' + point.series.name + ': <b>' +
                        point.y.toFixed(2) + '%</b>';
                }, '<b>' + this.x + '</b>');
            }
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
                text: 'Percentage (%)'
            },
            labels: {
                format: '{text}%'
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
                data: targetedData(data.year_range, data.bar_3.data_2, '#000000', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, doubleTarget(data.bar_3.data_2), '#000000', 'solid'),
                pointWidth: 45
            },
        ],
        plotOptions: {
            column: {
                dataLabels: {
                    formatter: function () {
                        return Highcharts.numberFormat(this.y,2) + '%';
                    }
                }
            }
        }
    });

    var chart4 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar4',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        legend: {
            symbolRadius: 0,
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
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'Postdoctoral Appointment'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_4.data_2, data.bar_4.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_4.data_2, '#000000', 'solid'),
                pointWidth: 45
            },
        ],
    });
</script>
@endsection
@endcomponent