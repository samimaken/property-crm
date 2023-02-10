<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel | Change Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-color: gray">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html" style="color: white"><b>Admin <font style="color: #FD5814">Panel</font></b></span>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Change Your Password</p>
        @include('admin.include.alerts')
      <form action="{{ url('admin/reset-password') }}" method="post">
        @csrf
         <input type="hidden" name="token" value="{{ $token }}">

         <div class="input-group mb-3">
           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" " autocomplete="email" autofocus>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" style="color: #FD5814"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" style="color: #FD5814"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" style="color: #FD5814"></span>
            </div>
          </div>
        </div>
      
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
         <div class="col-4">
            <button type="submit" class="btn btn btn-block" style="background-color: #FD5814;color: white !important">Change</button>
          </div>
          <!-- /.col -->
        </div>

      </form>

      
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js')}}"></script>

</body>
</html>
