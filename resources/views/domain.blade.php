@include("header")

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('nav')
  <!-- Left side column. contains the logo and sidebar -->
    @include('sidebar')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container">
    @if($css!='stop')
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
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
        <div class="row" id="action" >
            <div class="col-sm-8 col-md-offset-2">
                <div class=>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Save as
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php  echo url('/pdfD?'.$_SERVER['QUERY_STRING']);?>">PDF</a></li>
                          <li><a href="<?php  echo url('/csvD?'.$_SERVER['QUERY_STRING']);?>">CSV</a></li>
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

         

         @if(!empty($data))
         <div class="row" id="tabledata">
         	<div class="col-sm-8 col-md-offset-2">
         	<table class="table table-striped table-bordered">
            <tr class="info">
                <td><b>Domain</b></td>
                <td><b>Status</b></td>
                <td><b>Info</b></td>
                @foreach($data as $domainInfo)
                </tr>
                    <td id="domaintrext">{{$domainInfo->Domain}}</td>
                    <td>
                        
                           <i class="fa fa-check" aria-hidden="true" style="color: green;"></i> <b style="color: green;">Available</b>
                    </td>
                    <td>
                        <i class="fa fa-eye" aria-hidden="true" style="color: blue;"></i> &nbsp; <a href="#" title="{{$domainInfo->Domain}}" class="view"><b style="color: blue;" >View</b></a>
                    </td>
	         	<tr>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" class="domainText11">Info</h4>
                        </div>
                        <div class="modal-body">
                          <p class="domainInfo">Loading...</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
  
</div>

                @endforeach
	         		
	         	</tr>
         	</table>
         	</div>
         	
         </div>
         </div>
         @endif

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        $(".view").click(function(e){
           domain = $(this).attr('title');
           $(".domainText11").val(domain);
            $(".domainInfo").html('Loading...');
           url = "<?php echo url('/apiWho?domain=');?>";
             $.ajax({url: url+domain, success: function(result){
                $(".domainInfo").html(result);
            }});

             $("#myModal").modal('show');
         });
       
      });
  </script>