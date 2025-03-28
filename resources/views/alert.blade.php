<link href="{{ asset('theme/css/toastr.css') }}" rel="stylesheet" />

<script src="{{ asset('theme/js/sweetalert2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('theme/js/toastr.js') }}"></script>
<script>
    @if(session()->has('success'))    
        swal("Success", "{{ session()->get('success') }}", 'success')
    @endif
    @if(session()->has('error'))
        swal("Problem", "{{ session()->get('error') }}", 'error')
    @endif
    @if(session()->has('info'))
        swal("Notice", "{{ session()->get('info') }}", 'info')
    @endif

    function toastr_alert(type, message) {
        toastr.options = {
            "closeButton": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "timeOut": "1000",
        }
        if(type == 'success')toastr.success(message, 'Success');
        if(type == 'error')toastr.error(message, 'Error');
    }
</script>