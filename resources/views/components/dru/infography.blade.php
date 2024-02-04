<!-- BEGIN: General Report -->
<div class="g-col-4 mt-2">
    <div class="intro-y d-block d-sm-flex align-items-center h-10">
        <h2 class="fs-lg fw-medium truncate me-5">
            RUMUSAN DANA
        </h2>
    </div>
    <div class="report-box-2 intro-y mt-12 mt-sm-5">
        <div class="box d-sm-flex">
            <?php $infoData = $plan->infographicData(); ?>
            <div class="px-8 py-12 d-flex flex-column justify-content-center flex-1">
                <div class="text-gray-600 dark-text-gray-600 fs-xs">DANA DITERIMA</div>
                <div class="position-relative fs-3xl mt-2 fw-medium">
                    RM {{ number_format($plan->amount, 2, '.', ',') }}
                    @if (getAccessControl('dru_bca'))
                    @if (in_array($plan->status, [1,4,5]))
                    <span class="ms-6"><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editFund"> <i data-feather="edit" class="w-4 h-4"></i></button></span>                       
                    @endif
                    @endif
                </div>
                <div class="text-gray-600 dark-text-gray-600 mt-4 fs-xs">DANA TELAH DIAGIH</div>
                <div class="position-relative text-theme-9 fs-3xl mt-2 fw-medium">RM {{ number_format($infoData['total'], 2, '.', ',') }} </div>
                <div class="text-gray-600 dark-text-gray-600 mt-4 fs-xs">DANA BELUM DIAGIH</div>
                <div class="position-relative text-theme-10 fs-3xl mt-2 mb-6 fw-medium">RM {{ number_format(($plan->amount - $infoData['total']), 2, '.', ',') }} </div>
                {{-- <div class="report-box-2__indicator bg-theme-9 tooltip cursor-pointer" title="47% Higher than last month"> 47% <i data-feather="chevron-up" class="w-4 h-4 ms-0.5"></i> </div> --}}
                @if($plan->status == '1')<div class="bg-gray-600 justify-content-center text-white d-flex align-items-center mb-2 p-2">{{ $plan->getStatus->description ?? $plan->getStatus->name }}</div>@endif
                @if($plan->status == '2')<div class="bg-theme-1 justify-content-center text-white d-flex align-items-center mb-2 p-2">{{ $plan->getStatus->description ?? $plan->getStatus->name }}</div>@endif
                @if($plan->status == '3')<div class="bg-theme-1 justify-content-center text-white d-flex align-items-center mb-2 p-2">{{ $plan->getStatus->description ?? $plan->getStatus->name }}</div>@endif
                @if($plan->status == '4')<div class="bg-theme-9 justify-content-center text-white d-flex align-items-center mb-2 p-2">{{ $plan->getStatus->description ?? $plan->getStatus->name }}</div>@endif
                @if($plan->status == '5')<div class="bg-theme-12 justify-content-center text-white d-flex align-items-center mb-2 p-2">{{ $plan->getStatus->description ?? $plan->getStatus->name }}</div>@endif
                @if($plan->status == '6')<div class="bg-theme-9 justify-content-center text-white d-flex align-items-center mb-2 p-2">{{ $plan->getStatus->description ?? $plan->getStatus->name }}</div>@endif
            </div>
        </div>
    </div>
</div>
<!-- END: General Report -->
<!-- BEGIN: Visitors -->
<div class="g-col-8 g-col-sm-8 mt-2">
    <div class="intro-y d-flex align-items-center h-10">
        <h2 class="fs-lg fw-medium me-5">
            
        </h2>
    </div>
    <div class="report-box-2 intro-y mt-5">
        <div class="box d-sm-flex">
            <div class="px-8 py-12 d-flex flex-column justify-content-center flex-1">
                <h2 class="fs-lg fw-medium mb-4">
                    AGIHAN (20%-60%-20%)
                </h2>
                <div class="text-gray-600 dark-text-gray-600 fs-xs">DANA OPERASI (20%)</div>
                <div class="mt-1.5 d-flex align-items-center">
                    <div class="fs-base">RM {{ number_format($infoData['do'], 2, '.', ',') }}</div>
                    <div class="bg-theme-{{$infoData['do_color']}} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($infoData['do_percent'], 2, '.', ',') }}%</div>
                    <div class="text-theme-{{$infoData['do_color']}} d-flex fs-xs fw-medium tooltip cursor-pointer ms-2" title="2% Lower than last month"> {{ number_format(abs(20 - $infoData['do_percent']), 2, '.', ',') }}% <i data-feather="chevron-up" class="w-4 h-4 ms-0.5"></i> </div>
                </div>
                <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">GERAN PENYELIDIKAN (60%)</div>
                <div class="mt-1.5 d-flex align-items-center">
                    <div class="fs-base">RM {{ number_format($infoData['gp'], 2, '.', ',') }}
                    </div>
                    <div class="bg-theme-{{$infoData['gp_color']}} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($infoData['gp_percent'], 2, '.', ',') }}%</div>
                    <div class="text-theme-{{$infoData['gp_color']}} d-flex fs-xs fw-medium tooltip cursor-pointer ms-2" title="2% Lower than last month"> {{ number_format(abs(60 - $infoData['gp_percent']), 2, '.', ',') }}% <i data-feather="chevron-down" class="w-4 h-4 ms-0.5"></i> </div>
                </div>
                <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">PEMBELIAN & PENYELENGGARAAN<br /> ALATAN PENYELIDIKAN (20%)</div>
                <div class="mt-1.5 d-flex align-items-center">
                    <div class="fs-base">RM {{ number_format($infoData['pp'], 2, '.', ',') }}</div>
                    <div class="bg-theme-{{$infoData['pp_color']}} rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">{{ number_format($infoData['pp_percent'], 2, '.', ',') }}%</div>
                    <div class="text-theme-{{$infoData['pp_color']}} d-flex fs-xs fw-medium tooltip cursor-pointer ms-2" title="2% Lower than last month"> {{ number_format(abs(20 - $infoData['pp_percent']), 2, '.', ',') }}% <i data-feather="chevron-down" class="w-4 h-4 ms-0.5"></i> </div>
                </div>
            </div>
            <div class="px-8 py-12 d-flex flex-column justify-content-center flex-1 border-top border-top-sm-0 border-start-sm border-gray-300 dark-border-dark-5 border-dashed">
                <h2 class="fs-lg fw-medium mb-4">
                    GARIS PANDUAN AGIHAN (20%-60%-20%)
                </h2>
                <div class="text-gray-600 dark-text-gray-600 fs-xs">DANA OPERASI (20%)</div>
                <div class="mt-1.5 d-flex align-items-center">
                    <div class="fs-base">RM {{ number_format($plan->baselineCost(20), 2, '.', ',') }}</div>
                    <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">20%</div>
                </div>
                <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">GERAN PENYELIDIKAN (60%)</div>
                <div class="mt-1.5 d-flex align-items-center">
                    <div class="fs-base">RM {{ number_format($plan->baselineCost(60), 2, '.', ',') }}</div>
                    <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">60%</div>
                </div>
                <div class="text-gray-600 dark-text-gray-600 fs-xs mt-5">PEMBELIAN & PENYELENGGARAAN<br /> ALATAN PENYELIDIKAN (20%)</div>
                <div class="mt-1.5 d-flex align-items-center">
                    <div class="fs-base">RM {{ number_format($plan->baselineCost(20), 2, '.', ',') }}</div>
                    <div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">20%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Visitors -->
<!-- BEGIN: Users By Age -->
{{-- <div class="g-col-12 g-col-sm-4 mt-2 mt-lg-6 mt-xl-2">
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
</div> --}}
<!-- END: Users By Age -->
<x-modal modal-id="editFund" title="Dana Diterima" form-id="edit-fund-form">
    <form id="edit-fund-form" action="{{ route('dana-ru.cadangan-agihan.store-plan', $year) }}" method="post">
        @csrf
        <label for="amount" class="form-label">Amaun</label>
        <div class="input-group">
            <div id="fund" class="input-group-text">RM</div> 
            <input type="text" name="fund" class="form-control bg-white input-mask" value="{{ $plan->amount ?? '' }}" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
        </div>
    </form>
</x-modal>

