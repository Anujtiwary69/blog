
<div class="container">

         <div class="row" id="tabledata">
         	<div class="col-sm-8 col-md-offset-2">
         	<table class="table table-striped table-bordered">
            <tr class="info">
                <td>Domain</td>
                <td>Status</td>
                @foreach($data as $domainInfo)
                <tr>
                    <td id="domaintrext">{{$domainInfo->Domain}}</td>
                    <td>
                        
                           <b>Available</b>
                    </td>
    
	         	     <tr>


                @endforeach
	         		
	         	</tr>
         	</table>
         	</div>
         	
         </div>
         </div>
       

         