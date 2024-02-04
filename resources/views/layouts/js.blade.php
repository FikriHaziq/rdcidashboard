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
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
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

    // only for section c - public fund
    function publicFundData(yearRange, targetList, baseList, bufferList, targetColor, baseColor) {
        result = [];
        targetList.forEach((x, i) => {
            var a = filterString(baseList[i]);
            var b = filterString(bufferList[i]);
            var c;
            if (a >= b) {
                c = a - b;
            } else {
                c = b - a;
            }
            result.push({
                x: yearRange[i],
                y: a,
                alt: c,
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

    function filterSetString(obj) {
        var newSet = [];
        for (i = 0; i < obj.length; i++) {
            newSet.push(filterString(obj[i]));
        }
        return newSet;
    }

    function getYearList(that, route) {
        window.location = route + '/' + that.val();
    }

    // $('[data-toggle="tooltip"]').tooltip();
    tippy('[data-toggle="tooltip"]');
</script>