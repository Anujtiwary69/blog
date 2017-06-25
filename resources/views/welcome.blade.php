
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
                                <button class="btn btn-default" id="searchButton" type="submit" style="float: right;" >Go!</button>
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
       
        <div class="row" style="" id="action">
            <div class="col-sm-12">
                <!-- <div class="col-sm-4"> -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Save as
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php  echo url('/pdf?id='.$_GET['id']);?>">PDF</a></li>
                          <li><a href="<?php  echo url('/csv?id='.$_GET['id']);?>">CSV</a></li>
    
                          <!-- <li><a href="#">JavaScript</a></li> -->
                        </ul>
                   <!-- </div> -->
                </div>
            </div>
        </div>
      <!-- //for css -->
        <!-- /table row stars -->
        <div class="row" style="" id="tabledata" >
        <div class="col-sm-10 col-md-offset-1">
            <table class="table table-striped "  style="max-height: 10%;">
                <thead>
                    <tr>
                        <td>
                            Sr.no
                        </td>
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
                        <td>
                        description
                        </td>
                    </tr>
                    <tbody>
                
                        
                       @foreach ($amazon as $user)

                    
                        
                        <tr>
                            <td>{{$i+=1}} </td>

                            <td>
                               <img src="{{ $user->image}}"> 
                            </td>
                            <td style=" word-wrap: break-word;">
                            {{$user->name}}
                            </td>
                            <td>
                                {{$user->price}}
                            </td>
                            <td>
                              {{$user['seller']}}
                            </td>
                            <td>
                              {{$user['des']}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                       
                    </tbody>
                    
                </thead>
            </table>
        </div>
    </div>
    
    @if($css!="stop")
        @include('jsFilesHref')
    @endif