@component("layouts.app")
@slot('module') Master List @endslot
@slot("submodule") Myra @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        Master List - Myra
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
@foreach ($modules as $module)
<div class="alert alert-primary-soft d-flex py-2 pl-5 align-items-center mt-5" role="">
    @if($module->group_code != "section_a")
    <button id="{{ $module->group_code }}_update" class="btn btn-sm btn-primary me-5" onclick="updateMark('{{ $module->group_code }}', {{$year}})">Update mark</button>
    <button id="{{ $module->group_code }}_processing" class="btn btn-sm btn-primary me-5" style="display: none">Updating <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ms-2"></i></button>
    <button id="{{ $module->group_code }}_complete" class="btn btn-sm btn-success me-5" style="display: none" onclick="updateMark('{{ $module->group_code }}', {{$year}})"><i data-feather="thumbs-up" class="w-4 h-4 me-2"></i> Mark Updated</button>
    <button id="{{ $module->group_code }}_error" class="btn btn-sm btn-danger me-5" style="display: none" onclick="updateMark('{{ $module->group_code }}', {{$year}})"><i data-feather="alert-circle" class="w-4 h-4 me-2"></i> Try Again</button>
    @endif
    <div class="text-gray-800 fw-medium">{{ $module->group }}</div>
</div>
<div class="pos intro-y grid columns-12 gap-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y g-col-12 g-col-lg-12 mb-5">
        <div class="grid grid-cols-12 gap-5">
            @foreach ($module->modules as $item)
            <div class="g-col-12 g-col-sm-3 g-col-xxl-3 box p-0 cursor-pointer zoom-in">
                @if ($item->available)
                <a href="{{ route('masterlist.myra.list', ['module'=>$item->code, 'year'=>$year]) }}" class="btn btn-success-soft h-full intro-y d-flex flex-column flex-sm-row align-items-center"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">{{ $item->name }}</div>
                    </div>
                    <div class="ms-3 me-2 text-success"><i data-feather="check-square" class="w-8 h-8"></i></div>
                </a>
                @else
                <a href="{{ route('masterlist.myra.list', ['module'=>$item->code, 'year'=>$year]) }}" class="btn h-full intro-y d-flex flex-column flex-sm-row align-items-center"> 
                        <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">{{ $item->name }}</div>
                    </div>
                    <div class="ms-3 me-2 text-theme-6"><i data-feather="alert-circle" class="w-8 h-8"></i></div>
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach

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