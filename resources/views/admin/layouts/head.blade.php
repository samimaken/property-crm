<title>@yield('page_title')</title>

  <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    @if(Session::has('rtl'))
      <link href="{{ asset('admin-assets-rtl/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets-rtl/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet" type="text/css" />
      @else
      <link href="{{ asset('admin-assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('admin-assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
      @endif
        
        <!-- END GLOBAL MANDATORY STYLES -->


        <!-- BEGIN PAGE LEVEL PLUGINS -->
        @section('pagelevel_stylesheetplugins')
        @show
        
        <!-- END PAGE LEVEL PLUGINS -->


        <!-- BEGIN THEME GLOBAL STYLES -->
    @if(Session::has('rtl'))

        <link href="{{ asset('admin-assets-rtl/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('admin-assets-rtl/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('admin-assets-rtl/layouts/layout/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets-rtl/layouts/layout/css/themes/darkblue-rtl.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('admin-assets-rtl/layouts/layout/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('admin-assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('admin-assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('admin-assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('admin-assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    {{--   pagelevel stylesheets--}}
    @yield('pagelevel_stylesheets')