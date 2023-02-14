@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section G: Networking and Linkages @endslot
@slot("submoduleLink") myra.section-g @endslot
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
        Section G: Networking and Linkages
    </h2>
</div>
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" :schoolCode="$school" endpoint="myra/section-g/STAFFOVERALL"/>

<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-g', ['tabs'=>'STAFFOVERALL','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Staff Participation Overall</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-g', ['tabs'=>'PROJECTOVERALL','search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2" role="tab">Project Overall</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G1a - <b>INTERNATIONAL MoA</b></span><br><div id="bar8"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G1b - <b>STAFF INVOLVED IN INTERNATIONAL MoA</b></span><br><div id="bar1"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G2 - <b>STAFF SENT ABROAD</b></span><br><div id="bar2"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G3a - <b>INTERNATIONAL MEMBERSHIP - STAFF AS MEMBER</b></span><br><div id="bar3"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G3b - <b>INTERNATIONAL MEMBERSHIP - STAFF APOINTED AS COMMITTEE</b></span><br><div id="bar4"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G4a - <b>NATIONAL MoA</b></span><br><div id="bar9"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G4b - <b>STAFF INVOLVED IN NATIONAL MoA</b></span><br><div id="bar5"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G5a - <b>NATIONAL MEMBERSHIP - STAFF AS MEMBER</b></span><br><div id="bar6"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. G5b - <b>NATIONAL MEMBERSHIP - STAFF APOINTED AS COMMITTEE</b></span><br><div id="bar7"></div></div>
            </div>
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
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of Staff'
            },
            gridLineWidth: 0
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
            shared: true
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
        tooltip: {
            shared: true
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_2.data_2, data.bar_2.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_2.data_2, '#000000', 'sollid'),
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
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_3.data_2, data.bar_3.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_3.data_2, '#000000', 'sollid'),
                pointWidth: 45
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
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_4.data_2, data.bar_4.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_4.data_2, '#000000', 'sollid'),
                pointWidth: 45
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
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_5.data_2, data.bar_5.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_5.data_2, '#000000', 'sollid'),
                pointWidth: 45
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
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_6.data_2, data.bar_6.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_6.data_2, '#000000', 'sollid'),
                pointWidth: 45
            },
        ],
    });

    var chart7 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar7',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_7.data_2, data.bar_7.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_7.data_2, '#000000', 'sollid'),
                pointWidth: 45
            },
        ],
    });

    var chart8 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar8',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_8.data_2, data.bar_8.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_8.data_2, '#000000', 'sollid'),
                pointWidth: 45
            },
        ],
    });

    var chart9 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar9',
            type: 'column'
        },
        tooltip: {
            shared: true
        },
        series: [
            {
                name: 'ACHIEVEMENT',
                data: customizedData(data.year_range, data.bar_9.data_2, data.bar_9.data_1, '#03c03c', '#fe0c03'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, data.bar_9.data_2, '#000000', 'sollid'),
                pointWidth: 45
            },
        ],
    });
</script>
@endsection
@endcomponent