<!-- CKEditor Files -->
<script src="{{ asset('theme/js/app.js') }}"></script>
{{-- <script src="{{ asset('theme/js/ckeditor-balloon-block.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-balloon.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-classic.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-document.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-inline.js') }}"></script> --}}

<!-- Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- Chart JS -->
<script src="{{ asset('theme/js/chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js" integrity="sha512-Tfw6etYMUhL4RTki37niav99C6OHwMDB2iBT5S5piyHO+ltK2YX8Hjy9TXxhE1Gm/TmAV0uaykSpnHKFIAif/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Notifications Plugin -->
{{-- <script src="{{ asset('theme/js/plugins/bootstrap-notify.js') }}"></script> --}}

<!-- Advanced Form Select -->
{{-- <script src="{{ asset('theme/js/plugins/select2.min.js') }}"></script> --}}

<!-- Additional General Script -->
<script>
    // $(document).ready(function() {
    //     $('.select2').select2();
    // });

    // Temporary Random Number Generator
    function intRand(max) {
        return Math.floor(Math.random() * max);
    }

    // return 200% target value
    function doubleTarget(arg) {
        dataValue = [];
        for (i = 0; i < arg.length; i++) {
            value = arg[i] * 2;
            dataValue.push(value);
        }
        return dataValue;
    }

    // return 200% ratio target value
    function doubleRatioTarget(arg) {
        dataValue = [];
        for (i = 0; i < arg.length; i++) {
            value = arg[i] * 2;
            dataValue.push(value.toFixed(2));
        }
        return dataValue;
    }

    // convert data to json with custom color
    function customizedData(yearRange, targetList, baseList, targetColor, baseColor) {
        result = [];
        targetList.forEach((x, i) => {
            result.push({
                x: yearRange[i],
                y: filterString(baseList[i]),
                color: x > baseList[i] ? baseColor : targetColor,
                borderColor: x > baseList[i] ? baseColor : targetColor,
            });
        });
        return result;
    }

    // convert target data to json with custom border
    function targetedData(yearRange, targetList, borderColor, type) {
        result = [];
        targetList.forEach((x, i) => {
            result.push({
                x: yearRange[i],
                y: filterString(x),
                color: 'transparent',
                borderColor: borderColor,
                dashStyle: type != 'solid' ? type : 'solid',
            });
        });
        return result;
    }

    function filterString(arg) {
        if (typeof arg == 'string') {
            return parseInt(arg);
        } else {
            return arg;
        }
    }

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
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/legendA.png" class="custom-legend-img" width="15" height="15"/>';
                } else if (this.name == '100% TARGET') {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/legendH.png" class="custom-legend-img" width="15" height="15"/>';
                } else {
                    legend = '<div class="custom-legend"><img src="https://rdcidashboard.utm.my/images/legendE.png" class="custom-legend-img" width="15" height="15"/>';
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
</script>