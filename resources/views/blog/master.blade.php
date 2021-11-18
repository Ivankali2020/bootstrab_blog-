<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Ivan BLog</title>

{{--    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">--}}



<!-- Bootstrap core CSS -->
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        .search:focus{
            outline: none;
            border: none;
        }
        .search{
            outline: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
</head>
<body>

<div class="container" id="top">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1 d-none d-md-block ">
                <a class="link-secondary" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark justify-content-center d-flex align-items-center" href="{{ route('blog.index') }}">
                    <img src="{{ asset("logo/logo.png") }}" alt="" style="width: 50px;height: 50px;">
                    <span>Ivan</span>
                </a>

            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                @php
                    $head = \Illuminate\Support\Facades\Request::segment(2);
                    $url = \Illuminate\Support\Facades\Request::url();
                @endphp
                <form action="{{ url($url) }}" method="GET" class="link-secondary  d-none d-md-block text-decoration-none mx-3">
                    <input type="text" name="search" class="form-control-sm border-0 rounded search  ">

                    <button class="border-0 bg-transparent text-primary "> <i class="feather-search "></i></button>
                </form>
                <a class="btn  btn-outline-secondary btn-sm align-self-end " href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </header>
    @include('blog.nav')
</div>
    @yield('content')

<footer class="blog-footer position-relative">
    <p> The Original <b>&copy;</b> CopyRight Own By Bootstrap.</p>
    <p><a href="#">ivan.com</a> is developed by <span class="font-weight-bold ">Ivan Junior</span>  </p>
    <p class="position-absolute " style="top: 0;">
        <button  class="btn btn-outline-primary m-3 " onclick="window.scrollTo({top:0,behavior:'smooth'})"> <i class="fa feather-arrow-up font-weight-bolder "></i></button>
    </p>
</footer>



</body>
</html>
