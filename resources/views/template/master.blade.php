<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--   <link rel="icon" href="favicon.ico"> -->
  <link rel="icon" href="{{asset('public/icon/univ-mulawarman.png')}}" type="image/x-icon"/>

  <title>English Empire </title>
  @include('template.css')

</head>

<body class="vertical  light  ">

  <div class="wrapper">

    @include('template.header')
    
    @include('template.sidebar')

    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 mb3 ">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">@yield('judul')</h2>
              </div>
            </div>
            @yield('content')

          </div> <!-- .col-12 -->
        </div> <!-- .row -->
      </div> <!-- .container-fluid -->


      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelLogout">Maaf</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Yakin Logout?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
              <a href="{{url('logout')}}"method="GET" class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            Logout</a>
            
            <form id="logout-form" action="{{ url('logout') }}" method="POST" >
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>

  </main> <!-- main -->
</div> <!-- .wrapper -->



@include('template.js')

</body>

</html>