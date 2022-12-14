@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section C: Quantity and Quality of Research @endslot
@slot("trimodule") Funding @endslot
@slot("trimoduleLink") myra.section-c @endslot
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
        Section C: Quantity and Quality of Research
    </h2>
</div>
<x-myra-graph-filter :startYear="$start_year" :endYear="$end_year" :facultyCode="$faculty" endpoint="myra/section-c/FUNDING-ALL"/>

<div class="intro-y pr-1 mt-5">
    <div class="box p-2">
        <ul class="nav nav-pills" role="tablist">
            <li id="friends-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-c', ['tabs'=>'PUBLICATION-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 " role="tab">Publication</a>
            </li>
            <li id="chats-tab" class="nav-item flex-1" role="presentation">
                <a href="{{ route('myra.section-c', ['tabs'=>'FUNDING-ALL', 'search'=>1, 'start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty]) }}" class="nav-link w-full py-2 active" role="tab">Funding</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content box mt-5">
    <div class="tab-pane leading-relaxed p-5 active" role="tabpanel">
        <div class="row">
            @if ($faculty)
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>NEW PUBLIC FUND (UNIVERSITY) APPROVED</b></span><br><div id="bar5"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>NEW PUBLIC FUND (NATIONAL) APPROVED</b></span><br><div id="bar6"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>NEW PRIVATE FUND APPROVED</b></span><br><div id="bar7"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span><b>NEW INTERNATIONAL FUND APPROVED</b></span><br><div id="bar8"></div></div>
            </div>
            @else
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. C2 - <b>NEW FUNDING APPROVED</b></span><br><div id="bar1"></div></div>
            </div>
            @endif
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. C2a - <b>AMOUNT RECEIVED FOR PUBLIC FUND</b></span><br><div id="bar2"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. C2b - <b>AMOUNT RECEIVED FOR PRIVATE FUND</b></span><br><div id="bar3"></div></div>
            </div>
            <div class="col-md-6 col-sm-12 mb-5">
                <div class="p-5 text-center"><span>SEC. C2c - <b>AMOUNT RECEIVED FOR INTERNATIONAL FUND</b></span><br><div id="bar4"></div></div>
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
                text: 'Amount'
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
                name: 'UNIVERSITY',
                data: filterSetString(data.bar_1.data_1),
                pointWidth: 45,
                color: '#5FA038'
            },
            {
                name: 'NATIONAL',
                data: filterSetString(data.bar_1.data_2),
                pointWidth: 45,
                color: '#355CB7'
            },
            {
                name: 'PRIVATE',
                data: filterSetString(data.bar_1.data_3),
                pointWidth: 45,
                color: '#FDB407'
            },
            {
                name: 'INTERNATIONAL',
                data: filterSetString(data.bar_1.data_4),
                pointWidth: 45,
                color: '#949494'
            },
        ],
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
    });

    // var bar2 = document.getElementById('bar2');
    // var barChart2 = new Chart(bar2, {
    //     type: 'bar',
    //     data: {
    //         labels: customLabels,
    //         datasets: [
    //             {
    //                 label: 'MyRA II TARGET (200%)',
    //                 data: data.bar_2.data_4,
    //                 backgroundColor: 'rgba(255, 255, 255, 0)',
    //                 borderColor: 'rgba(44, 73, 26)',
    //                 borderWidth: 1,
    //                 datalabels: {
    //                     formatter: (value, ctx) => {
    //                         return new Intl.NumberFormat('en-MY', {
    //                             style: 'currency',
    //                             currency: 'MYR',
    //                             notation: 'compact',
    //                         }).format(value);
    //                     },
    //                     anchor: 'end',
    //                     align: 'end',
    //                     display: 'auto',
    //                     color: '#2C491A'
    //                 }
    //             },
    //             {
    //                 label: 'MyRA II TARGET (100%)',
    //                 data: data.bar_2.data_3,
    //                 backgroundColor: 'rgba(255, 255, 255, 0)',
    //                 borderColor: 'rgba(44, 73, 26)',
    //                 borderWidth: 0.2,
    //                 datalabels: {
    //                     formatter: (value, ctx) => {
    //                         return new Intl.NumberFormat('en-MY', {
    //                             style: 'currency',
    //                             currency: 'MYR',
    //                             notation: 'compact',
    //                         }).format(value);
    //                     },
    //                     anchor: 'end',
    //                     align: 'end',
    //                     display: 'auto',
    //                     color: '#2C491A'
    //                 }
    //             },
    //             {
    //                 label: 'UNIVERSITY',
    //                 data: data.bar_2.data_1,
    //                 backgroundColor: 'rgb(67, 113, 40)',
    //                 borderColor: 'rgb(67, 113, 40)',
    //                 borderWidth: 1,
    //                 categoryPercentage: 0.78,
    //                 datalabels: {
    //                     formatter: (value, ctx) => {
    //                         return new Intl.NumberFormat('en-MY', {
    //                             style: 'currency',
    //                             currency: 'MYR',
    //                             notation: 'compact',
    //                         }).format(value);
    //                     },
    //                     color: 'rgb(0, 0, 0)',
    //                 }
    //             },
    //             {
    //                 label: 'NATIONAL',
    //                 data: data.bar_2.data_2,
    //                 backgroundColor: 'rgb(185, 219, 165)',
    //                 borderColor: 'rgb(185, 219, 165)',
    //                 borderWidth: 1,
    //                 categoryPercentage: 0.78,
    //                 datalabels: {
    //                     anchor: 'end',
    //                     align: 'bottom',
    //                     formatter: (value, ctx) => {
    //                         let i = ctx.dataIndex;
    //                         let x = ctx.chart.data.datasets[2].data[i];
    //                         let fund = 0;
    //                         if (value >= x) { fund = value - x; }
    //                         else { fund = x - value; }
    //                         return new Intl.NumberFormat('en-MY', {
    //                             style: 'currency',
    //                             currency: 'MYR',
    //                             notation: 'compact',
    //                         }).format(fund);
    //                     },
    //                     color: 'rgb(0, 0, 0)',
    //                 }
    //             },
    //         ]
    //     },
    //     plugins: [ChartDataLabels],
    //     options: {
    //         plugins: {
    //             legend: {
    //                 display: true,
    //                 position: 'bottom',
    //                 reverse: 'true',
    //                 labels: {
    //                     usePointStyle: true,
    //                     pointStyle: 'rectRot',
    //                 }
    //             },
    //             tooltip: {
    //                 enabled: false
    //             }
    //         },
    //         locale: 'en-MY',
    //         scales: {
    //             x: {
    //                 grid: {
    //                     display: false
    //                 },
    //                 title: {
    //                     display: true,
    //                     text: 'Year'
    //                 },
    //                 stacked: true,
    //             },
    //             y: {
    //                 grace: '5%',
    //                 grid: {
    //                     display: false
    //                 },
    //                 title: {
    //                     display: true,
    //                     text: 'Amount'
    //                 },
    //                 beginAtZero: true,
    //                 ticks: {
    //                     callback: (value, index, values) => {
    //                         return new Intl.NumberFormat('en-MY', {
    //                             style: 'currency',
    //                             currency: 'MYR',
    //                             notation: 'compact',
    //                         }).format(value);
    //                     }
    //                 }
    //             },
    //         }
    //     }
    // });

    // console.log(publicFundData(data.year_range, data.bar_2.data_3, filterSetString(data.bar_2.data_2), filterSetString(data.bar_2.data_1), '#b9dba5', '#b9dba5'));
    
    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'bar2',
            type: 'column'
        },
        tooltip: {
            shared: true,
            formatter: function () {
                var a = this.points[1].y;
                var b = this.points[0].y;
                var alt;
                if (a >= b) { alt = a - b; } else { alt = b - a;}
                return this.points.reduce(function (s, point) {
                    if (point.series.name == 'NATIONAL') {
                        return s + '<br/>' + point.series.name + ': <b>' +
                            Intl.NumberFormat('en-MY', {
                                style: 'currency',
                                currency: 'MYR',
                                notation: 'compact',
                            }).format(alt) + '</b>';
                    } else {
                        return s + '<br/>' + point.series.name + ': <b>' +
                            Intl.NumberFormat('en-MY', {
                                style: 'currency',
                                currency: 'MYR',
                                notation: 'compact',
                            }).format(point.y) + '</b>';
                    }
                }, '<b>' + this.x + '</b>');
            }
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
        series: [
            {
                name: 'NATIONAL',
                data: publicFundData(data.year_range, data.bar_2.data_3, filterSetString(data.bar_2.data_2), filterSetString(data.bar_2.data_1), '#b9dba5', '#b9dba5'),
                pointWidth: 45,
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                        // console.log(this);
                        return new Intl.NumberFormat('en-MY', {
                            style: 'currency',
                            currency: 'MYR',
                            notation: 'compact',
                        }).format(this.point.alt);
                    }
                }
            },
            {
                name: 'UNIVERSITY',
                data: customizedData(data.year_range, data.bar_2.data_3, filterSetString(data.bar_2.data_1), '#2B491A', '#2B491A'),
                pointWidth: 45
            },
            {
                name: '100% TARGET',
                data: targetedData(data.year_range, filterSetString(data.bar_2.data_3), '#2B491A', 'dash'),
                pointWidth: 45
            },
            {
                name: '200% TARGET',
                data: targetedData(data.year_range, filterSetString(data.bar_2.data_4), '#2B491A', 'solid'),
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

    // var bar5 = document.getElementById('bar5');
    // var barChart5 = new Chart(bar5, {
    //     type: 'bar',
    //     data: {
    //         labels: customLabels,
    //         datasets: [
    //             {
    //                 label: 'ACHIEVEMENT',
    //                 data: data.bar_5.data_1,
    //                 backgroundColor: 'rgb(253, 180, 7)',
    //                 borderColor: 'rgb(253, 180, 7)',
    //                 borderWidth: 1,
    //                 datalabels: {
    //                     anchor: 'end',
    //                     align: 'top',
    //                 }
    //             },
    //         ]
    //     },
    //     plugins: [ChartDataLabels],
    //     options: basicOptions,
    // });

    // var bar6 = document.getElementById('bar6');
    // var barChart6 = new Chart(bar6, {
    //     type: 'bar',
    //     data: {
    //         labels: customLabels,
    //         datasets: [
    //             {
    //                 label: 'ACHIEVEMENT',
    //                 data: data.bar_6.data_1,
    //                 backgroundColor: 'rgb(21, 164, 63)',
    //                 borderColor: 'rgb(21, 164, 63)',
    //                 borderWidth: 1,
    //                 datalabels: {
    //                     anchor: 'end',
    //                     align: 'top',
    //                 }
    //             },
    //         ]
    //     },
    //     plugins: [ChartDataLabels],
    //     options: basicOptions,
    // });

    // var bar7 = document.getElementById('bar7');
    // var barChart7 = new Chart(bar7, {
    //     type: 'bar',
    //     data: {
    //         labels: customLabels,
    //         datasets: [
    //             {
    //                 label: 'ACHIEVEMENT',
    //                 data: data.bar_7.data_1,
    //                 backgroundColor: 'rgb(19, 160, 236)',
    //                 borderColor: 'rgb(19, 160, 236)',
    //                 borderWidth: 1,
    //                 datalabels: {
    //                     anchor: 'end',
    //                     align: 'top',
    //                 }
    //             },
    //         ]
    //     },
    //     plugins: [ChartDataLabels],
    //     options: basicOptions,
    // });

    // var bar8 = document.getElementById('bar8');
    // var barChart8 = new Chart(bar8, {
    //     type: 'bar',
    //     data: {
    //         labels: customLabels,
    //         datasets: [
    //             {
    //                 label: 'ACHIEVEMENT',
    //                 data: data.bar_8.data_1,
    //                 backgroundColor: 'rgb(230, 104, 38)',
    //                 borderColor: 'rgb(230, 104, 38)',
    //                 borderWidth: 1,
    //                 datalabels: {
    //                     anchor: 'end',
    //                     align: 'top',
    //                 }
    //             },
    //         ]
    //     },
    //     plugins: [ChartDataLabels],
    //     options: basicOptions,
    // });

</script>
@endsection
@endcomponent