@error('fund')
<div class="g-col-12 intro-x">
    <div class="alert alert-danger-soft alert-dismissible fade show d-flex align-items-center" role="alert">
        <i data-feather="alert-circle" class="w-6 h-6 me-2"></i>
        <span>{{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
    </div>
</div>
@enderror
<div class="g-col-4">
    <div class="box p-5 bg-theme-3 intro-x">
        <form id="form_1" action="{{ route('dana-ru.cadangan-agihan.store-plan', $year) }}" method="post">
            @csrf
            <div class="d-flex flex-wrap gap-3 align-items-center">
                <div class="me-auto w-3/4">
                    <div class="text-white text-opacity-70 d-flex lh-3"> Dana Diterima </div>
                    <div class="text-white position-relative fs-2xl fw-medium lh-5 mt-3.5"> 
                        <div class="input-group">
                            <div id="fund" class="input-group-text">RM</div> 
                            <input type="text" name="fund" class="form-control bg-white input-mask" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" placeholder="" aria-label="Email" aria-describedby="input-group-email">
                        </div>
                    </div>
                </div>
                <button type="submit" class="d-flex align-items-center justify-content-center w-12 h-12 rounded-circle bg-white dark-bg-dark-1 bg-opacity-20 bg-opacity-30-hover text-white"> 
                    <i data-feather="plus" class="w-6 h-6"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@push('custom-js')
{{-- <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script> --}}
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>

<script>
    $(".input-mask").inputmask(); 
</script>
@endpush