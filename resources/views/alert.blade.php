<script src="{{ asset('theme/js/sweetalert2.js') }}"></script>
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
</script>