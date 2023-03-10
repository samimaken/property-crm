<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Datum | CRM Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    @yield('page_styles')
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.topbar')

        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                  @yield('content')
                </div>
                <!-- Page end  -->
            </div>
        </div>
    </div>
    <!-- Wrapper End-->
    @include('admin.layouts.footer')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('js/backend-bundle.min.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/customizer.js') }}"></script>

    <script src="{{ asset('js/sidebar.js') }}"></script>

    <!-- Flextree Javascript-->
    <script src="{{ asset('js/flex-tree.min.js') }}"></script>
    <script src="{{ asset('js/tree.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('js/table-treeview.js') }}"></script>

    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    <!-- Vectoe Map JavaScript -->
    <script src="{{ asset('js/vector-map-custom.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <script src="{{ asset('js/charts/01.js') }}"></script>
    <script src="{{ asset('js/charts/02.js') }}"></script>

    <!-- slider JavaScript -->
    <script src="{{ asset('js/slider.js') }}"></script>

    <!-- Emoji picker -->
    <script src="{{asset('vendor/emoji-picker-element/index.js')}}" type="module"></script>


    <!-- app JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('admin.include.sweetalert')
    @yield('page_scripts')
    <script>
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('admin.markNotification') }}", {
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id
                }
            });
        }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).closest('.admin-notification').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('.admin-notifications').remove();
                $('.admin-notification-badge').remove();
                $(this).remove();
            })
        });
    });
</script>
</body>

</html>
