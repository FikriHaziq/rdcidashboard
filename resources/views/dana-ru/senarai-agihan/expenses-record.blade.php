@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Rekod Perbelanjaan @endslot
@section('custom-css')
<link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
<style>
.ts-control {
    -moz-padding-start: calc(.75rem - 3px);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%232d3748' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E);
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 16px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    color: #2d3748;
    display: block;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.429;
    padding: 0.5rem 2.25rem 0.5rem 0.75rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 100%;
}
.ts-control input::placeholder{font-size: .875rem; color: #A0AEC0;opacity: 1; /* Firefox */}
.ts-control input::-ms-input-placeholderr{font-size: .875rem; color: #A0AEC0;}
.ts-dropdown {z-index: 100;}
</style>

@endsection
@slot('content')
<x-title>
    @if($plan_form->ddf_status == 'active')
    Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->ddf_code }}.{{ getProjectSecondCode($plan_form->ddf_code_2) }} - {{ strtoupper($plan_form->ddf_title) }}
    @else
    {{ strtoupper($plan_form->ddf_title) }}
    @endif
</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <div class="intro-y box">
            <div class="p-5">
                <h2 class="mx-auto mb-5 text-center fs-base fw-bold">REKOD PERBELANJAAN</h2>
                <div class="intro-y row mt-5 mb-5">
                    <div class="col-12">
                        <div class="grid grid-cols-12 gap-3">
                            <div class="g-col-3 box p-5 cursor-pointer zoom-in" style="background-color: #4AC4D2">
                                <div class="fw-medium fs-base text-white">JUMLAH</div>
                                <div class="fw-bold fs-lg text-white">RM {{ number_format($total, 2, '.', ',') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro-y mb-5">
                    <div class="overflow-x-auto table-responsive">
                        <table class="table table-bordered table-hover compact" id="datatable">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">PUSAT KOS</th>
                                    <th class="whitespace-nowrap">SODO</th>
                                    <th class="whitespace-nowrap">BULAN</th>
                                    <th class="whitespace-nowrap">JUMLAH (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script>
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/dana-ru/senarai-agihan/expenses-record/"+{!! $plan_form->id !!},
            "type": "GET",
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            {data: 'pusat_kos',name: 'pusat_kos'},
            {data: 'sodo',name: 'sodo'},
            {data: 'month',name: 'month'},
            {data: 'mde_amount',name: 'amount'},
        ],
        columnDefs: [
            {className: "text-center", targets: [0,1,2,3,4]}
        ],
    });
</script>
@endsection
@endcomponent