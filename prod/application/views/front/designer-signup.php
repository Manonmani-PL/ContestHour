<br><br><br>
<div class="gap"></div>

<section>
<div class="container" style="background-color:#f4f2ed;">
<div class="users-login" >Sign up as designer</div>
</div>
</section>
<!---form---->

<div class="container" style="border:1px solid rgba(0,0,0,0.1)" >
	<div class="row" >
    	
        <div class="col-md-5 col-lg-5">
        	<div class="designer-signup-page">
            <p>Contesthours is a newly launched website looking for talented designers who have the passion for designing and we connect you with entrepreneurs. We welcome you to join our team.</p>
            	<form action="#" method="post" name="designer_register_form" id="designer_register_form">
                <table width="100%" cellpadding="5" border="0" cellspacing="5">
                <tr>
                <td><label>User Name </label></td>
                </tr>
                <tr>
                <td><input type="text" name="designer_name" id="designer_name" value="<?php echo set_value('designer_name'); ?>"/>
				<span class="text-danger"><?php echo form_error('designer_name'); ?></span>
				</td>
                </tr>
                <tr>
                <td><label>Email</label></td>
                </tr>
                <tr>
                <td><input type="email" name="designer_email" id="designer_email" value="<?php echo set_value('designer_email'); ?>"/><span class="text-danger"><?php echo form_error('designer_email'); ?></span>
				</td>
                </tr>
                <tr>
                <td><label>Password</label></td>
                </tr>
                <tr>
                <td><input type="password" name="designer_password" id="designer_password"  />
				<span class="text-danger"><?php echo form_error('designer_password'); ?></span>
				</td>
                </tr>
                <tr>
                <td><label>Confirm Password</label></td>
                </tr>
                <tr>
                <td><input type="password" name="confirm_password" id="confirm_password"  />
				<span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
				</td>
                </tr>
                <tr>
                <td><label>Country</label></td>
                </tr>
                <tr>
                <td>
                <select size="1" class="designer-country" name="designer_country" id="designer_country">
					<option value="" > ---Select Country--- </option>
                	<?php foreach ($country as $con) { ?>
                    	<option value="<?php echo $con->country_code; ?>" 
                    	<?php echo (set_value('designer_country')==$con->country_code)?"selected":""; ?>>
                    	<?php echo $con->country_name; ?></option>
                    <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('designer_country'); ?></span>
                </td>
                </tr>
				<tr>
                     <td><label>Contact Number</label></td>
                  </tr>				  
                  <tr>
                     <td><input type="text" name="designer_moblie" id="designer_moblie" value="<?php echo set_value('designer_moblie'); ?>" />
                        <span class="text-danger"><?php echo form_error('designer_moblie'); ?></span>
                     </td>
                  </tr>
                <tr class="other_tag">
					<td><label>Paypal Account</label></td>
                </tr>
                <tr class="other_tag">
					<td><input type="email" name="paypal_email" id="paypal_email" placeholder="Enter Paypal EmailId" value="<?php echo set_value('paypal_email'); ?>"/>
					<span class="text-danger"><?php echo form_error('paypal_email'); ?></span>
					</td>
                </tr>
				<tr class="ind_tag">
					<td><h3>For Indian Designers</h3></td>
				</tr>
				
				<tr class="ind_tag">
					<td><label>Account Number:</label></td>
                </tr>
                <tr class="ind_tag">
					<td><input type="text" name="account_number" id="account_number"  value="<?php echo set_value('account_number'); ?>"/>
					<span class="text-danger"><?php echo form_error('account_number'); ?></span>
					</td>
                </tr>
				<tr class="ind_tag">
					<td><label>Bank Name</label></td>
                </tr>
                <tr class="ind_tag">
					<td><input type="text" name="bank_name" id="bank_name" value="<?php echo set_value('bank_name'); ?>"/>
					<span class="text-danger"><?php echo form_error('bank_name'); ?></span>
					</td>
                </tr>
				
				<tr class="ind_tag">
					<td><label>Bank Branch</label></td>
                </tr>
                <tr class="ind_tag">
					<td><input type="text" name="bank_branch" id="bank_branch" value="<?php echo set_value('bank_branch'); ?>" />
					<span class="text-danger"><?php echo form_error('bank_branch'); ?></span>
					</td>
                </tr>
				
				<tr class="ind_tag">
					<td><label>IFSC Code</label></td>
                </tr>
                <tr class="ind_tag">
					<td><input type="text" name="ifsc_code" id="ifsc_code"  <?php echo set_value('ifsc_code'); ?>/>
					<span class="text-danger"><?php echo form_error('ifsc_code'); ?></span>
					</td>
                </tr>
				
				<tr class="ind_tag">
					<td><label>Account Holder Name</label></td>
                </tr>
                <tr class="ind_tag">
					<td><input type="text" name="account_holder" id="account_holder"  value="<?php echo set_value('account_holder'); ?>"/>
					<span class="text-danger"><?php echo form_error('account_holder'); ?></span>
					</td>
                </tr>
                <tr>
                <td><input type="submit" value="Create My Account" name="designer_submit" /></td>
                </tr>
                
                
                </table>
                </form>
            </div>
        </div>
        <div class="col-md-7 col-lg-7">
        	<!--<div class="designer-img"><img src="images/designer-img.png" /></div>-->
        </div>
    </div>
</div>

<!--close-form--->

<div class="gap"></div>

<script>
    $(document).ready(function(){
        var select="<?php echo set_value('designer_country')?>";
        if(select!="IN"){
            $('.ind_tag').hide();            
        }
        else{ 
        }
        $(document).on('change','.designer-country',function(){
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
