<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Action log viewer</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('suffee-admin-template/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/template.css')}}">
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">


</head>

<body>



    <div id="right-panel" class="right-panel">


        <div class="container-fluid">
            @yield('content')
        </div>

    </div><!-- /#right-panel -->

    <script src="extensions/resizable/bootstrap-table-resizable.js"></script>
    <script>
        $(function(){
          $("table").resizableColumns({
            store: window.store
          });
        });
    </script>
</body>

</html>
