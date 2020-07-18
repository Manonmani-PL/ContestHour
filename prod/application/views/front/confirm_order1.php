 <main id="main" class="non-intro">
<section id="contests-designs">
<div class="container" >
<div class="col-lg-12 section-header">
				CONFIRM PROJECT DETAILS
			</div><br>

			<div class="row">

		 <div class="col-md-6 offset-4">
		  <div class="client-signup">
		  <form action="<?php echo base_url();?>contest/insert_confirm" name="confirm_order" id="confirm_order" method="post">
			<input type="hidden" name="contest_id" value="<?php echo $contest_id; ?>" />
		  		
		  		<div class="form-group">
				<label><b>Project Name : </b><?php
						if($contest_details->contest_type == 'logodesign' || $contest_details->contest_type == 'webdesign' || $contest_details->contest_type == 'movielogodesign'){
							echo ucwords($contest_details->org_name);
						}
						else{
							echo ucwords($contest_details->contest_title);
						} 
						//echo " Logo design";
					?></label>
				
			  </div>
			  <div class="form-group">
			  <label><b>Project Type   :  </b></label><?php 
			   $contest_category1 = get_category_type($contest_details->id);
                                if(is_numeric($contest_details->contest_type)){
                                foreach ($contest_category1 as $con_category){
                                echo  " ".$con_category; }
                            } else {
                                 echo  " ".ucfirst($contest_details->contest_type);
                            }
			  //echo  ucfirst($contest_details->contest_type); 
			  ?>
			  </div> 
			  <div class="form-group">
			  <label><b>Project Duration :</b></label> <?php if(isset($contest_details->duration_hours) && !empty($contest_details->duration_hours)){ echo $contest_details->duration_hours; } else { echo $val = hours_cal($contest_details->duration); } ?> Hours
			  </div> 
			  <div class="form-group">
			  <label><b>Close Date  :</b></label> <?php echo date('d-M-Y',strtotime($contest_details->close_date));  ?> 
			  </div> 
			  
			  <div class="form-group">
			  <label><b>Project Cost  :</b></label> $ <?php echo number_format($contest_details->total_amount,2);  
			  if(getCountry() == 'IN'){
				echo str_repeat("&nbsp;", 5) ."<b>"."  (Rs.".number_format(convertCurrency($contest_details->total_amount),2).")"."</b>";
			  }
			  ?>
			  
			  </div>

		 
		 </div>
		 </div>
		 </div>
<?php

	
$message = "New Contest(".contestname($contest_details->id).") Added By ".username(user_id())." at ".date("d M,Y h:i a");
$message .= "Contest Price: $".$contest_details->total_amount."<br>";
$message .= "Payment Type: Full Payment<br>";
$message .= "<p><a href='".base_url()."contest/contest_brief/".$contest_details->id."'>Click here to view Contest</a></p>";


$values['contest_id'] = $contest_details->id;
$values['payable_amt'] = $contest_details->total_amount;
$values['order_notes'] = $message;
$transactionId = $values['txnid'] = substr(generate_orderid(),0,15);
$this->Common_model->insert_record('contest_payment',$values);	
	
	
date_default_timezone_set('Asia/Calcutta');
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);


$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setMode("test");
$transactionRequest->setLogin(197);
$transactionRequest->setPassword("Test@123");
$transactionRequest->setProductId("NSE");
$transactionRequest->setAmount(convertCurrency($contest_details->total_amount));
if(getCountry() == 'IN'){
	$transactionRequest->setTransactionCurrency("INR");
	$transactionRequest->setTransactionAmount(convertCurrency($contest_details->total_amount));
}else{
	$transactionRequest->setTransactionCurrency("USD");
	$transactionRequest->setTransactionAmount($contest_details->total_amount);
}

$transactionRequest->setReturnUrl(base_url()."contest/payment_result/");
$transactionRequest->setClientCode(123);
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName(username(user_id()));
$transactionRequest->setCustomerEmailId(get_email(user_id()));
$transactionRequest->setCustomerAccount("639827");
$transactionRequest->setReqHashKey("KEY123657234");


$atomurl = $transactionRequest->getPGUrl();


?>
		  <div class="col-lg-12 section-header">
				PAYMENT OPTIONS
			</div><br>
			<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-6">
			<input type="radio" name="pay_option" value="fpay" checked="checked"> 
			<label><b>Full Payment</b>
			</label>
			<p>Guaranteed contests attract more and higher TOP designers.</p>
			</div>
<!-- 
			<div class="col-md-4">
			<input type="radio" name="pay_option" value="ppay">
			<span><b>Partial Pyment</b></span>
			<p>Start A Contest by paying the contest prize  PARTIALLY and letting designers know that you will definitely purchase a design.</p>
			</div>
			<div class="col-md-2">
			</div> -->

			<div class="row" style="display:none;">
        <div class="col-sm-offset-3 col-sm-6">
        	<div class="confirm_order">
                <div class="payment_method">
                	<h2>Payment Method</h2>
                    <b>Choose a Payment Option and Click Next to Continue</b>
                </div>
           </div>
        <div class="col-sm-3"></div>
    </div>
	
	<div class="row" style="margin-top:15px; display:none;">
		<div class="col-sm-offset-3 col-sm-6">
			<div class="pay-box text-center">
				<input type="radio" name="gateway_option" value="paypal" checked>
			</div>
		</div>
		<!--
		<div class="col-sm-3">
				<input type="radio" name="gateway_option" value="ccpay">
				<img src="<?php echo base_url();?>assets/image/cclogo.png" >
		</div>
		-->
	</div>
	
</div>
			</div> <hr>

			<div class="submit_paynow">
        <!--<input type="submit" value="Submit & paynow" name="paynow" />-->
		 <button type="submit" name="paynow" class="btn-paypal"><img src="<?php echo base_url();?>assets/image/paypal.png"></button>
		<?php if(isset($atomurl)){ ?>
			<a href="<?php echo $atomurl;?>" class="btn btn-primary">Atom Pay</a>
		<?php } ?>
		
    </div>
		 	



</form>   
</div>
</section>
</main>