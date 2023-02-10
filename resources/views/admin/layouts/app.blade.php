  <!doctype html>
  @if(Session::has('rtl'))
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
  @else
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @endif
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
  <meta content="" name="author" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  @include('admin.layouts.head')
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
  <!-- BEGIN HEADER -->
      @include('admin.layouts.topbar')
  <!-- END HEADER -->
  <!-- BEGIN HEADER & CONTENT DIVIDER -->
  <div class="clearfix"> </div>
  <!-- END HEADER & CONTENT DIVIDER -->
  <!-- BEGIN CONTAINER -->
  <div class="page-container">
  <!-- BEGIN SIDEBAR -->
      @include('admin.layouts.sidebar')
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
      @section('content')
      @show
  <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
  </div>
  <!-- END CONTAINER -->
  <!-- BEGIN FOOTER -->
       @include('admin.layouts.footer')
  <!-- END FOOTER -->
</div>
@include('admin.layouts.scripts')

</body>
</html>
