@include("header")
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Shield </b>360</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>
     @if($errors->any())
    <h4 style="color: red;text-align: center;">{{$errors->first()}}</h4>
    @endif
    <br>
    <form action="<?php echo url('/validate');?>" method="post" >
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
          {{ csrf_field() }}     
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat right" style="float:left;">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
</body>
</html>
