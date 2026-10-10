@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Perincian Perbelanjaan @endslot
@push('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endpush
@slot('content')
<x-title>Senarai Penggal untuk Agihan Tahun {{ $plan->year }} [{{ $plan->created_at }}]</x-title>
<div class="intro-y grid columns-12 gap-6">
    <div class="g-col-12 box">
        <div class="tab-content" id="pills-tabContent">
            <div class="pb-5 px-5">
                <div class="intro-y d-flex py-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
                    <a href="{{ route('dana-ru.kewangan.perbelanjaan.program.term.create', $plan->id) }}" class="btn btn-primary me-4"><i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i>Penggal</a>
                </div>
                <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                    <table class="table table-bordered mt-6 ">
                        <thead class="table-dark border-b-0">
                            <tr>
                                <th class="whitespace-nowrap text-center">PENGGAL</th>
                                <th class="whitespace-nowrap">NAMA</th>
                                <th class="whitespace-nowrap">STATUS</th>
                                <th class="whitespace-nowrap">CREATED AT</th>
                                <th class="whitespace-nowrap">UPDATED AT</th>
                                <th class="whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($terms as $term)
                                <tr>
                                    <td class="text-center">{{ $term->term }}</td>
                                    <td>{{ $term->label }}</td>
                                    <td>
                                        <button onclick="statusUpdate($(this), {{ $term->id }})" value="{{ $term->active }}" id="status_btn_{{ $term->id }}" class="btn btn-sm btn-{{ $term->active == 'Y' ? 'success' : 'danger' }}-soft">
                                            {{ $term->active == 'Y' ? 'Active' : 'Disabled' }}
                                        </button>
                                    </td>
                                    <td>{{ $term->created_at }}</td>
                                    <td>{{ $term->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dana-ru.kewangan.perbelanjaan.program.term.edit',  $term->id) }}" class="btn btn-sm btn-warning ms-2"><i data-feather="edit" class="w-4 h-4"></i></a>
                                        <button onclick="deleteData({{ $term->id }})" class="btn btn-sm btn-danger ms-2"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="intro-x bg-gray-300">
                                    <td class="text-center" colspan="10">No record.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ route('dana-ru.kewangan.perbelanjaan.program.index', $plan->year) }}" class="intro-y btn btn-primary me-5 ms-5 mb-5">Back</a>
    </div>
</div>
@endslot
@push('custom-js')
<script>
    function statusUpdate(that, id){
        var data = new FormData();
        var active = that.val() == "Y" ? "N" : "Y";
        data.append("id", id);
        data.append("active", active);
        $.ajax({
            url: "/dana-ru/kewangan/perbelanjaan/program/term/status-update",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                that.val(res.result.active);
                that.removeClass("btn-danger-soft btn-success-soft");
                that.addClass("btn-"+(res.result.active == "Y" ? "success" : "danger")+"-soft");
                that.text(res.result.active == "Y" ? "Active" : "Disabled");
                toastr_alert('success', 'Penggal '+res.result.term + ' telah berjaya ' + (res.result.active == "Y" ? "diaktifkan" : "dinyahaktifkan") + '.');
            },
            error: function(data) {
                toastr_alert('error', 'Something went wrong.')
            }
        });
    }

    function deleteData(id) {
        swal({
            title: 'Confirm?',
            text: "Are you sure to delete this data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, process it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = window.location.origin + '/dana-ru/kewangan/perbelanjaan/program/term/delete/'+id;
                    swal({
                        title: 'Processing',
                        text: "It might take a few minutes to process.",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                    swal.showLoading();
                }
        })
    }
</script>
@endpush
@endcomponent