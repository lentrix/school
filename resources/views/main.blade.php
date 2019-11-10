<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/solid.css')}}">
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">

    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <title>{{env('APP_NAME')}}</title>
</head>
<body>

    @include("nav")
    <div class="container-fluid"  style="background-color: #dfdfdf;">
        <div class="row">
            <div class="col-lg-2 col-md-3 sidebar">
                @if(!auth()->guest())
                    @include('sidebar')
                @endif
            </div>
            <div class="col-lg-10 col-md-9 content">
                @include('messages')
                @yield('content')
            </div>
        </div>
    </div>
    @yield('scripts')

    <footer>
        Copyright &copy; 2019. Mater Dei College, Tubigon, Bohol <br>
        All rights reserved.
    </footer>
</body>
</html>
