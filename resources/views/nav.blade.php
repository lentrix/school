<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">{{env('APP_NAME')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @if(!auth()->guest())
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="recordsDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-scroll"></i> Records
            </a>
            <div class="dropdown-menu" aria-labelledby="recordsDropDown">
                <a class="dropdown-item" href="{{url('/departments')}}">Departments</a>
                <a class="dropdown-item" href="{{url('/programs')}}">Programs</a>
                <a class="dropdown-item" href="{{url('/courses')}}">Courses</a>
                <a class="dropdown-item" href="{{url('/strands')}}">Strands</a>
                <a class="dropdown-item" href="{{url('/sections')}}">Sections</a>
                <a class="dropdown-item" href="{{url('/students')}}">Students</a>
                <a class="dropdown-item" href="{{url('/periods')}}">School Periods</a>
                <a class="dropdown-item" href="{{url('/levels')}}">Levels</a>
                <a class="dropdown-item" href="{{url('/venues')}}">Venues</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="transactionDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-handshake"></i> Transactions
            </a>
            <div class="dropdown-menu" aria-labelledby="transactionDropDown">
                <a class="dropdown-item" href="#">Enrolment</a>
                <a class="dropdown-item" href="{{url('/classes')}}">Class Offerings</a>
                <a class="dropdown-item" href="#">Add &amp; Change</a>
                <a class="dropdown-item" href="#">Withdrawal</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-list-alt"></i> Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="reportDropDown">
                <a class="dropdown-item" href="#">Student Listing</a>
                <a class="dropdown-item" href="#">Student Grade</a>
                <a class="dropdown-item" href="#">Class List</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="utilitiesDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cogs"></i> Utilities
            </a>
            <div class="dropdown-menu" aria-labelledby="utilitiesDropDown">
                <a class="dropdown-item" href="{{url('/users')}}">Users &amp; Roles</a>
                <a class="dropdown-item" href='{{url("/users/". auth()->user()->id . "/change-password")}}'>Change Password</a>
            </div>
        </li>
      </ul>
    </div>
    @endif
  </nav>
