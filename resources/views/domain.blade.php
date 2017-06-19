@include('header')
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

        <div class="row">
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
         @endif
         <br>
         <div class="row">
         	<div class="col-sm-12">
         	<table class="table table-striped">
	         	<tr>
	         		<td><h3><?php echo $_REQUEST['domain'];?></h3></td>
	         		<td>
	         			@if($data->raw_data!='')
	         				<h3 style="color: green;">Available</h3>
	         			@else
	         				<h3 style="color: red;">Not Available</h3>
	         			@endif
	         		</td>
	         		</tr>
	         		<tr>

	         		<td>
	         		{{$data->raw_data}}
	         		</td>
	         		</tr>
	         	
         		
         	</table>
         	</div>
         	
         </div>
         </div>