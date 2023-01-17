@component("layouts.app")
@slot('module') Masterlist @endslot
@slot("submodule") Myra @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        Download Masterlist
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
    @if($module->available)
    <button id="{{ $module->group_code }}_download" class="btn btn-sm btn-primary me-5" onclick="downloadMasterlist('{{ $module->group_code }}', {{$year}}, 1)">Download All</button>
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
                <a class="btn h-full intro-y d-flex flex-column flex-sm-row align-items-center"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">{{ $item->name }}</div>
                    </div>

                    <div class="ms-3 me-2 text-theme-6"><button onclick="downloadMasterlist('{{ $item->code }}', {{$year}})" class="btn btn-primary"> <i data-feather="download" class="w-5 h-5"></i> </button></div>
                </a>
                @else
                <a class="btn btn-secondary h-full intro-y d-flex flex-column flex-sm-row align-items-center"> 
                    <div class="me-auto">
                        <div class="fs-lg fw-medium" style="color: black">{{ $item->name }}</div>
                    </div>

                    <div class="ms-3 me-2 text-theme-6"><button class="btn btn-secondary" disabled> <i data-feather="alert-circle" class="w-5 h-5"></i> </button></div>
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
        window.location = window.location.origin + '/report/myra/' + that.val();
    }

    function downloadMasterlist(code, year, all = ''){
        window.location = window.location.origin + "/report/myra/download/"+code+"/"+year+'/'+all;
    }
</script>
@endsection
@endcomponent