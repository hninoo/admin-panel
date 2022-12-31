<script>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toastr-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "500",
    "hideDuration": "1000",
    "timeOut": "8000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    };
</script>

@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    toastr.error("{{ $error }}");
</script>
@endforeach
@endif

@if (Session::has('success'))
<script>
    toastr.success("{{ Session::get('success') }}");
</script>
@endif

@if (Session::has('error'))
<script>
    toastr.success("{{ Session::get('error') }}");
</script>
@endif
