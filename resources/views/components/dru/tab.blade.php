<div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
    <ul class="nav nav-pills w-full w-lg-1/2  bg-theme-8 bg-opacity-50 dark-bg-dark-2 rounded-2 p-1" id="pills-tab" role="tablist">
        <li class="nav-item flex-1" role="pemantauan">
            <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, [null,'list'])) active @endif" id="list-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Borang Agihan</button>
        </li>
        @if($verificationTab)
        <li class="nav-item flex-1" role="pemantauan">
            <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, ['verification'])) active @endif" id="verification-tab" data-bs-toggle="pill" data-bs-target="#verification" type="button" role="tab" aria-controls="verification" aria-selected="false">{{ $verificationLabel }}</button>
        </li>
        @endif
        <li class="nav-item flex-1" role="pemantauan">
            <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, ['timeline'])) active @endif" id="timeline-tab" data-bs-toggle="pill" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="false">Timeline</button>
        </li>
    </ul>
</div>

{{-- <div class="d-flex p-5 align-item-center border-bottom border-gray-200 dark-border-dark-5">
    <ul class="nav nav-pills w-full w-lg-1/2  bg-theme-8 bg-opacity-50 dark-bg-dark-2 rounded-2 p-1" id="pills-tab" role="tablist">
        <li class="nav-item flex-1" role="pemantauan">
            <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, [null,'list'])) active @endif" id="list-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Senarai Cadangan Agihan</button>
        </li>
        @if ((getAccessControl('dru_pca_1') && in_array($plan->status,[2, 3])) || (getAccessControl('dru_pca_2') && in_array($plan->status,[4])))
        <li class="nav-item flex-1" role="pemantauan">
            <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, ['verification'])) active @endif" id="verification-tab" data-bs-toggle="pill" data-bs-target="#verification" type="button" role="tab" aria-controls="verification" aria-selected="false">{{ $plan->getStatus->next_level_desc }}</button>
        </li>
        @endif
        <li class="nav-item flex-1" role="pemantauan">
            <button class="nav-link w-full py-1.5 px-2 @if(in_array($tab, ['timeline'])) active @endif" id="timeline-tab" data-bs-toggle="pill" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="false">Timeline</button>
        </li>
    </ul>
</div> --}}