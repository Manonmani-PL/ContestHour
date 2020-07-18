<br><br><br>
<div class="gap">
</div>
<section>
   <div class="container" style="background-color:#f4f2ed;">
      <div class="users-login">Sign up as client</div>
   </div>
</section>
<!---form---->
<div class="container" style="border:1px solid rgba(0,0,0,0.1)">
   <div class="row">

      <div class="col-md-5 col-lg-5">
         <div class="client-signup">
            <form action="<?php echo base_url(); ?>Admin/clientSignup" method="post" name="client_register_form" id="client_register_form">
               <table width="100%" cellpadding="5" border="0" cellspacing="5">
                  <tr>
                     <td><label>User Name </label></td>
                  </tr>
                  <tr>
                     <td><input type="text" name="client_name" id="client_name" value="<?php echo set_value('client_name'); ?>" />
                      <span class="text-danger"><?php echo form_error('client_name'); ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td><label>Email</label></td>
                  </tr>
                  <tr>
                     <td><input type="email" name="client_email" id="client_email" value="<?php echo set_value('client_email'); ?>" />
                        <span class="text-danger"><?php echo form_error('client_email'); ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td><label>Password</label></td>
                  </tr>
                  <tr>
                     <td><input type="password" name="client_password" id="client_password" value="<?php echo set_value('client_password'); ?>" />
                        <span class="text-danger"><?php echo form_error('client_password'); ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td><label>Confirm Password</label></td>
                  </tr>
                  <tr>
                     <td><input type="password" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" />
                        <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td><label>Country</label></td>
                  </tr>
                  <tr>
                     <td>
                        <select size="1" class="client_country" name="client_country" id="client_country" value="<?php echo set_value('client_country'); ?>">
					<option value="" <?php echo set_select('client_country','Select')?>> ---Select Country--- </option>
					<?php foreach ($country as $con) { ?>
                    	<option value="<?php echo $con->country_code; ?>"><?php echo $con->country_name; ?></option>
                    <?php } ?>
                </select>
                        <span class="text-danger"><?php echo form_error('client_country'); ?></span>
                     </td>
                  </tr>	

                  <tr>
                     <td><label>Contact Number</label></td>
                  </tr>				  
                  <tr>
                     <td>
						<input type="text" name="client_mobile" id="client_mobile" value="<?php echo set_value('client_mobile'); ?>" />
                        <span class="text-danger"><?php echo form_error('client_mobile'); ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td>
						<input type="submit" value="Create My Account" name="c_submit" class="submit" /></td>
                  </tr>
               </table>
            </form>
         </div>
      </div>
      <div class="col-md-7 col-lg-7">
         <!--<div class="client-img"><img src="images/client-img.png" /></div>-->
      </div>
   </div>
</div>

<!--close-form--->

<div class="gap"></div>