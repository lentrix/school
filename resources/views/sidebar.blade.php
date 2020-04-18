<div class="user-details">
    <img src="{{asset('images/avatars/unknown-512.png')}}"
        alt="Profile Picture" class="profile-pic">

    <h3>{{auth()->user()->fullName}}</h3>
</div>

<div>
    <a href='{{url("/users/".auth()->user()->id)}}' class="sidebar-link">Profile</a>
    <a href="{{url('/users/load')}}" class="sidebar-link">Teaching Load</a>
    <a href="{{url('/logout')}}" class="sidebar-link">Logout</a>
</div>
