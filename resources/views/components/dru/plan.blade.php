<div class="g-col-12">
    <div class="intro-y d-block d-sm-flex align-items-center h-10">
        <a href="{{ route('dana-ru.cadangan-agihan.index', ["year"=>$year]) }}" class="btn @if(!$type) btn-dark @else btn-primary @endif me-2">Keseluruhan</a>
        <button type="button" class="btn @if($type == 'cadangan_agihan') btn-dark @else btn-primary @endif me-2" data-bs-toggle="modal" data-bs-target="#agihanTambahan">Cadangan Agihan</button>
        <button type="button" class="btn @if($type == 'agihan_semula') btn-dark @else btn-primary @endif me-2" data-bs-toggle="modal" data-bs-target="#agihanSemula">Agihan Semula</button>
        <button type="button" class="btn @if($type == 'pindahan') btn-dark @else btn-primary @endif" data-bs-toggle="modal" data-bs-target="#pindahan">Pindahan</button>
    </div>
</div>
<x-modal modal-id="agihanTambahan" title="Cadangan Agihan" :footerFlag="false">
    @foreach ($plans->whereIn('type', [1,2]) as $plan)
    <a href="{{ route('dana-ru.cadangan-agihan.index', ['year'=> $year, 'type' => 'cadangan_agihan', 'plan_id' => $plan->id]) }}">
    <div class="box p-5 cursor-pointer zoom-in border mb-4" style="border-color: #1C3FAA">
        <div class="d-flex w-full" style="justify-content: space-between !important;">
            <div class="fw-medium fs-base">Agihan [ {{ $plan->created_at }} ]</div>
            @if($plan->type == 1)<div class="bg-theme-8 rounded-pill justify-content-center fs-xs d-flex align-items-center px-2 ms-1">Asal</div>
            @else <div class="bg-theme-9 rounded-pill justify-content-center fs-xs d-flex align-items-center px-2 ms-1">Tambahan</div>
            @endif
        </div>
        <div class="fw-bold fs-lg">RM {{ number_format($plan->amount, 2, '.', ',') }}</div>
    </div>
    </a>
    @endforeach
    @if($plans->where('status', '!=', 6)->count() == 0)
    <form id="agihanTambahanForm" action="{{ route('dana-ru.cadangan-agihan.store-additional-plan') }}" method="post">
        @csrf
        <input type="hidden" name="type" value="store">
        <input type="hidden" name="year" value="{{ $year }}">
    </form>
    <button type="submit" form="agihanTambahanForm" class="btn btn-outline-dark w-full">ADD</button>
    @endif
</x-modal>

<x-modal modal-id="agihanSemula" title="Cadangan Agihan Semula" :footerFlag="false">
    @forelse ($plans->whereIn('type', [3]) as $plan)
    <a href="{{ route('dana-ru.cadangan-agihan.index', ['year'=> $year, 'type' => 'agihan_semula', 'plan_id' => $plan->id]) }}">
    <div class="box p-5 cursor-pointer zoom-in border mb-4" style="border-color: #1C3FAA">
        <div class="d-flex w-full" style="justify-content: space-between !important;">
            <div class="fw-medium fs-base">Agihan Semula [ {{ $plan->created_at }} ]</div>
        </div>
        <div class="fw-bold fs-lg">RM {{ number_format($plan->amount, 2, '.', ',') }}</div>
    </div>
    </a>
    @empty
    <p class="w-full text-center text-gray-500 p-5">Tiada Agihan</p>
    @endforelse
    @if($plans->where('type', 3)->where('status', '!=', 6)->count() == 0)
    <form id="agihanSemulaForm" action="{{ route('dana-ru.cadangan-agihan.store-redist-plan') }}" method="post">
        @csrf
        <input type="hidden" name="type" value="store">
        <input type="hidden" name="year" value="{{ $year }}">
    </form>
    <button type="submit" form="agihanSemulaForm" class="btn btn-outline-dark w-full">ADD</button>
    @endif
</x-modal>

<x-modal modal-id="pindahan" title="Pindahan" :footerFlag="false">
    @forelse ($plans->whereIn('type', [4]) as $plan)
    <a href="{{ route('dana-ru.cadangan-agihan.index', ['year'=> $year, 'type' => 'pindahan', 'plan_id' => $plan->id]) }}">
    <div class="box p-5 cursor-pointer zoom-in border mb-4" style="border-color: #1C3FAA">
        <div class="d-flex w-full" style="justify-content: space-between !important;">
            <div class="fw-medium fs-base">Pindahan [ {{ $plan->created_at }} ]</div>
        </div>
        <div class="fw-bold fs-lg">RM {{ number_format($plan->amount, 2, '.', ',') }}</div>
    </div>
    </a>
    @empty
    <p class="w-full text-center text-gray-500 p-5">Tiada Pindahan</p>
    @endforelse
    @if($plans->where('status', '!=', 6)->count() == 0)
    <form id="pindahanForm" action="{{ route('dana-ru.cadangan-agihan.store-transfer') }}" method="post">
        @csrf
        <input type="hidden" name="type" value="store">
        <input type="hidden" name="year" value="{{ $year }}">
    </form>
    <button type="submit" form="pindahanForm" class="btn btn-outline-dark w-full">ADD</button>
    @endif
</x-modal>