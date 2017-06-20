@include('header')
<?php 
if(!isset($_REQUEST['domain']))
{
    $_REQUEST['domain'] = '';
}?>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Save as
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php  echo url('/pdfD?keyword='.$_REQUEST['domain']);?>">PDF</a></li>
                          <li><a href="<?php  echo url('/csvD?keyword='.$_REQUEST['domain']);?>">CSV</a></li>
                        </ul>
                   </div>
                </div>
            </div>
        </div>
        @endif
         @endif
         <br>
         @if(!empty($data))
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
         @endif