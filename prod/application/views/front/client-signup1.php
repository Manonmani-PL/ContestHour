 <main id="main" class="non-intro">
<section id="contests-designs">
      <div class="container" >
<div class="col-lg-12 section-header">
				 SIGN UP AS CLIENT
			</div><br>
	<div class="row">

		 <div class="col-md-6 offset-3">

		 <div class="client-signup">
            <form action="<?php echo base_url(); ?>Admin/clientSignup" method="post" name="client_register_form" id="client_register_form">
              <div class="form-group">
				<label >User Name</label>
				<input type="text" class="form-control" name="client_name" id="client_name" value="<?php echo set_value('client_name'); ?>" />
				 <span class="text-danger"><?php echo form_error('client_name'); ?></span>
			  </div>

			  <div class="form-group">
				<label >Email</label>
				<input type="email" class="form-control" name="client_email" id="client_email" value="<?php echo set_value('client_email'); ?>" />
                        <span class="text-danger"><?php echo form_error('client_email'); ?></span>
			  </div> 

			  <div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="client_password" id="client_password" value="<?php echo set_value('client_password'); ?>" />
                        <span class="text-danger"><?php echo form_error('client_password'); ?></span>
              </div>

			  <div class="form-group">
				<label >Confirm Password</label>
				<input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" />
                        <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
			  </div>

			  <div class="form-group">
				<label for="pwd">Select Industry</label>
				<select name="client_country" id="client_country" class="form-control" value="<?php echo set_value('client_country'); ?>" style="height: 40px; width: 291px;">
					 <option value="" <?php echo set_select('client_country','Select')?>> ---Select Country--- </option>
					 <?php foreach ($country as $con) { ?>
                    	<option value="<?php echo $con->country_code; ?>"><?php echo $con->country_name; ?></option>
                    <?php } ?>
				</select>
						<span class="text-danger"><?php echo form_error('client_country'); ?></span>
				</div>	
				 
			  <div class="form-group">
				<label>Contact Number</label>
					<input type="text" class="form-control" name="client_mobile" id="client_mobile" value="<?php echo set_value('client_mobile'); ?>" />
                        <span class="text-danger"><?php echo form_error('client_mobile'); ?></span>
			  </div> 

			  <div class="form-group">
			  <input type="submit" class="form-control" style="background: #fbb03b; font-weight: 700;color:#fff;" value="CREATE MY ACCOUNT" name="c_submit" class="submit" /></td>
			  </div>


               </form>
               </div>


		</div>

	</div>
</div>     
 </session>
 </main>