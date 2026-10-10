@if ($terms->isNotEmpty())
<div id="term_{{ $plan_id }}" class="input-group w-2/5 d-none">
    <div class="input-group-text bg-theme-1 fs-xs text-white">LAPORAN PERBELANJAAN</div>
    <select id="jana_laporan_{{ $report_type }}_{{ $plan_id }}" class="form-select bg-white w-64">
        <option value="">-- Sila pilih penggal --</option>
        @foreach ($terms as $term)
            <option value="{{ $term->term }}">{{ $term->label }}</option>
        @endforeach
    </select>
    <button type="button" form="submission-form" class="btn btn-primary" onclick="generateReport($('#{{ $elem_id }}').val(), '{{ $report_type }}')"> JANA </button>
</div>
@endif

<script>
    function generateReport(id, report_type = 'a') {
        if($('#jana_laporan_' + report_type + '_' + id).val() == ""){
            toastr_alert('error', 'Sila pilih penggal.');
        }
        else{
            window.location = window.location.origin + '/dana-ru/kewangan/perbelanjaan/laporan-perbelanjaan/' + id + '/' + $('#jana_laporan_' + report_type + '_' + id).val();
        }
    }
</script>