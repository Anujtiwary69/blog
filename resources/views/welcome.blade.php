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
                        <form action="<?php  echo url('/search');?>" method="get">
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
        <br>
        <br>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(!empty($ebay))
        <div class="row" style="display: none;" id="action">
            <div class="col-sm-12">
                <!-- <div class="col-sm-4"> -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Save as
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php  echo url('/pdf?'.$_SERVER['QUERY_STRING']);?>">PDF</a></li>
                          <li><a href="<?php  echo url('/csv?'.$_SERVER['QUERY_STRING']);?>">CSV</a></li>
                          <li><a href="<?php  echo url('/save?'.$_SERVER['QUERY_STRING']);?>">Saves</a></li>
                          <!-- <li><a href="#">JavaScript</a></li> -->
                        </ul>
                   <!-- </div> -->
                </div>
            </div>
        </div>
       <div class="overlay" style="font-size: 162px;text-align: center;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
      <!-- //for css -->
        <!-- /table row stars -->

        <div class="row" style="display: none;" id="tabledata">
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
                       
                        @foreach ($amazon as $user)
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
    @if($css!="stop")
        @include('jsFilesHref');
    @endif