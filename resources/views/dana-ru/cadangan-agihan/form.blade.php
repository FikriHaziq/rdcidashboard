@component("layouts.app")
@slot("module") Dana RU @endslot
@slot("submodule") Cadangan Agihan @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        Borang Cadangan Agihan {{ $year }}
    </h2>
</div>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <div class="intro-y box">
            <div class="d-flex flex-column flex-sm-row align-items-center p-5 border-bottom border-gray-200 dark-border-dark-5">
                <h2 class="fw-medium fs-base me-auto">
                Input
            </h2>
            </div>
            <div id="input" class="p-5">
                <div class="form-inline">
                    <label for="mrun" class="form-label w-sm-40">MRUN</label>
                    <select id="mrun" class="form-control form-select" aria-label="Default select example">
                        <option>--Sila pilih--</option>
                        <option>TD</option>
                        <option>RP</option>
                        <option>WC</option>
                        <option>BGC</option>
                    </select>
                </div>
                <div class="form-inline mt-5">
                    <label for="BPKI" class="form-label w-sm-40">BPKI</label>
                    <select id="BPKI" class="form-control form-select" aria-label="Default select example">
                        <option>--Sila pilih--</option>
                        <option>DANA OPERASI</option>
                        <option>GERAN PENYELIDIKAN</option>
                        <option>PEMBELIAN & PENYELENGGARAAN ALATAN PENYELIDIKAN</option>
                    </select>
                </div>
                <div class="form-inline mt-5">
                    <label for="horizontal-form-1" class="form-label w-sm-40">KETUA PROGRAM</label>
                    <input id="horizontal-form-1" type="text" class="form-control" placeholder="KETUA PROGRAM">
                </div>
                <div class="form-inline mt-5">
                    <label for="horizontal-form-1" class="form-label w-sm-40">PEGAWAI BERTANGGUNGJAWAB</label>
                    <input id="horizontal-form-1" type="text" class="form-control" placeholder="PEGAWAI BERTANGGUNGJAWAB">
                </div>
                <div class="form-inline mt-5">
                    <label for="PTJ PIC" class="form-label w-sm-40">PTJ PIC</label>
                    <select id="PTJ PIC" class="form-control form-select" aria-label="Default select example">
                        <option>--Sila pilih--</option>
                        <option>RMC</option>
                        <option>PUTM</option>
                        <option>SPS</option>
                        <option>JTNCPI</option>
                    </select>
                </div>
                <div class="form-inline mt-5">
                    <label for="JENIS AGIHAN" class="form-label w-sm-40">JENIS AGIHAN</label>
                    <select id="JENIS AGIHAN" class="form-control form-select" aria-label="Default select example">
                        <option>--Sila pilih--</option>
                        <option>PELANTIKAN PASCA DOCTORAL </option>
                        <option>INSENTIF PENERBITAN PENYELIDIKAN-JURNAL BERINDEKS</option>
                        <option>INSENTIF PENERBITAN SISWAZAH</option>
                        <option>MEMPERKASA PROGRAM/COE DARI SEGI PENGURUSAN BAKAT</option>
                    </select>
                </div>
                <div class="form-inline mt-5">
                    <label for="horizontal-form-1" class="form-label w-sm-40">CHARGELINE</label>
                    <input id="horizontal-form-1" type="text" class="form-control" placeholder="CHARGELINE">
                </div>
                <div class="form-inline mt-5">
                    <label for="JENIS AGIHAN" class="form-label w-sm-40">KPI</label>
                    <select id="JENIS AGIHAN" class="tom-select form-control" multiple>
                        <option>Warganegara: RM70,000 x 38 PD x 1 tahun = RM2,660,000 </option>
                        <option>Bukan Warganegara: RM64,000 x 56 PD x 1 tahun = RM3,584,000</option>
                        <option>Q1/Q2: 850 - 1100 artikel tahun 2023 sahaja</option>
                        <option>Q1: RM2000/artikel</option>
                        <option>Q2: RM1500/artikel</option>
                    </select>
                </div>
                <div class="form-inline mt-5">
                    <label for="horizontal-form-1" class="form-label w-sm-40">PERUNTUKAN AGIHAN</label>
                    <div class="form-control input-group">
                        <div id="input-group-email" class="input-group-text">RM</div> <input type="text" class="form-control" placeholder="0.00" aria-label="0.00" aria-describedby="input-group-email">
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="" class="btn btn-light me-3">Batal</a>
                    <a href="{{ route('dana-ru.cadangan-agihan.index',['year'=>$year,'action'=>'save']) }}" class="btn btn-primary">Hantar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
</script>
@endsection
@endcomponent