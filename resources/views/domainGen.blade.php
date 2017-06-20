@include("header")

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Left side column. contains the logo and sidebar -->
    
   
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container">
    @if($css!='stop')
        <div class="row">
            <div class="col-sm-8">
                <div class="">
                    <div class="clearfix"></div>
                    <br>
                    <div class="">
                        <form action="<?php  echo url('/searchDomain');?>" method="get">
                            <input type="text" name="domain" class="form-control" placeholder="Search for...">
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
         @if(!empty($data))
        <div class="row" id="action">
            <div class="col-sm-8">
                <div class=>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Save as
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php  echo url('/pdfD?'.$_SERVER['QUERY_STRING']);?>">PDF</a></li>
                          <li><a href="<?php  echo url('/csvD?'.$_SERVER['QUERY_STRING']);?>">CSV</a></li>
                          <li><a href="<?php  echo url('/SaveD?'.$_SERVER['QUERY_STRING']);?>">Save</a></li>
                        </ul>
                   </div>
                </div>
            </div>
        </div>
        @endif
         @endif
         <br><br>
         @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <br>
         <div class="overlay" style="font-size: 162px;text-align: center;">
              <i class="fa fa-refresh fa-spin"></i>
        </div>
         

         @if(!empty($data))
         <div class="row" id="tabledata" >
         	<div class="col-sm-8">
         	<table class="table table-striped table-bordered">
            <tr>
                <td>Domain</td>
                <td>Status</td>
                <td>Info</td>
            </tr>
	         	<tr>
	         		<td><h3><?php echo $_REQUEST['domain'];?></h3></td>
	         		<td>
	         			@if($data->raw_data!='')
	         				<h3 style="color: green;">Available</h3>
	         			@else
	         				<h3 style="color: red;">Not Available</h3>
	         			@endif
	         		</td>
	         		<td>
	         		{{substr($data->raw_data, 0, 100)}}
	         		</td>
	         		</tr>
         	</table>
         	</div>
         	
         </div>
         </div>
         @endif
         @include("jsFilesHref")