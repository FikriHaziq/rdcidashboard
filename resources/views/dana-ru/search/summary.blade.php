{{-- Summary tiles + BPKI split, filled by renderSummary() from the datatable response (json.summary) --}}
<div class="intro-y grid grid-cols-12 gap-4 mt-5">
    <div class="g-col-12 g-col-sm-6 g-col-xl-3">
        <div class="box stat-tile p-5">
            <div class="stat-icon stat-icon-teal"><i data-feather="dollar-sign" class="w-5 h-5"></i></div>
            <div>
                <div class="stat-label">{{ $total_label }}</div>
                <div class="stat-value" id="summary_total">—</div>
                <div class="stat-sub" id="summary_years">&nbsp;</div>
            </div>
        </div>
    </div>
    <div class="g-col-12 g-col-sm-6 g-col-xl-3">
        <div class="box stat-tile p-5">
            <div class="stat-icon stat-icon-navy"><i data-feather="list" class="w-5 h-5"></i></div>
            <div>
                <div class="stat-label">RECORDS</div>
                <div class="stat-value" id="summary_records">—</div>
                <div class="stat-sub">{{ $records_sub }}</div>
            </div>
        </div>
    </div>
    <div class="g-col-12 g-col-sm-6 g-col-xl-3">
        <div class="box stat-tile p-5">
            <div class="stat-icon stat-icon-purple"><i data-feather="home" class="w-5 h-5"></i></div>
            <div>
                <div class="stat-label">PTJ</div>
                <div class="stat-value" id="summary_ptj">—</div>
                <div class="stat-sub">{{ $ptj_sub }}</div>
            </div>
        </div>
    </div>
    <div class="g-col-12 g-col-sm-6 g-col-xl-3">
        <div class="box stat-tile p-5">
            <div class="stat-icon stat-icon-orange"><i data-feather="layers" class="w-5 h-5"></i></div>
            <div>
                <div class="stat-label">{{ $programmes_label ?? 'JENIS AGIHAN' }}</div>
                <div class="stat-value" id="summary_programmes">—</div>
                <div class="stat-sub">{{ $programmes_sub ?? 'distinct programmes' }}</div>
            </div>
        </div>
    </div>
</div>

<div class="intro-y box p-5 mt-4">
    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
        <div class="stat-label mb-0">{{ $split_title }}</div>
        <div class="ms-auto d-flex flex-wrap gap-3" id="bpki_legend"></div>
    </div>
    <div class="bpki-split" id="bpki_split"></div>
</div>

@push('custom-js')
<script>
    var bpkiColors = {GP: '#119c58', DO: '#0f4db8', PP: '#ff9811'};

    function formatRm(value) {
        return 'RM ' + Number(value).toLocaleString('en-MY', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    function renderSummary(summary) {
        if (!summary) return;
        $('#summary_total').text(formatRm(summary.total));
        $('#summary_years').text(summary.min_year ? (summary.min_year == summary.max_year ? summary.min_year : summary.min_year + ' – ' + summary.max_year) : 'No data');
        $('#summary_records').text(Number(summary.records).toLocaleString('en-MY'));
        $('#summary_ptj').text(summary.ptj);
        $('#summary_programmes').text(summary.programmes);

        // Split bar uses positive totals only, net negatives are shown in the legend
        var positive = summary.by_bpki.reduce(function(sum, item) { return sum + Math.max(Number(item.total), 0); }, 0);
        var bar = '', legend = '';
        summary.by_bpki.forEach(function(item) {
            var color = bpkiColors[item.code] || '#a0aec0';
            var percent = positive > 0 ? Math.max(Number(item.total), 0) / positive * 100 : 0;
            if (percent > 0) {
                bar += '<div class="bpki-segment" style="width:' + percent + '%;background-color:' + color + '" title="' + item.code + ': ' + formatRm(item.total) + '">' + (percent >= 8 ? item.code + ' ' + percent.toFixed(1) + '%' : '') + '</div>';
            }
            legend += '<span class="bpki-legend"><span class="bpki-chip" style="background-color:' + color + '">' + item.code + '</span><span class="bpki-amount">' + formatRm(item.total) + '</span></span>';
        });
        $('#bpki_split').html(bar || '<div class="text-gray-500 text-center w-full">No data</div>');
        $('#bpki_legend').html(legend);
    }
</script>
@endpush
