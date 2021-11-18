<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
{{--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>--}}
{{--    --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('feather-icons-web/feather.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('summernote/summernote-lite.css') }}">

    @yield('style')
</head>
<body>

<section class="main container-fluid">
    <div class="row">
        <!--        sidebar start-->
        @include('layouts.sidebar')
        <!--        sidebar end-->
        <div class="col-12 col-lg-9 col-xl-10 vh-100 py-3 content">
        @include('layouts.header')
            <!--content Area Start-->
                @yield('content')

            <!--content Area Start-->
        </div>
    </div>
</section>


{{--<script src="vendor/way_point/jquery.waypoints.js"></script>--}}
{{--<script src="vendor/counter_up/counter_up.js"></script>--}}
{{--<script src="vendor/chart_js/chart.min.js"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/scroll.min.js') }}"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')  }}"></script>
<script src="{{ asset('summernote/summernote-lite.js') }}"></script>

@yield('footer')
{{--@auth--}}
{{--    @empty(\Illuminate\Support\Facades\Auth::user()->phone)--}}
{{--        @include('profile.userInfo')--}}
{{--    @endempty--}}

{{--@endauth--}}
@include('components.toast')

@include('components.message')
{{--<script src="js/dashboard.js"></script>--}}
</body>
</html>
