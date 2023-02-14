@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B: Quantity and Quality of Researchers @endslot
@slot("trimoduleLink") myra.section-b @endslot
@slot("trimodule") Principal Investigators @endslot
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
        Section B: Quantity and Quality of Researchers - Principal Investigators
    </h2>
</div>
<!-- BEGIN: Wizard Layout -->
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" :schoolCode="$school" endpoint="myra/section-b/INVESTIGATOR"/>
                                    
<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'INVESTIGATOR', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Principal Investigator</a>
            </li>
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-b', ['tabs'=>'COHORT', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Qualification & Cohort</a>
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
                <div class="p-5 text-center"><span>SEC. B1 - <b>STAFF INVOLVED AS PRINCIPAL INVESTIGATOR</b></span><br><canvas id="line1"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B1 - <b>PRINCIPAL INVESTIGATORS</b></span><br><canvas id="line2"></canvas></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B1a - <b>PI-UNIVERSITY: ACHIEVEMENT VS TARGET</b></span><br><div id="bar3"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B1b - <b>PI-NATIONAL: ACHIEVEMENT VS TARGET</b></span><br><div id="bar2"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B1c - <b>PI-PRIVATE: ACHIEVEMENT VS TARGET</b></span><br><div id="bar4"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. B1d - <b>PI-INTERNATIONAL: ACHIEVEMENT VS TARGET</b></span><br><div id="bar1"></div></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>

    var data = {!! json_encode($data) !!};

    const lineOptions = {
        responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRot',
                    }
                }
            },
            stacked: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    min: 0,
                    title: {
                        display: true,
                        text: 'No. of Staff'
                    }
                },
            }
    };

    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'PI',
                    data: data.line_1.data_1,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'NON-PI',
                    data: data.line_1.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
            ]
        },
        options: lineOptions,
    });

    var line2 = document.getElementById('line2');
    var lineChart2 = new Chart(line2, {
        type: 'line',
        data: {
            labels: data.year_range,
            datasets: [
                {
                    label: 'UNIVERSITY',
                    data: data.line_2.data_3,
                    borderColor: ['rgb(95, 160, 56)'],
                    backgroundColor: ['rgb(95, 160, 56)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'NATIONAL',
                    data: data.line_2.data_2,
                    borderColor: ['rgb(230, 104, 38)'],
                    backgroundColor: ['rgb(230, 104, 38)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'PRIVATE',
                    data: data.line_2.data_4,
                    borderColor: ['rgb(253, 180, 7)'],
                    backgroundColor: ['rgb(253, 180, 7)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
                {
                    label: 'INTERNATIONAL',
                    data: data.line_2.data_1,
                    borderColor: ['rgb(53, 92, 183)'],
                    backgroundColor: ['rgb(53, 92, 183)'],
                    tension: 0.1,
                    pointStyle: 'rectRot',
                    pointRadius: 5,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRot',
                    }
                }
            },
            stacked: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'No. of PI'
                    }
                },
            }
        },
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
                text: 'No. of PI'
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
    });

    console.log('url(rdcidashboard.utm.my/images/e-legend.png)');

    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar2',
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
                text: 'No. of PI'
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
    });
    
    var chart3 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar3',
            type: 'column'
        },
        tooltip: {
            shared: true,
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of PI'
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
                data: targetedData(data.year_range, doubleRatioTarget(data.bar_3.data_2), '#000000', 'solid'),
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
            shared: true,
        },
        xAxis: {
            categories: data.year_range,
            title: {
                text: 'Year'
            }
        },
        yAxis: {
            title: {
                text: 'No. of PI'
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
                data: targetedData(data.year_range, data.bar_4.data_2, '#000000', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, doubleRatioTarget(data.bar_4.data_2), '#000000', 'solid'),
                pointWidth: 45
            },
        ],
    });
</script>
@endsection
@endcomponent