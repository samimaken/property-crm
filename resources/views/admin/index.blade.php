@extends('admin.layouts.app')

@section('page_title','Dashbaord')

@section('pagelevel_stylesheetplugins')
    <link href="{{ asset('admin-assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('pagelevel_stylesheets')

@endsection

@section('content')
<div class="col-12">
    @if ($new == 0)
    <div class="alert alert-success">You are welcome to our platform</div>
    @endif
</div>
@endsection

@section('pagelevel_plugins')

<script src="{{ asset('admin-assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/horizontal-timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>

@endsection

@section('pagelevel_scripts')

   <script src="{{ asset('admin-assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>

@endsection
