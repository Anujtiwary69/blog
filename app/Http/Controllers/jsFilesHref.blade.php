 <!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var counter = 0;
		 	interval = setInterval(function() {
	    		counter++;
	    		console.log(counter);
	    		  // $(".loader").text(Math.round((counter/60)*100));
			   		$.ajax({url: "<?Php echo url('/amazonData');?>", success: function(result){
		            // $("#div1").html(result);
			            if(result=='no')
			            {
			            	// alert();
			            }
			            else
			            {
			            	clearInterval(interval);
			            	$(".overlay").hide();
			            	$("#amazondata").html(result);
			            }
			        }
		           });
			}, 6000);


			var counter1 = 0;
		 	interval1 = setInterval(function() {
	    		counter1++;
	    		console.log(counter1);
	    		  // $(".loader").text(Math.round((counter/60)*100));
			   		$.ajax({url: "<?Php echo url('/ebayData');?>", success: function(result){
		            // $("#div1").html(result);
			            if(result=='no')
			            {
			            	// alert();
			            }
			            else
			            {
			            	clearInterval(interval1);
		            		$(".overlay").hide();
			            	$("#evaydata").html(result);
			            }
			          
			          }  
		            });
			        
			        
			        

			  
			}, 6000);
			//on click 
			// $("#searchButton").submit(function() {
			// 	 $("#tabledata").hide();
			//      $("#action").hide();
			//      $(".overlay").show();
			// });
			
	});
</script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
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