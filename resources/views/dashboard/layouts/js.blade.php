<!-- CKEditor Files -->
<script src="{{ asset('theme/js/app.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-balloon-block.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-balloon.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-classic.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-document.js') }}"></script>
<script src="{{ asset('theme/js/ckeditor-inline.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('theme/js/chart.min.js') }}"></script>

<!-- Notifications Plugin -->
{{-- <script src="{{ asset('theme/js/plugins/bootstrap-notify.js') }}"></script> --}}

<!-- Advanced Form Select -->
<script src="{{ asset('theme/js/plugins/select2.min.js') }}"></script>

<!-- Additional General Script -->
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    // Temporary Random Number Generator
    function intRand(max) {
        return Math.floor(Math.random() * max);
    }
</script>