<div class="box cursor-pointer zoom-in dashboard-card-{{ $theme }}">
    <div class="title text-center p-2">{{ $title }}</div>
    <div class="grid grid-cols-12 gap-3">
        <div class="g-col-4 p-3">
            <div class="text-center">
                <h5 class="fw-bold text-gray-800 fs-xs-8">TOTAL ALLOCATION</h5>
                <h2 class="fw-bold fs-lg">{{ $totalAllocation }}</h2>
            </div>
        </div>
        <div class="g-col-4 p-3">
            <div class="text-center">
                <h5 class="fw-bold text-gray-800 fs-xs-8">IO. OF PROGRAMME</h5>
                <h2 class="fw-bold fs-lg">{{ $totalProgrammes }}</h2>
            </div>
        </div>
        <div class="g-col-4 p-3">
            <div class="text-center">
                <h5 class="fw-bold text-gray-800 fs-xs-8">AVG ALLOCATION SHARE</h5>
                <h2 class="fw-bold fs-lg">{{ $avgAllocationShare }}</h2>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-3">
        <div class="g-col-6 p-3">
            <div class="text-center">
                <h5 class="fw-bold text-gray-800 fs-xs-8">AVG ALLOCATION PER PROGRAMME</h5>
                <h2 class="fw-bold fs-lg">{{ $avgAllocationProgramme }}</h2>
            </div>
        </div>
        <div class="g-col-6 p-3">
            <div class="text-center">
                <h5 class="fw-bold text-gray-800 fs-xs-8">SHARE OF TOTAL PROGRAMMES</h5>
                <h2 class="fw-bold fs-lg">{{ $totalProgrammesShare }}</h2>
            </div>
        </div>
    </div>
</div>
