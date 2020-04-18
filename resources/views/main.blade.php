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

    <div class="modal fade" id="enrolModal" tabindex="-1" role="dialog" aria-labelledby="enrolModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="enrolModalLabel">Create/Open Enrolment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['url'=>"/enrols/create-open"]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('student_id')}}
                    {{Form::text('student_id',null,['class'=>'form-control'])}}
                </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
    </div>

    @include("nav")

    <div class="container-fluid"  style="background-color: #fefefe;">
        <div class="row">
            <div class="col-lg-2 col-md-3 sidebar d-print-none">
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

    <script>
    $(document).ready(function(){
        // $(".alert").delay(10000).fadeOut(1000);
        $("#createOpenEnrol").click(function(){
            alert('enrol');
        })
    })
    </script>
    @yield('scripts')

    <footer class="d-print-none">
        Copyright &copy; 2019. Mater Dei College, Tubigon, Bohol <br>
        All rights reserved.
    </footer>
</body>
</html>
