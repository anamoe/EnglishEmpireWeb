
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 {{ request()->is('message*') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/message')}}">
            <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style="height:20px; width:20px;">
            <span class="ml-3 item-text"> Message Notification</span>
        </a>
    </li>
</ul>
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 active">
        <a class="nav-link" href="{{url('/slideinfo')}}">
            
        <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
            <span class="ml-3 item-text">Slide Info</span>
        </a>
    </li>
</ul>


<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 {{ request()->is('infoupdate*') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/infoupdate')}}">
            <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style="height:20px; width:20px;">
            <span class="ml-3 item-text"> Info Update</span>
        </a>
    </li>
</ul>


<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 active">
        <a class="nav-link" href="{{url('/courseprogram')}}">
            
        <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
            <span class="ml-3 item-text"> Course Program</span>
        </a>
    </li>
</ul>

<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 active">
        <a class="nav-link" href="{{url('/ortu')}}">
            
        <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
            <span class="ml-3 item-text"> Parent</span>
        </a>
    </li>
</ul>


<!-- <ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 active">
        <a class="nav-link" href="{{url('')}}">
            
        <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
            <span class="ml-3 item-text">Student Schedule</span>
        </a>
    </li>
</ul>
 -->


<!-- <ul class="navbar-nav flex-fill w-100 mb-2">
  <li class="nav-item w-100 active">
    <a class="nav-link" href="{{url('quizcategory')}}">
     

      <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
  
      <span class="ml-3 item-text">Quiz Category</span>
    </a>
  </li>
</ul> -->

<!-- <ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100 active">
        <a class="nav-link" href="{{url('/exam')}}">
            
        <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
            <span class="ml-3 item-text"> Exam</span>
        </a>
    </li>
</ul> -->


<!-- <ul class="navbar-nav flex-fill w-100 mb-2">
  <li class="nav-item w-100 active">
    <a class="nav-link" href="{{url('user')}}">
    <img class="" src="{{asset('public/icon/star.png')}}" alt="User Avatar " style=" height:20px; width:20px;">
      <span class="ml-3 item-text">Student</span>
    </a>
  </li>
</ul> -->

