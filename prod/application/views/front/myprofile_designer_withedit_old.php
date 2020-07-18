<?php $this->load->view('front/include/left_side_menu_designer'); ?>
  <div class="col-sm-9">
  <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
    			<?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
  <form action="<?php echo base_url();?>admin/edit_designer_info/<?php echo $user_details[0]->id?>"  method="post" enctype="multipart/form-data" >
    <div class="right-border">
    	<div class="col-sm-8 col-xs-12">
        	<div class="myprofile-form">
                <?php


				$uid=$user_details[0]->user_id;
				$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
				$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
		 $Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
				$warning_count=$this->Common_model->get_records_count('contest_warning',array('designer_id'=>$uid));
									
					

				#echo '<pre>'; print_r($user_details); exit;?>
                	<table width="100%" cellpadding="5" cellspacing="25">
                    <tr>
                    <td width="10%"><div align="left"><label>Name</label></div></td>
                    <td width="70%"><div align="left"><input readonly type="text" name="myprofile_name" id="myprofile_name" class="myprofile_name" value="<?php echo $user_details[0]->designer_name; ?>" /></div></td>
                    </tr>
                    <tr>
                    <td width="10%"><div align="left"><label>Email</label></div></td>
                    <td width="70%"><div align="left"><input readonly type="text" name="profile_email" id="profile_email" class="profile_email" value="<?php echo $user_details[0]->designer_email; ?>"/></div></td>
                    </tr>
                    <tr>
                    <td width="10%"><div align="left"><label>Country</label></div></td>
                    <td width="70%"><div align="left">
                    	  <select name="countries_id" readonly class="form-control" id="select-country">
								<?php foreach ($country as $con) { ?>
                                <option value="<?php echo $con->country_code; ?>"<?php if($con->country_code==$user_details[0]->designer_country){ echo 'Selected="selected"';} ?>><?php echo $con->country_name; ?></option>
                                <?php } ?>
			             </select>

                    </div></td>
                    </tr>					
                    <tr>
                    <td width="10%"><div align="left"><label>Paypal Email</label></div></td>
                    <td width="70%"><div align="left"><input type="text" name="paypal_email" id="paypal_email" class="paypal_email" value="<?php echo $user_details[0]->paypal_email; ?>"/></div></td>
                    </tr>
                    <tr>
                    <td width="10%"><div align="left"><label>Intro</label></div></td>
                    <td width="70%"><div align="left">
                    <textarea rows="10" cols="20" class="myself" id="myself" name="myself"><?php echo $user_details[0]->designer_intro; ?></textarea>
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td width="10%"></td>
                    <td width="70%"><div align="left"><input type="submit" value="Update" class="submit" /></div></td>
                    </tr>
                    </table>
                
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
        	<div class="profilephoto-space"><img src="<?php if(!empty($user_details[0]->designer_profile)){ echo base_url();?>uploads/designer_profile/<?php echo $user_details[0]->designer_profile;} else { echo base_url();?>assets/image/dummy-images.png<?php }?>" width="150px" height="150px" /></div>
            <table width="100%" cellpadding="5">
            
            <tr>
            <td><input type="file" name="profile_photo" id="profile_photo" value="<?php echo $user_details[0]->designer_profile; ?>" />
            <input type="hidden" name="old_file_name" id="old_file_name" value="<?php echo $user_details[0]->designer_profile;?>" /></td>
            </tr>
            </table>
        </div>
    </div>
    </form>
    <div class="col-sm-3">
    	<a href="#"><div class="thropy">
        	<img src="<?php echo base_url();?>assets/image/trophy.png" />
            <p>
            <div class="col-sm-4">
             <span><b><?php echo $Participatcount;?></b><br />Enter</span>
            </div>
            <div class="col-sm-4">
             <span><b><?php echo $wincount;?></b><br />Won</span>
            </div>
            <div class="col-sm-4">
             <span><b><?php echo $finalcount;?></b><br />Finalist</span>
            </div>
            		
          <!-- <span>0<br />Won</span>|<span>0<br />Finalist</span></p>-->
        </div></a>
    </div>
	
  		<div class="col-sm-3">
    	<a href="#"><div class="earning">
        	<img src="<?php echo base_url();?>assets/image/usd-icon.png" />
            <p>Total Earning<b>&nbsp;<?php if($totalearn==""){echo"0";}else{echo $totalearn;}?></b></p>
            <p>Current Balance:<b>&nbsp;<?php if($balance==""){echo"0";}else{echo $balance;}?></b></p>
        </div></a>
    </div>
    <div class="col-sm-3">
    	<a href="#"><div class="warning_point">
        	<img src="<?php echo base_url();?>assets/image/exclamation.png" />
            <p>Warning Point:&nbsp;<b><?php echo $warning_count;?></b></p>
        </div></a>
    </div>
    <div class="col-sm-3">
    <a href="<?php echo base_url();?>admin/change_password_designer"><div class="d_p_change-password">
        	<img src="<?php echo base_url();?>assets/image/security-icon.png" />
            <p>Change Password</p>
        </div></a>
  </div>
  		
    	
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