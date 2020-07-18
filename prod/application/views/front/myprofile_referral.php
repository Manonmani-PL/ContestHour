
<?php $this->load->view('front/include/left_side_menu_designer');?>
<div class="col-sm-9">
    <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
    <?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
    <?php
        $uid=$user_details[0]->user_id;
       
    ?>
        <form action="<?php echo base_url();?>admin/edit_designer_info/<?php echo $user_details[0]->id?>" method="post" enctype="multipart/form-data">
            <div class="row right-border">
                <div class="col-sm-12 col-xs-12">

                    <div class="col-md-4 col-lg-4">
                        <div class="myprofile_box">
                            <img src="<?php if(!empty($user_details[0]->referral_profile)){ echo base_url();?>uploads/referral_profile/<?php echo $user_details[0]->referral_profile;} else { echo base_url();?>assets/images/referral_icon.png<?php }?>" class="myprofile_img">
							
                        </div>
                     
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h3 style="background:#ceccc6;padding:10px;margin:0px;">
                            <?php echo ucwords($user_details[0]->referral_name); ?>
                        </h3>
                        <div style="background:#f2f2f2;padding:10px;min-height: 150px;width: 100%;margin-top:10px;display:table;">
                            <span style="display:table;"><b>About Me</b></span>
                            <?php echo $user_details[0]->referral_intro;?>
                        </div>
                        
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div style="background:#f2f2f2;padding:10px; display:table;width:100%;">
                            <p>Total Earning<b style="float:right;">$ <?php

                             if($totalearn_referral==""){echo"0";}else{echo $totalearn_referral;}?></b></p>
                           <!--  <p>Current Balance:<b style="float:right;">$ <?php //if($balance==""){echo"0";}else{echo $balance;}?></b></p> -->
                        </div>
                        
                        <div style="background:#f2f2f2;padding:10px;margin-top:10px;display:table; width:100%;">
                            <span style="display:table;"><b>REFERRAL CODE</b></span>
                            <ul style="display:block;list-style:none;padding:0;text-align:left;">
                             
                               
                                <li style="display: inline-block;margin: 5px 0px;border: 1px solid #ccc;padding: 2px 5px;"><?php echo  $user_details[0]->user_referral_code; ?></li>
                               
                            </ul>
                        </div>
                        
                <!--         <a  style="background:#713365;padding:10px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" href="<?php //echo base_url();?>admin/update_designer">Edit Profile</a> -->
                        
                        <a  style="background:#713365;padding:10px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" href="<?php echo base_url();?>admin/change_password_referral">Change Password</a>
                    </div>
                </div>

            </div>
        </form>
        
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