<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--   <link rel="icon" href="favicon.ico"> -->
    <link rel="icon" href="{{asset('public/icon/Logo.png')}}" type="image/x-icon"/>
    @include('template.css')
</head>

<style>
    body {
        background-color: #b7dde1;
        -webkit-animation: color 12s ease-in 0s infinite alternate running;
        -moz-animation: color 12s linear 0s infinite alternate running;
        animation: color 12s linear 0s infinite alternate running;
    }

    @-webkit-keyframes color {
        0% {
            background-color: #b7dde1;
        }

        25% {
            background-color: #b7dde1;
        }

        50% {
            background-color: #b7dde1;
        }

        75% {
            background-color: #91aec4;
        }

        100% {
            background-color: #5f84a2;
        }

    }
</style>

<body>


    @if(session()->has('message'))
    <div class="notif col-10 col-xs-11 col-sm-4 alert alert-success d-block" role="alert" id="notif">
        <button type="button" class="close" onclick="document.getElementById('notif').classList.remove('d-block')">×</button>
        <span data-notify="icon" class="fa fa-bell"></span>
        <span data-notify="title">Success</span> <br>
        <span data-notify="message">Berhasil Mendaftar</span>
    </div>
    @endif
    @if(session()->has('error'))
    <div  class="notif col-10 col-xs-11 col-sm-4 alert alert-danger d-block" role="alert" id="notif">
        <button type="button" class="close" onclick="document.getElementById('notif').classList.remove('d-block')">×</button>
        <span data-notify="icon" class="fa fa-bell"></span> 
        <span data-notify="title">Gagal</span> <br>
        <span data-notify="message">{{session()->get('error')}}</span>
    </div>
    @endif

    <section class="ftco-section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="card shadow-sm my-5 bg-primary">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img class="img-circle rounded-circle" src="{{('public/icon/Logo.png')}}" alt="" style=" height:100px; width:100px;">
                            </div>
                            <h3 class="text-center mb-4">Masuk</h3>
                            <form action="{{url('postlogin')}}" method="post" class="login-form">
                                @csrf
                                <div class="form-group">
                                    <label style="color: white;">ID NUMBER</label>
                                    <input type="text" name="id_number" class="form-control rounded-left" placeholder="ID NUMBER" required>
                                </div>
                                <label style="color: white;">PASSWORD</label>
                                <div class="form-group d-flex">
                                    <input type="password" name="password" class="form-control rounded-left" placeholder="PASSWORD" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success rounded submit px-3">Login</button>
                                </div>
                                <div class="form-group d-md-flex">
                               
                                </div>
                            </form>

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</body>

<script>


</script>

</html>