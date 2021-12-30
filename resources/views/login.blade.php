<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Form Login</h3>
                </div>
                <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="card-body">
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for=""><strong>Username</strong></label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Register</a> sekarang!</p>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> -->

<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
        body {
   margin: 0;
   padding: 0;
   background-size: fixed;
   background-color: white;
   background-position: center;
   background-repeat: no-repeat;
   background-attachment: fixed;
   font-family: sans-serif;
 }
 .login {
   position: fixed;
   top: 50%;
   left: 45%;
   transform: translate(-30%, -50%);
   background: #02275d;
   padding: 50px;
   width: 500px;
   box-shadow: 0px 0px 25px 10px black;
   border-radius: 15px;
 }
 .avatar {
   font-size: 30px ;
   background: #E59866;
   width: 50px;
   height: 50px;
   line-height: 50px;
   position: fixed;
   left: 50%;
   top: 0;
   transform: translate(-50%, -50%);
   text-align: center;
   border-radius: 50%;
 }
 .login h2 {
   text-align: center;
   color: white;
   font-size: 30px;
   font-family: sans-serif;
   letter-spacing: 3px;
   padding-top: 0;
   margin-top: -20px;
 }
 .box-login {
   display: flex;
   justify-content:space-between;
   margin: 10px;
   border-bottom: 2px solid white;
   padding: 8px 0;
 }
 .box-login i {
   font-size: 23px;
   color: white;
   padding: 5px 0;
 }
 .box-login input {
   width: 85%;
   padding: 5px 0;
   background: none;
   border: none;
   outline: none;
   color: white;
   font-size: 18px;
 }
 .box-login input::placeholder {
   color: white;
 }
 .btn-login
 .box-login input:hover{
   background: rgba(10, 10, 10,s 0.5);
 }
 .btn-login {
   margin-left: 10px;
   margin-bottom: 20px;
   background: none;
   border: 1px solid white;
   width: 92.5%;
   padding: 10px;
   color: white;
   font-size: 18px;
   letter-spacing: 3px;
   cursor: pointer;
   }
 .btn-login:hover{
   background: rgba(12, 30, 15, 0.5);
 }
 .bottom {
   margin-left: 10px;
   margin-right: 10px;
   display: flex;
   justify-content: space-between;
 }
 .bottom a {
   color: white;
   font-size: 15px;
   text-decoration: none;
 }
 .bottom a:hover {
 text-decoration: underline;
 }
    </style>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="login">
        <div class="avatar">
            <i class="fa fa-user"></i>
        </div>
        <h2>Login SINOPAK</h2>
        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Something it's wrong:
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="box-login">
            <i class="fas fa-envelope-open-text"></i>
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="box-login">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" name="login" class="btn-login">Login</button>
        <div class="bottom">
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
    </form>
    </body>
  </html>

<!-- <!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="{{ url('assets/user/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px
        }

        .card2 {
            margin: 0px 40px
        }

        .logo {
            width: 200px;
            height: 100px;
            margin-top: 20px;
            margin-left: 35px
        }

        .image {
            width: 360px;
            height: 280px
        }

        .border-line {
            border-right: 1px solid #EEEEEE
        }

        .facebook {
            background-color: #3b5998;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .twitter {
            background-color: #1DA1F2;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .linkedin {
            background-color: #2867B2;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .line {
            height: 1px;
            width: 40%;
            background-color: #E0E0E0;
            margin-top: 10px
        }

        .or {
            width: 20%;
            font-weight: bold
        }

        .text-sm {
            font-size: 14px !important
        }

        ::placeholder {
            color: #BDBDBD;
            opacity: 1;
            font-weight: 300
        }

        :-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        ::-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        input,
        textarea {
            padding: 10px 12px 10px 12px;
            border: 1px solid lightgrey;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 14px;
            letter-spacing: 1px
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        a {
            color: inherit;
            cursor: pointer
        }

        .btn-blue {
            background-color: #1A237E;
            width: 150px;
            color: #fff;
            border-radius: 2px
        }

        .btn-blue:hover {
            background-color: #000;
            cursor: pointer
        }

        .bg-blue {
            color: #fff;
            background-color: #1A237E
        }

        @media screen and (max-width: 991px) {
            .logo {
                margin-left: 0px
            }

            .image {
                width: 300px;
                height: 220px
            }

            .border-line {
                border-right: none
            }

            .card2 {
                border-top: 1px solid #EEEEEE !important;
                margin: 0px 15px
            }
        }
    </style>
</head>
<body>
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="telkom.jpg" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <br><br><br>
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row px-3 mb-4">
                        <div class="line mb-2"></div>
                        <small class="or text-center">SINOPAK</small>
                        <div class="line mb-2"></div>
                    </div>
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form  action="{{ route('login') }}" method="post">
                        <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Username</h6>
                            </label> <input class="mb-4" type="text" name="username" placeholder="Enter a valid username address">
                        </div>
                        <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Password</h6>
                            </label> <input type="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="row mb-3 px-3">
                            <button type="submit" name="login" class="btn-login">Login</button>
                        </div>
                        <div class="row mb-4 px-3">
                            <small class="font-weight-bold">Don't have an account? <a class="text-danger"  href="{{ route('register') }}">Register</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3">
                <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
            </div>
        </div>
    </div>
</div>
    <script src="{{ url('assets/user/js/dist/jquery.js') }}"></script> 
    <script src="{{ url('assets/user/dist/js/bootstrap.js') }}"></script>
</body>
</html> -->