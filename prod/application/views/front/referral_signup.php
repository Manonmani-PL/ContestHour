 <main id="main" class="non-intro">
<section id="contests-designs">
      <div class="container" >
<div class="col-lg-12 section-header">
				 SIGN UP AS REFERRAL
			</div><br>
	<div class="row">

		 <div class="col-md-6 offset-3">

		 <div class="referral-signup-page">
		<!--  <p>Contesthours is a newly launched website looking for talented designers who have the passion for designing and we connect you with entpreneurs. We welcome you to join our team.</p> -->
           <form action="#" method="post" name="referral_register_form" id="referral_register_form">
              <div class="form-group">
				<label >User Name</label>
				<input type="text" class="form-control" name="referral_name" id="referral_name" value="<?php echo set_value('referral_name'); ?>"/>
				<span class="text-danger"><?php echo form_error('referral_name'); ?></span>
			  </div>

			  <div class="form-group">
				<label >Email</label>
				 <input type="email" class="form-control" name="referral_email" id="referral_email" value="<?php echo set_value('referral_email'); ?>"/><span class="text-danger"><?php echo form_error('referral_email'); ?></span>
			  </div> 

			  <div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="referral_password" id="referral_password"  />
				<span class="text-danger"><?php echo form_error('referral_password'); ?></span>
				</div>

			  <div class="form-group">
				<label >Confirm Password</label>
				<input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" />
                <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
			  </div>

			  <div class="form-group">
				<label>Select Industry</label>
				 <select  class="form-control referral-country" name="referral_country" id="referral_country"  style="height: 40px; width: 291px;">
					<option value=""> ---Select Country--- </option>
                	<?php foreach ($country as $con) { ?>
                    	<option value="<?php echo $con->country_code; ?>" 
                    	<?php echo (set_value('referral_country')==$con->country_code)?"selected":""; ?>>
                    	<?php echo $con->country_name; ?></option>
                    <?php } ?>
                </select>
						  <span class="text-danger"><?php echo form_error('referral_country'); ?></span>
				</div>

			  <div class="form-group">
				<label>Contact Number</label>
					<input type="text" class="form-control" name="referral_moblie" id="referral_moblie" value="<?php echo set_value('referral_moblie'); ?>" />
                        <span class="text-danger"><?php echo form_error('referral_moblie'); ?></span>
                     
			  </div> 

			  <div class="form-group other_tag">
				<label>Paypal Account</label>
					<input type="email" class="form-control other_tag" name="paypal_email" id="paypal_email" placeholder="Enter Paypal EmailId" value="<?php echo set_value('paypal_email'); ?>"/>
					<span class="text-danger"><?php echo form_error('paypal_email'); ?></span>
                    
			  </div> 

			  <div class="form-group ind_tag">
				<label>For Indian Referral</label>
			  </div> 

			  <div class="form-group ind_tag">
				<h3>Account Number:</h3>
				<input type="text" class="form-control ind_tag" name="account_number" id="account_number"  value="<?php echo set_value('account_number'); ?>"/>
					<span class="text-danger"><?php echo form_error('account_number'); ?></span>
			  </div> 

			  <div class="form-group ind_tag">
				<label>Bank Name</label>
					<input type="text" class="form-control ind_tag" name="bank_name" id="bank_name" value="<?php echo set_value('bank_name'); ?>"/>
					<span class="text-danger"><?php echo form_error('bank_name'); ?></span>
                    
			  </div> 

			   <div class="form-group ind_tag">
				<label>Bank Branch</label>
					<input type="text" class="form-control ind_tag" name="bank_branch" id="bank_branch" value="<?php echo set_value('bank_branch'); ?>"/>
					<span class="text-danger"><?php echo form_error('bank_branch'); ?></span>
                    
			  </div> 

			  <div class="form-group ind_tag">
				<label>IFSC Code</label>
					<input type="text" class="form-control ind_tag" name="ifsc_code" id="ifsc_code"  <?php echo set_value('ifsc_code'); ?>/>
					<span class="text-danger"><?php echo form_error('ifsc_code'); ?></span>
                    
			  </div>

			   <div class="form-group ind_tag">
				<label>Account Holder Name</label>
					<input type="text" class="form-control ind_tag" name="account_holder" id="account_holder"  value="<?php echo set_value('account_holder'); ?>"/>
					<span class="text-danger"><?php echo form_error('account_holder'); ?></span>
                    
			  </div> 

			  <div class="form-group">
			  <input type="submit" class="form-control launch-btn" style="background: #fbb03b;" value="CREATE MY ACCOUNT" name="referral_submit" class="submit" /></td>
			  </div>


               </form>
               </div>


		</div>

	</div>
</div>     
 </session>
 </main>

 <script>
    $(document).ready(function(){
        var select="<?php echo set_value('referral_country')?>";
        if(select!="IN"){
            $('.ind_tag').hide();            
        }
        else{ 
        }
        $(document).on('change','.referral-country',function(){
            var country=$(this).val();
            if(country=="IN"){
                $('.ind_tag').show();
                $('.other_tag').show();
            }
            else{
                $('.ind_tag').hide();
                $('.other_tag').show();
            }
        });
    });
</script>