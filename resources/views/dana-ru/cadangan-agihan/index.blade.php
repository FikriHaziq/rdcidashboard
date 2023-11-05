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
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0">
        <div class="input-group">
            <div class="input-group-text">TAHUN</div>
            <select class="form-select me-sm-2" onchange="getList($(this))">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
<div class="grid columns-12 gap-6">
    <div class="g-col-12">
        <div class="grid columns-12 gap-6">
            <!-- BEGIN: Notification -->
            <div class="g-col-12 mt-6 mb-n6 intro-y">
                <div class="alert alert-warning-soft alert-dismissible fade show d-flex align-items-center mb-6" role="alert">
                    <i data-feather="alert-circle" class="w-6 h-6 me-2"></i>
                    <span>Sila hantar sebelum 30 Mac {{ $year }}.</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
                </div>
            </div>
            <!-- BEGIN: Notification -->
            <!-- BEGIN: General Report -->
            <div class="g-col-8 mt-2">
                <div class="intro-y d-block d-sm-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium truncate me-5">
                        RUMUSAN DANA
                    </h2>
                </div>
                <div class="report-box-2 intro-y mt-12 mt-sm-5">
                    <div class="box d-sm-flex">
                        <div class="px-8 py-12 d-flex flex-column justify-content-center flex-1">
                            <div class="text-gray-600 dark-text-gray-600 fs-xs">DANA DITERIMA</div>
                            <div class="position-relative fs-3xl mt-2 fw-medium">RM 24,955,737.94 </div>
                            <div class="text-gray-600 dark-text-gray-600 mt-4 fs-xs">DANA TELAH DIAGIH</div>
                            <div class="position-relative text-theme-9 fs-3xl mt-2 fw-medium">RM 24,955,737.94 </div>
                            <div class="text-gray-600 dark-text-gray-600 mt-4 fs-xs">DANA BELUM DIAGIH</div>
                            <div class="position-relative text-theme-10 fs-3xl mt-2 mb-6 fw-medium">RM 0.00 </div>
                            {{-- <div class="report-box-2__indicator bg-theme-9 tooltip cursor-pointer" title="47% Higher than last month"> 47% <i data-feather="chevron-up" class="w-4 h-4 ms-0.5"></i> </div> --}}
                            @if(in_array(($request->status ?? ''), ['draft','']))<div class="bg-gray-400 justify-content-center text-white d-flex align-items-center mb-2 p-2">Draft</div>@endif
                            @if(in_array(($request->status ?? ''), ['submitted']))<div class="bg-theme-1 justify-content-center text-white d-flex align-items-center mb-2 p-2">Submitted</div>@endif
                            @if(in_array(($request->status ?? ''), ['amendment']))<div class="bg-theme-12 justify-content-center text-white d-flex align-items-center mb-2 p-2">Amendment</div>@endif
                            @if(in_array(($request->status ?? ''), ['verified']))<div class="bg-theme-9 justify-content-center text-white d-flex align-items-center mb-2 p-2">Verified</div>@endif
                            @if(($request->status ?? '')!='draft' && ($request->status ?? '')!='')
                            <button class="btn btn-outline-secondary position-relative justify-content-start rounded-pill mt-2">
                                Jana Kertas Kerja
                                <span class="w-8 h-8 position-absolute d-flex justify-content-center align-items-center bg-theme-1 text-white rounded-pill end-0 top-0 bottom-0 my-auto ms-auto me-0.5"> <i data-feather="arrow-right" class="w-4 h-4"></i> </span>
                            </button>
                            @endif
                            @if(in_array(($request->status ?? ''), ['draft','', 'amendment']) && ($request->role ?? '') != 'approver')<a href="{{ route('dana-ru.cadangan-agihan.index',['year'=>$year,'status'=>'submitted']) }}" class="btn btn-primary position-relative justify-content-center rounded-pill mt-2">Submit</a>@endif
                            @if(($request->status ?? '') == 'submitted' && ($request->role ?? '') == 'approver')
                            <div class="grid">
                                <a href="{{ route('dana-ru.cadangan-agihan.index',['year'=>$year,'status'=>'verified','role'=>'']) }}" class="btn btn-success g-col-6 position-relative justify-content-center rounded-pill mt-2">Verify</a>
                                <a href="{{ route('dana-ru.cadangan-agihan.index',['year'=>$year,'status'=>'amendment','role'=>'']) }}" class="btn btn-danger g-col-6 position-relative justify-content-center rounded-pill mt-2">Reject</a>
                            </div>
                            @endif
                        </div>
                        <div class="px-8 py-12 d-flex flex-column justify-content-center flex-1 border-top border-top-sm-0 border-start-sm border-gray-300 dark-border-dark-5 border-dashed">
                            <div class="text-gray-600 dark-text-gray-600 fs-xs">DANA OPERASI (20%)</div>
                            <div class="mt-1.5 d-flex align-items-center">
                                <div class="fs-base">RM 8,470,000.00</div>
                                <div class="bg-theme-6 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">33.94%</div>
                                <div class="text-theme-6 d-flex fs-xs fw-medium tooltip cursor-pointer ms-2" title="2% Lower than last month"> 14% <i data-feather="chevron-up" class="w-4 h-4 ms-0.5"></i> </div>
                            </div>
                            <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">GERAN PENYELIDIKAN (60%)</div>
                            <div class="mt-1.5 d-flex align-items-center">
                                <div class="fs-base">RM 13,985,737.94
                                </div>
                                <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">56.04%</div>
                                <div class="text-theme-10 d-flex fs-xs fw-medium tooltip cursor-pointer ms-2" title="2% Lower than last month"> 4% <i data-feather="chevron-down" class="w-4 h-4 ms-0.5"></i> </div>
                            </div>
                            <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">PEMBELIAN & PENYELENGGARAAN<br /> ALATAN PENYELIDIKAN (20%)</div>
                            <div class="mt-1.5 d-flex align-items-center">
                                <div class="fs-base">RM 2,500,000.00</div>
                                <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">10.02%</div>
                                <div class="text-theme-10 d-flex fs-xs fw-medium tooltip cursor-pointer ms-2" title="2% Lower than last month"> 10% <i data-feather="chevron-down" class="w-4 h-4 ms-0.5"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Visitors -->
            <div class="g-col-4 g-col-sm-4 mt-2">
                <div class="intro-y d-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium me-5">
                        GARIS PANDUAN AGIHAN (20%-60%-20%)
                    </h2>
                </div>
                <div class="report-box-2 intro-y mt-5">
                    <div class="box p-5">
                        <div class="px-8 py-12 d-flex flex-column justify-content-center flex-1">
                            <div class="text-gray-600 dark-text-gray-600 fs-xs">DANA OPERASI (20%)</div>
                            <div class="mt-1.5 d-flex align-items-center">
                                <div class="fs-base">RM 4,991,147.59</div>
                                <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">20%</div>
                            </div>
                            <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">GERAN PENYELIDIKAN (60%)</div>
                            <div class="mt-1.5 d-flex align-items-center">
                                <div class="fs-base">RM 14,973,442.76</div>
                                <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">60%</div>
                            </div>
                            <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">PEMBELIAN & PENYELENGGARAAN<br /> ALATAN PENYELIDIKAN (20%)</div>
                            <div class="mt-1.5 d-flex align-items-center">
                                <div class="fs-base">RM 4,991,147.59</div>
                                <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">20%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Visitors -->
            <!-- BEGIN: Users By Age -->
            <div class="g-col-12 g-col-sm-4 mt-2 mt-lg-6 mt-xl-2">
                <div class="intro-y d-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium truncate me-5">
                        
                    </h2>
                </div>
                <div class="report-box-2 intro-y mt-5">
                    <div class="box p-5">
                        <div class="tab-content mt-6">
                            <div class="tab-pane fade show active" id="active-users" role="tabpanel" aria-labelledby="active-users-tab">
                                <div class="position-relative">
                                    <canvas class="mt-3" id="report-donut-chart" height="150"></canvas>
                                    <div class="d-flex flex-column justify-content-center align-items-center position-absolute w-full h-full top-0 start-0">
                                        <div class="fs-2xl fw-medium">RM 25M</div>
                                        <div class="text-gray-600 dark-text-gray-600 mt-0.5">Dana Agihan</div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="d-flex align-items-center">
                                        <div class="w-2 h-2 bg-theme-11 rounded-circle me-3"></div>
                                        <span class="truncate">TD</span> 
                                        <div class="h-px flex-1 border border-end border-dashed border-gray-300 mx-3 d-xl-none"></div>
                                        <span class="fw-medium ms-xl-auto">RM 5,170,000.00</span> 
                                        <span class="fw-medium ms-xl-auto">21%</span> 
                                    </div>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="w-2 h-2 bg-theme-1 rounded-circle me-3"></div>
                                        <span class="truncate">RP</span> 
                                        <div class="h-px flex-1 border border-end border-dashed border-gray-300 mx-3 d-xl-none"></div>
                                        <span class="fw-medium ms-xl-auto">RM 19,585,737.94</span> 
                                        <span class="fw-medium ms-xl-auto">77%</span> 
                                    </div>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="w-2 h-2 bg-theme-12 rounded-circle me-3"></div>
                                        <span class="truncate">WC</span> 
                                        <div class="h-px flex-1 border border-end border-dashed border-gray-300 mx-3 d-xl-none"></div>
                                        <span class="fw-medium ms-xl-auto">RM 0.00</span> 
                                        <span class="fw-medium ms-xl-auto">0%</span> 
                                    </div>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="w-2 h-2 bg-theme-6 rounded-circle me-3"></div>
                                        <span class="truncate">BGC</span> 
                                        <div class="h-px flex-1 border border-end border-dashed border-gray-300 mx-3 d-xl-none"></div>
                                        <span class="fw-medium ms-xl-auto">RM 200,000.00</span> 
                                        <span class="fw-medium ms-xl-auto">2%</span> 
                                    </div>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="w-2 h-2 bg-gray-600 rounded-circle me-3"></div>
                                        <span class="truncate">Baki Dana</span> 
                                        <div class="h-px flex-1 border border-end border-dashed border-gray-300 mx-3 d-xl-none"></div>
                                        <span class="fw-medium ms-xl-auto">RM 0.00</span> 
                                        <span class="fw-medium ms-xl-auto">0%</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Users By Age -->
            <!-- BEGIN: Weekly Top Products -->
            <div class="g-col-12 mt-6">
                <div class="intro-y d-block d-sm-flex align-items-center h-10">
                    <h2 class="fs-lg fw-medium truncate me-5">
                        Weekly Top Products
                    </h2>
                    <div class="d-flex align-items-center ms-sm-auto mt-3 mt-sm-0">
                        <a href="{{ route('dana-ru.cadangan-agihan.create') }}" class="btn box d-flex align-items-center text-gray-700 dark-text-gray-300"> <i data-feather="plus" class="d-none d-sm-block w-4 h-4 me-2"></i> Add New </a>
                        <button class="ms-3 btn box d-flex align-items-center text-gray-700 dark-text-gray-300"> <i data-feather="file-text" class="d-none d-sm-block w-4 h-4 me-2"></i> Upload Masterlist </button>
                    </div>
                </div>
                <div class="intro-y overflow-x-auto mt-8 mt-sm-0">
                    <table class="table table-bordered mt-6 ">
                        <thead class="table-dark border-b-0">
                            <tr>
                                <th class="text-nowrap">No.</th>
                                <th class="text-nowrap">MRUN</th>
                                <th class="text-nowrap">BPKI</th>
                                <th class="text-nowrap">KETUA PROGRAM</th>
                                <th class="text-nowrap">PEGAWAI BERTANGGUNGJAWAB</th>
                                <th class="text-nowrap">PTJ PIC</th>
                                <th class="text-nowrap">JENIS AGIHAN</th>
                                <th class="text-nowrap">CHARGELINE</th>
                                <th class="text-nowrap">KPI {{ $year }}</th>
                                <th class="text-nowrap">PERUNTUKAN AGIHAN 2023</th>
                                <th class="text-nowrap">CATATAN</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @for ($i = 0; $i < 19; $i++)
                            <tr class="intro-x">
                                <td class="text-nowrap">{{ $i+1 }}</td>
                                <td class="text-nowrap">TD</td>
                                <td class="text-nowrap">DO</td>
                                <td class="text-nowrap">PN. SITI RAHIMAH BINTI MOHD YUSOP</td>
                                <td class="text-nowrap"></td>
                                <td class="text-nowrap">RMC</td>
                                <td class="text-nowrap">PELANTIKAN PASCA DOCTORAL </td>
                                <td class="text-nowrap">Q.J130000.21A2.00000</td>
                                <td class="text-nowrap">Warganegara: RM70,000 x 38 PD x 1 tahun = RM2,660,000
                                    Bukan Warganegara: RM64,000 x 56 PD x 1 tahun = RM3,584,000
                                </td>
                                <td class="text-nowrap">RM 3,970,000.00</td>
                                <td class="table-report__action text-nowrap">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="d-flex align-items-center me-3" href="{{ route('dana-ru.cadangan-agihan.create') }}"> <i data-feather="check-square" class="w-4 h-4 me-1"></i> Edit </a>
                                        <a class="d-flex align-items-center text-theme-6" href=""> <i data-feather="trash-2" class="w-4 h-4 me-1"></i> Delete </a>
                                    </div>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Weekly Top Products -->
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
function getList(that) {
    window.location = window.location.origin + '/dana-ru/cadangan-agihan/index/' + that.val();
}
</script>
@endsection
@endcomponent