@include("header")
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    @include('nav')
  </header>
  <!-- Left side column. contains the logo and sidebar -->
    @include('sidebar')
   
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="">
                    <div class="clearfix"></div>
                    <br>
                    <div class="">
                        <form action="<?php  echo url('/search');?>" method="post">
                            <input type="text" name="search" class="form-control col-sm-2" placeholder="Search for...">
                            {{ csrf_field() }}
                            <br>
                            <br>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" style="float: right;" >Go!</button>
                            </span>
                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($ebay))
        <div class="row" style="display: none;">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Save as
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php  echo url('/pdf');?>">PDF</a></li>
                          <li><a href="<?php  echo url('/csv');?>">CSV</a></li>
                          <!-- <li><a href="#">JavaScript</a></li> -->
                        </ul>
                   </div>
                </div>
            </div>
        </div>
       <div class="overlay" style="font-size: 162px;text-align: center;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
      
        <!-- /table row stars -->

        <div class="row" style="display: none;">
        <div class="col-sm-8 col-md-offset-2">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <td>
                            Image
                        </td>
                        <td>
                        Product Name
                        </td>
                        <td>
                            Product price
                        </td>
                        <td>
                            Seller
                        </td>
                    </tr>
                    <tbody>
                       
                        @foreach ($ebay as $user)
                            <tr>
                                <td>
                                   <img src="{{ $user['img']}}"> 
                                </td>
                                <td style=" word-wrap: break-word;">
                                {{$user['title']}}
                                </td>
                                <td>
                                    {{$user['price']}}
                                </td>
                                <td>
                                  {{$user['seller']}}
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($ebay as $user)
                            <tr>
                                <td>
                                   <img src="{{ $user['img']}}"> 
                                </td>
                                <td style=" word-wrap: break-word;">
                                {{$user['title']}}
                                </td>
                                <td>
                                    {{$user['price']}}
                                </td>
                                <td>
                                  {{$user['seller']}}
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
    @endif
    <!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>