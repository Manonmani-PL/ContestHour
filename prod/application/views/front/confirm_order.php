<div class="gap-low"></div>

<div class="minheight">
<form action="<?php echo base_url();?>contest/insert_confirm" name="confirm_order" id="confirm_order" method="post">
<input type="hidden" name="contest_id" value="<?php echo $contest_id; ?>" />
<div class="container">
	<div class="row">
        <div class="col-md-3 col-lg-3">
        	<div class="choose_cat">
            	<div class="choose_cat_icon "><img src="<?php echo base_url();?>assets/image/last_choose_cat_icon1.png" width="71" height="72" />&nbsp;&nbsp;<span class="before_page" >Choose category</span></div>
            </div>
        </div>
         <div class="col-md-3 col-lg-3">
         	<div class="creative_brief">
            	<div class="creative_brief_icon"><img src="<?php echo base_url();?>assets/image/creative_brief_ico_before.png" width="71" height="72" />&nbsp;&nbsp;<span class="before_page">Creative brief</span></div>
            </div>
         </div>
          <div class="col-md-3 col-lg-3">
          	<div class="payment_option">
            	<div class="payment_icon"><img src="<?php echo base_url();?>assets/image/payment_icon_before.png" width="71" height="72" />&nbsp;&nbsp;<span class="before_page">Payment options</span></div>
            </div>
          </div>
           <div class="col-md-3 col-lg-3">
           
           <div class="conform_order">
            	<div class="conform_ordert_icon"><img src="<?php echo base_url();?>assets/image/conformorder_icon_active.png" width="71" height="72" />&nbsp;&nbsp;<span class="select">Confirm order</span></div>
            </div>
           
           </div>
        
    </div>
</div>

<section>
	<div class="col-md-12 col-lg-12">
    	<div class="col-sm-4">
        	<div class="line"></div>
        </div>
        <div class="col-sm-4">
        	<div class="creative_breif-header">
            	<b>Confirm Project Details</b>
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
            	<table width="70%" cellpadding="5" cellspacing="10" style="margin:auto;">
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
					?>
                </div></td>
                </tr>
                <tr>
                <td width="50%"><div align="left"><b>Project Type</b></div></td>
                <td width="50%"><div align="left"><?php echo ucfirst($contest_details->contest_type); ?></div></td>
                </tr>
                <tr>
                <td width="50%"><div align="left"><b>Project Duration</b></div></td>
                <td width="50%"><div align="left"><?php if(isset($contest_details->duration_hours) && !empty($contest_details->duration_hours)){ echo $contest_details->duration_hours; } else { echo $val = hours_cal($contest_details->duration); } ?> Hours</div></td>
                </tr>
                <tr>
                <td width="50%"><div align="left"><b>Close Date</b></div></td>
                <td width="50%"><div align="left"><?php echo date('d-M-Y',strtotime($contest_details->close_date)); ?></div></td>
                </tr>
                <tr>
                <td width="50%"><div align="left"><b>Project Cost</b></div></td>
                <td width="50%"><div align="left">$ <?php echo $contest_details->total_amount; ?></div></td>
                </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</section>
<section>
	<div class="col-md-12 col-lg-12">
    	<div class="col-sm-4">
        	<div class="line"></div>
        </div>
        <div class="col-sm-4">
        	<div class="creative_breif-header">
            	<b>Payment Option</b>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="line"></div>
        </div>
    </div>
</section>
<section>
<div class="container">
	
	<div class="row" style="margin-top:100px;">
		<div class="col-sm-offset-3 col-sm-3  text-center">
			<label class="pay-box">
				<input type="radio" name="pay_option" value="fpay" checked="checked"> 
				<span>Full Payment</span>
				<p>Guaranteed contests attract more and higher TOP designers.</p>
			</label>
		</div>
		<div class="col-sm-3 text-center">
			<label class="pay-box">
				<input type="radio" name="pay_option" value="ppay">
				<span>Partial Payment</span>
				<p>Start A Contest by paying the contest prize  PARTIALLY and letting designers know that you will definitely purchase a design.</p>
			</label>
		</div>
	</div>
	
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
</section>
<hr/>

    <div class="submit_paynow">
        <!--<input type="submit" value="Submit & paynow" name="paynow" />-->
		<button type="submit" name="paynow" class="btn-paypal"><img src="<?php echo base_url();?>assets/image/paypal.png"></button>
		
    </div>
</form>   
</div>