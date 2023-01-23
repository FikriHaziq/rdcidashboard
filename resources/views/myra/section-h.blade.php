@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section H: Support Facilities @endslot
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
    Section H: Support Facilities
</h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-h"/>

<div class="tab-contet box mt-5">
<div class="tab-pane leading-relaxed p-5 active">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="p-5 text-center"><span>SEC. H1 - <b>LABORATORIES/RESEARCH FACILITIES ACCREDITED</b></span><br><div id="bar1"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="p-5 text-center"><span>SEC. H2 - <b>LIBRARY FACILITIES</b></span><br><div id="bar2"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="p-5 text-center"><span><b>NUMBER OF TITLES OF BOOKS</b></span><br><div id="bar4"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="p-5 text-center"><span><b>NUMBER OF ONLINE TITLES OF BOOKS</b></span><br><div id="bar5"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="p-5 text-center"><span><b>NUMBER OF TITLES OF JOURNALS SUBSCRIBED</b></span><br><div id="bar3"></div></div>
        </div>
        <div class="col-md-6 col-sm-12 mb-5">
            <div class="p-5 text-center"><span><b>NUMBER OF TITLES OF ONLINE JOURNALS SUBSCRIBED</b></span><br><div id="bar6"></div></div>
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
        legend: {
            useHTML:true,
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
        tooltip: {
            shared: true
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Laboratory/Research Facilities'
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
                data: targetedData(data.year_range, data.bar_1.data_2, '#000000', 'sollid'),
                pointWidth: 45
            },
        ],
    });

    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar2',
            type: 'column'
        },
        legend: {
            useHTML:true,
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
        tooltip: {
            shared: true
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Titles'
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
            shared: true
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Titles'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: data.bar_3.data_1,
                pointWidth: 45,
                color: '#03c03c'
            },
        ],
    });

    var chart4 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar4',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Titles'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: data.bar_4.data_1,
                pointWidth: 45,
                color: '#03c03c'
            },
        ],
    });

    var chart5 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar5',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Titles'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: data.bar_5.data_1,
                pointWidth: 45,
                color: '#03c03c'
            },
        ],
    });

    var chart6 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar6',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Titles'
            },
            gridLineWidth: 0
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: data.bar_6.data_1,
                pointWidth: 45,
                color: '#03c03c'
            },
        ],
    });
</script>
@endsection
@endcomponent