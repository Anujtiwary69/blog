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
         <div class="col-md-8 col-md-offset-2"> 
         <p align="center">Refreshing status in <span id="timer">60</span>&nbsp;<a id="reloadThePage" href="#"><u>Refresh now</u></a> </p>
          <table class="table table-striped table-bordered ">
                <thead>
                    <tr class="info" style="">
                        <td>
                            <b>Project Name</b>
                        </td>
                        <td>
                            <b>Project Description</b>
                        </td>
                        <td>
                            <b>Keyword</b>
                        </td>
                        <td>
                            <b>Current Status</b>
                        </td>
                        <td>
                          <b>Completed Page</b>
                        </td>
                        <td>
                          <b>Action</b>
                        </td>
                    </tr>
                    @foreach($projects as $project)
                      <tr>
                        <td>{{$project->name}}</td>
                        <td>{{$project->des}}</td>
                        <td>{{$project->keyword}}</td>
                        <td>
                        @if($project->status==0)
                         <i class="fa fa-spinner" aria-hidden="true" style="color: red;"></i><span style="color: red;"> &nbsp;Queue</span>
                        @elseif($project->status==1)
                          <i class="fa fa-magnet" aria-hidden="true" style="color: orange;">&nbsp;</i><span style="color: orange;">Process</span>
                        @elseif($project->status==2)
                          <i class="fa fa-check" aria-hidden="true" style="color: green;"></i>&nbsp;<span style="color: green;">Completed</span>
                        @endif

                        
                        </td>
                        <td>
                          @if($project->status==1)
                            {{$page}}
                          @else
                           {{$project->page}}
                           @endif
                        </td>
                        <td>
                        @if($project->status==2)
                        <a href="<?php echo url('result?id='.$project->id);?>"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;View
                        @else
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        @endif

                        </td>

                        </tr>

                    @endforeach
                    <tr>
                    </tr>
        </div>
  <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var counter = 0;
    interval1 = setInterval(function() {
        counter++;
        console.log(counter);
        $("#timer").text(60-counter);
        if(counter==60)
        {
          location.reload();
          clearInterval(interval1);  
        }
              
    }, 1000);
    $('#reloadThePage').click(function() {
      location.reload();
    });
  });
</script>