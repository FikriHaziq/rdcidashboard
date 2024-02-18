@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Pengesahan Agihan @endslot
@section('custom-css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
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
    @if($plan_form->pro_status == 'active')
    Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->pro_code }}.{{ getProjectSecondCode($plan_form->pro_code_2) }} - {{ strtoupper($plan_form->pro_title) }}
    @else
    {{ strtoupper($plan_form->pro_title) }}
    @endif
</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <div class="intro-y box">
            <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
                <h2 class="fs-lg fw-medium truncate me-5">Lampiran A</h2>
                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                    @if($plan_form->plan_form_ref_no)<a href="{{ route('doc-generator.lampiran-a', $plan_form->plan_form_id) }}" class="btn btn-sm btn-dark" onclick=""><i class="p-1" data-feather="download"></i> Download Word</a>@endif
                </div>
            </div>
            <div class="p-5">
                <h2 class="mx-auto mb-5 text-center fs-base fw-bold">MAKLUMAT KEWANGAN AGIHAN DANA UNIVERSITI PENYELIDIKAN</h2>
                <h2 class="mx-auto mb-5 text-center fs-sm fw-bold text-decoration-underline">BUTIRAN KEWANGAN TERPERINCI</h2>
                <div class="intro-y mb-5">
                    <table class="table table-bordered">
                        <thead class="table-dark border-b-0">
                            <tr>
                                <th class="text-center w-1">BIL.</th>
                                <th class="text-center w-2">PERKARA</th>
                                <th class="text-center">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">1.</td>
                                <td class="fw-bold">PTJ Bertanggungjawab</td>
                                <td class="fw-bold">{{ $plan_form->ptj }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">2.</td>
                                <td class="fw-bold">Program KPM</td>
                                <td class="fw-bold">{{ $plan_form->mrun_desc }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">3.</td>
                                <td class="fw-bold">Projek/Program</td>
                                <td class="fw-bold">{{ strtoupper($plan_form->pro_title) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">4.</td>
                                <td class="fw-bold">Pusat Kos / Chargeline</td>
                                <td class="fw-bold">
                                    <table class="table table-bordered w-full">
                                        <thead class="border-b-0 border-dark" style="background-color: #f7e4df;">
                                            <tr>
                                                <th class="text-center">No. Chargeline</th>
                                                <th class="text-center">Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="fw-bold">
                                                    @if($plan_form->pro_status == 'active')
                                                    Q.{{ getAppendedPtjCode($plan_form->ptj_code, 7) }}.{{ $plan_form->pro_code }}.{{ getProjectSecondCode($plan_form->pro_code_2) }}
                                                    @else
                                                    TIADA
                                                    @endif
                                                </td>
                                                <td class="fw-bold">{{ strtoupper($plan_form->pro_title) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">5.</td>
                                <td class="fw-bold">Agihan Tahun {{ $plan_form->plan_year }}</td>
                                <td class="fw-bold">
                                    <table class="table table-bordered w-full">
                                        <thead class="border-b-0 border-dark" style="background-color: #f7e4df;">
                                            <tr>
                                                <th class="text-center">No. Ruj. Pindahan UTMFin</th>
                                                <th class="text-center">Jumlah Pindahan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="fw-bold">{{ $plan_form->plan_form_ref_no }}</td>
                                                <td class="fw-bold">RM {{ number_format($plan_form->plan_form_amount, 2, '.', ',') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">6.</td>
                                <td class="fw-bold">Sasaran / Key Performance Indicators</td>
                                <td class="fw-bold text-nowrap">
                                    {!! $plan_form->main_kpi_details !!}
                                    <br />
                                    {!! $plan_form->kpi_details !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">7.</td>
                                <td class="fw-bold">Nama Pegawai Bertanggungjawab</td>
                                <td class="fw-bold">
                                    <table class="table table-bordered w-full">
                                        <thead class="border-b-0 border-dark" style="background-color: #c4dfeb;">
                                            <tr>
                                                <th class="text-center" colspan="2">Butiran Pegawai Bertanggungjawab</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold">Ketua Program</td>
                                                <td class="fw-bold">{{ strtoupper($plan_form->pic_name) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Pegawai Bertanggungjawab</td>
                                                <td class="fw-bold">{{ strtoupper($plan_form->member_name) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">8.</td>
                                <td class="fw-bold">Tugas dan Tanggungjawab Ketua PTJ</td>
                                <td>
                                    <ol class="mt-4">
                                        <li>Ketua PTJ hendaklah memastikan semua perbelanjaan dibuat secara berhemah dan mematuhi semua peraturan kewangan yang telah ditetapkan oleh universiti.</li>
                                        <li>Ketua PTJ hendaklah sentiasa memantau prestasi penggunaan dana selaras dengan perancangan pelaksanaan program dalam tahun semasa.</li>
                                        <li>Ketua PTJ hendaklah memastikan laporan penggunaan dana disediakan setiap TIGA bulan dan dihantar kepada pihak Urusetia RU UTM.</li>
                                        <li>Selaras dengan Prosedur Pemantauan Prestasi Projek/Program Di Bawah Dana RU Tahun 2019, Jabatan TNCPI berhak untuk menarik semula peruntukan program yang tidak mencapai prestasi perbelanjaan dan tahap kemajuan yang disasarkan.</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">9.</td>
                                <td class="fw-bold">Perakuan Penerimaan Agihan Tahun {{ $plan_form->plan_year }}</td>
                                <td>
                                    <div class="border border-dark rounded p-5 mt-4" @if($plan_form->plan_form_declaration_date) style="background-color: #dbfff1" @endif>
                                        <div class="d-flex">
                                            <input id="declaration" type="checkbox" style="width: 50px" class="form-check-input border me-2" @if($plan_form->plan_form_declaration_date) checked  @endif disabled>
                                            <label class="cursor-pointer select-none" for="declaration"><p class="text-justify">Saya dengan ini berjanji akan memastikan peruntukan yang diterima digunakan selaras dengan perancangan projek/program ini bagi mencapai sasaran KPI Tahun 2023. Saya juga akan mematuhi semua syarat-syarat agihan yang ditetapkan oleh Urusetia dan juga memastikan perbelanjaan dilaksanakan dengan mematuhi semua peraturan kewangan yang ditetapkan.</p></label>
                                        </div>
                                        <div class="grid columns-12 gap-6 mt-4">
                                            <div class="g-col-3">
                                                Nama:
                                            </div>
                                            <div class="g-col-9 fw-bold">
                                                {{ strtoupper($plan_form->pic_name) }}
                                            </div>
                                        </div>
                                        <div class="grid columns-12 gap-6 mt-4">
                                            <div class="g-col-3">
                                                Tarikh:
                                            </div>
                                            <div class="g-col-9">
                                                @if($plan_form->plan_form_declaration_date){{ date('j/n/Y', strtotime($plan_form->plan_form_declaration_date)) }}@endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex p-5 align-item-center border-top border-gray-200 dark-border-dark-5">
                <a class="btn btn-light" href="{{ route('dana-ru.kewangan.pengesahan-agihan.index', $plan_form->plan_year) }}">Back</a>
                <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                    @if(user()->role == 'super_admin' || getAccessControl('dru_pa'))
                    @if($plan_form->plan_form_approved != 'Y' && $plan_form->plan_form_ref_no)
                    <form id="approve-form" action="{{ route('dana-ru.kewangan.pengesahan-agihan.approve', $plan_form->plan_form_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"> Approve</button>
                    </form>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
</script>
@endsection
@endcomponent