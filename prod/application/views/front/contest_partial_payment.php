<div class="gap-low"></div>
<div class="minheight">
<form action="<?php echo base_url(); ?>contest/save_partialPayment" method="post">
<input type="hidden" name="contest_id" value="<?php echo $contest_id; ?>" />
<section>
	<div class="col-md-12 col-lg-12">
    	<div class="col-sm-4">
        	<div class="line"></div>
        </div>
        <div class="col-sm-4">
        	<div class="creative_breif-header">
            	<b>Balance Payment</b>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="line"></div>
        </div>
    </div>
</section>
<section>
<div class="container">
	<div class="row">
    	<div class="col-sm-3"></div>
        <div class="col-sm-6">
        	<div class="confirm_order">
            	<table width="70%" cellpadding="5" cellspacing="10">
                <tr>
                <td width="50%"><div align="left"><b>Project Name</b></div></td>
                <td width="50%"><div align="left">
                	<?php
						if($contest_details->contest_type == 'logodesign' || $contest_details->contest_type == 'webdesign' || $contest_details->contest_type == 'movielogodesign'){
							echo ucwords($contest_details->org_name);
						}
						else{
							echo ucwords($contest_details->contest_title);
						}
						$balance_pay= $contest_details->total_amount - contest_listing_fee();
					?>
                </div></td>
                </tr>
                <tr>
                <td width="50%"><div align="left"><b>Project Type</b></div></td>
                <td width="50%"><div align="left"><?php echo ucfirst($contest_details->contest_type); ?></div></td>
                </tr>
                <tr>
					<td width="50%"><div align="left"><b>Project Cost</b></div></td>
					<td width="50%"><div align="left">$ <?php echo $contest_details->total_amount; ?></div></td>
                </tr>
				
                <tr>
					<td width="50%"><div align="left"><b>Already Paid</b></div></td>
					<td width="50%"><div align="left"> $ <?php echo round(contest_listing_fee(),2); ?></div></td>
                </tr>
                <tr>
					<td width="50%"><div align="left"><b>Balance </b></div></td>
					<td width="50%"><div align="left">$ <?php echo round($balance_pay,2); ?></div></td>
                </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</section>

<section>
<div class="container">
	<div class="row">
        <div class="col-sm-offset-3 col-sm-6">
        	<div class="confirm_order">
                <div class="payment_method">
                	<h2>Payment Method</h2>
                    <b>Choose a Payment Option and Click Next to Continue</b>
                </div>
            </div>
		   
        <div class="col-sm-3"></div>
		</div>
    </div>
	
	<div class="row" style="margin-top:15px; display:none;">
		<div class="col-sm-offset-3 col-sm-6">
			<div class="pay-box text-center">
				<input type="radio" name="gateway_option" value="paypal" checked>
			</div>
		</div>
	</div>
</div>
</section>
<hr/>
	<div class="submit_paynow">
		<button type="submit" name="paynow" class="btn-paypal">
			<img src="<?php echo base_url();?>assets/image/paypal.png" style="box-shadow: none;">
		</button>
    </div>
</form>   
</div>