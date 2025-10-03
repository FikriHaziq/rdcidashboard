<x-modal modal-id="kpiModal" title="" :footer-flag="false" :custom-footer="true">
    <div class="input-group">
        <input id="kpi_input" value="" class="form-control" oninput="searchButtonControl($(this))" placeholder="Carian...">
        <div class="input-group-lg"><button type="button" class="kpi-search-btn btn btn-primary btn-sm btn-left-radius-0 w-full h-full" onclick="searchKpi()" disabled><i data-feather="search" class="w-5 h-5"></i></button></div>
    </div>
    <div class="mt-2 p-5 border border-gray-300 rounded-2">
        <p class="search-label text-gray-500">Tiada data</p>
        <div class="search-content d-flex flex-wrap"></div>
    </div>
    <x-slot name="footer">
        <div class="input-group w-full">
            <input id="kp_name" name="kp_name" type="text" value="" class="form-control " placeholder="Nama">
            <div class="input-group-lg"><button type="button" class="btn btn-dark btn-sm btn-left-radius-0 w-full h-full fs-xs">Simpan</button></div>
        </div>
    </x-slot>
</x-modal>
<script>
    let kpi_type = '';
    let data_index = null;
    let data = {
                id : null,
                item_id : null,
                item_name : null,
                active : null,
                bil : null,
                amount : null,
                total : null
            };
    function searchButtonControl(that) {
        if(that.val() === "")$('.kpi-search-btn').attr('disabled', 'disabled');
        else $('.kpi-search-btn').removeAttr('disabled');
    }

    function searchKpi(type) {
        let value = $('#kpi_input').val();
        $('.search-label').html('Sedang proses...');
        $('.search-content').empty();
        $.ajax({
            url: "/ajax/search-kpi/" + kpi_type + "/" + value,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if(res.templates.length == 0){
                    $('.search-label').html('Tiada data');
                }
                else {
                    $('.search-label').html('');
                    res.templates.forEach(template => {
                        let btn_color = template.active == 'Y' ? 'btn-outline-primary' : 'btn-outline-warning';
                        $('.search-content').append('<button class="btn '+btn_color+' btn-sm me-2 mb-2" id="kpi_'+template.id+'" onclick="setKpi('+template.id+', \''+template.title+'\', \''+template.active+'\')">'+template.title+'</button>');
                    });
                }
            },
        });
    }

    function openKpiModal(type, index, item = null) {
        data_index = index;
        clearModal();
        if(item){
            data = {
                id : item.id,
                item_id : item.item_id,
                item_name : item.item_name,
                active : item.active,
                bil : item.bil,
                amount : item.amount,
                total : item.total
            };
            if(item.item_id) autoFillData(item);
        }
        kpi_type = type;
        let modal_name = '';
        if(type == "main_dist") modal_name = "ASAS AGIHAN";
        else if(type == "kpi" || type == "mykpi") modal_name = "KPI";
        $('#kpiModal .modal-title').html(modal_name);
    }

    function setKpi(id, title, active) {
        $("#"+kpi_type+"_"+data_index+"_item").val(id);
        $("#"+kpi_type+"_"+data_index+"_item_name").val(title);
        $("#"+kpi_type+"_"+data_index+"_active").val(active);
        let btn_elem = $("#"+kpi_type+"_"+data_index+"_item_elem");
        btn_elem.html(title);
        btn_elem.removeClass('btn-primary-soft btn-warning-soft btn-danger-soft');
        btn_elem.addClass(active == "Y" ? "btn-primary-soft" : "btn-warning-soft");
        data.item_id = id;
        data.item_name = title;
        data.active = active;
        btn_elem.removeAttr('onclick');
        btn_elem.on('click', openKpiModal(kpi_type, data_index, data));
        $('#kpiModal').modal('hide');
    }

    function clearModal() {
        data = {
            id : null,
            item_id : null,
            item_name : null,
            active : null,
            bil : null,
            amount : null,
            total : null
        };
        $('.kpi-search-btn').attr('disabled', 'disabled');
        $('.search-label').html('Tiada data');
        $('.search-content').empty();
        $('#kpiModal').find('input').val('');
    }

    function autoFillData(item) {
        let btn_color = 'btn-warning-soft';
        if (item.active == 'Y') btn_color = 'btn-primary';
        $('.search-label').html('');
        $('.search-content').append('<button class="btn '+ btn_color +' btn-sm me-2 mb-2" id="kpi_'+item.item_id+'">'+item.item_name+'</button>');
    }
</script>