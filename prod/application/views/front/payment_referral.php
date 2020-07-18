<?php $this->load->view('front/include/left_side_menu_designer');?>
<?php echo $this->session->flashdata('referral_request');?>
<div class="col-md-9 col-sm-9">
   <div class="right-border">
  
       
          <div class="row" style="border-bottom:1px solid rgba(0,0,0,0.1);">
            <div  style="
    margin: 20px auto 0px;
    border-radius: 10px;
    font-family: 'twncemd';
    font-size: 16px;">
               <h3 style="padding: 10px;
    font-family: 'twncemd';
    font-size: 16px;
    background-color: rgba(0,0,0,0.1);
    margin-top: 0px;
    border-radius: 10px 10px 0px 0px;">My Paypal Account</h3>

               <div class="col-sm-4 col-md-4">
                  <div class="p_a_n">
                     <p>This is your paypal account that you like to receive your payment from us.</p>
                  </div>
                  <div class="p_a_m">
                     <?php echo paypal_referral_id(user_id());?>&nbsp; 
					 <!--<a href="<?php echo base_url()?>admin/myprofile_designer">[Edit]</a>-->
                  </div>
               </div>
               <div class="col-sm-4 col-md-4">
                  <div class="account_password">
                     <input type="password" name="acc_pass" id="acc_pass" class="acc_pass" placeholder="Enter your Account Password here" />
					 <div class="acc_pass_helper helper text-danger hidden">Please Enter Your Password</div>
                  </div>
               </div>
               <div class="col-sm-4 col-md-4">
                  <div class="r_p_o">
                     <a href="#" class="btn request_pay request_hide" style="background-color: #713365">Request Payout</a>
					 <a href="#" class="req_popup" style="display:none" data-modal-id="popup1">&nbsp;</a>
                     <br><br>					 
					 <div style="padding:10px;" ><span>Current Balance</span>: <a href="#" class="check_amount" style="background-color: #713365"><?php echo "$ ".referral_balance(user_id()); ?></a></div>
                     
                  </div>
               </div>
            </div></div>
          
          <div class="row" style="    padding-top: 10px; ">
			
			<div id="popup1" class="modal-box">
				<form action="<?php echo base_url()?>contest/release_payment_referral_option" method="post">
               <header>
                  <a href="#" class="js-modal-close close">×</a>
                  <h3>Request Payout</h3>
               </header>
               <div class="modal-body">
                  <p>Do you want to make payment request?</p>
				  <input type="password" name="user_pass" style="display:none;" class="user_pass">
               </div>
               <footer>
                  <button type="submit"  class="btn btn-small nopadding" style="background-color: #713365">Add</button>&nbsp;&nbsp;<a href="#" class="btn btn-small js-modal-close" style="background-color: #713365" >Close</a>
               </footer>
			   </form>
            </div>

            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
            <script>
               $(function(){
               
               var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
               
               $('a[data-modal-id]').click(function(e){
               	e.preventDefault();
                   $("body").append(appendthis);
                   $(".modal-overlay").fadeTo(500, 0.7);
                   //$(".js-modalbox").fadeIn(500);
               	var modalBox = $(this).attr('data-modal-id');
               	$('#'+modalBox).fadeIn($(this).data());
               });  
                 
                 
               $(".js-modal-close, .modal-overlay").click(function(){
                   $(".modal-box, .modal-overlay").fadeOut(500, function() {
                       $(".modal-overlay").remove();
                   });
               });
                
               $(window).resize(function() {
                   $(".modal-box").css({
                       top: ($(window).height() - $(".modal-box").outerHeight()) / 6,
                       left: ($(window).width() - $(".modal-box").outerWidth()) / 6
                   });
               });
                
               $(window).resize();
                
               });
            </script> 
            <div style="padding-top:20px;padding: 1px;
    font-family: 'twncemd';
    
    border: 1px solid rgba(0,0,0,0.1); border-radius: 10px;">
               <table class="table table-hover" id="bootstrap-table" >
                  <thead>
                     <tr>
                        <th>Sno</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        $sno=1;
                        if($request!=""){
                         // var_dump($request);exit;
                        foreach($request as $req) { 
							/* $status= $cd->req_status==1?"complete":"processing";
							$designer_id=$cd->designer_id;
							$amount=$this->Common_model->get_records('designer_debit','*',array('designer_id'=>$cd->designer_id,'request_date'=>$cd->request_date));
                        
							$amt=0; 
							foreach($amount as $winprize) {  
								$amt +=$winprize->request_amount;
								$req_date=$winprize->request_date;
							} */
					?>
                     <tr>
                        <td> <?php echo $sno++; ?> </td>
                        <td> <?php echo date("d/M/Y h:i a",strtotime($req->trans_date));?> </td>
                        <td><?php echo $req->trans_msg; ?></td>
                      <!--   <td> <?php //echo (($req->trans_value>0)?"+":'').$req->trans_value;?> </td> --> 
                        <td> <?php echo $req->trans_amount;?> </td>
                     </tr>
                     <?php	
						}
					 }
                        else{?>
                     <td> no records</td>
                     <?php	}?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="apopup" class="modal-box">
   <header>
      <a class="js-modal-close close" style="top: 1% !important;">×</a>
      <h3>Balance Information</h3>
      <br>
      <div>
         <p class="req_amount"></p>
         <div class="popup">
         </div>
      </div>
   </header>
   <a class="btn btn-small js-modal-close close2">Close</a>
</div>
</div>
</div>
</div>

<div class="container">
   <div class="col-md-3"></div>
   <div class="col-md-3"></div>
   <div class="col-md-3"></div>
</div>

<div class="gap"></div>
<script>
$(document).ready(function(){

	var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

   	$('a[data-modal-id]').click(function(e){
		e.preventDefault();
		$("body").append(appendthis);
		$(".modal-overlay").fadeTo(500, 0.7);
		//$(".js-modalbox").fadeIn(500);
   		var modalBox = $(this).attr('data-modal-id');
   		$('#'+modalBox).fadeIn($(this).data());
   	});  
          
   $(".js-modal-close, .modal-overlay").click(function(){
       $(".modal-box, .modal-overlay").fadeOut(500, function() {
           $(".modal-overlay").remove();
       });
   });

});   
</script>

<script>
$(document).ready(function(){
	
	$(document).on('click','.request_pay',function(){
		var user_pass= $('.acc_pass').val();
		$('.acc_pass_helper').addClass('hidden');
		if(user_pass!=''){
			$('.user_pass').val(user_pass);
			$('.req_popup').trigger("click"); 
		}
		else{
			$('.acc_pass_helper').removeClass('hidden');
		}
	});
	
	$(document).on('click','.view',function(){
   		var ref_id = $(this).attr('ref_id');
   		var req_date = $(this).attr('req_date');
   		var amount = $(this).attr('amount');
   		$.ajax({
                       type: 'post',
                       url: "<?php echo base_url();?>contest/referral_page_payment_details",
                       data: {
                           ref_id:ref_id ,
                           request_date:req_date 
                       },
                       success: function(response) {
   						$(".req_amount").html("Request Amount :"+amount);
                        $(".popup").html(response);
                       }
                   });
   			
   		
   	});

  var check_amount = <?php echo referral_balance(user_id()); ?>;
  if(check_amount !="" && check_amount > 9){
    $(".request_hide").show();
  } else {
   $(".request_hide").hide();
  }
});
</script>
<style>
.close2{
   position:absolute;
   top:150px;
   right:15px;
}
</style>