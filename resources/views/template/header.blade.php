<nav class="topnav navbar navbar-light">
  <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
    <i class="fe fe-menu navbar-toggler-icon"></i>
  </button>

  <ul class="nav">


    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="avatar avatar-sm mt-2" style="color:black;">

          <!-- <img src="{{asset('public/profile/')}}" alt="..." class="avatar-img rounded-circle" style="width:40px;height:40px"> -->
          {{Auth::user()->full_name}}
        </span>
        
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="{{url('profile')}}">Profile</a>
        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">

          Logout
        </a>
      </div>


    </li>
  </ul>
</nav>