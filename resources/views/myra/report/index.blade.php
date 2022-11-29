@component("layouts.app")
@slot('module') Report @endslot
@slot("submodule") Myra @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        Report - Myra
    </h2>
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0">
        <div class="input-group">
            <div class="input-group-text">YEAR</div>
            <select class="form-select me-sm-2" onchange="getList($(this))">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>


@endslot
@section('custom-js')
<script>

    function getList(that) {
        window.location = window.location.origin + '/masterlist/myra/index/' + that.val();
    }

    function updateMark(code, year){
        $('#'+code+'_update').hide();
        $('#'+code+'_complete').hide();
        $('#'+code+'_error').hide();
        $('#'+code+'_processing').show();
        var data = new FormData();
        data.append("section", code);
        data.append("year", year);
        // alert(data);
        $.ajax({
            url: "/ajax/update-myra-data/",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                $('#'+code+'_processing').hide();
                $('#'+code+'_complete').show();
            },
            error: function(data) {
                $('#'+code+'_processing').hide();
                $('#'+code+'_error').show();
            }
        });
    }
</script>
@endsection
@endcomponent