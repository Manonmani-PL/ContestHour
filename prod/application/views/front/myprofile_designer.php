<?php $this->load->view('front/include/left_side_menu_designer');?>
<div class="col-sm-9">
    <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
    <?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
    <?php
        $uid=$user_details[0]->user_id;
        $wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
        $finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
        $Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
        $warning_count=$this->Common_model->get_records_count('contest_warning',array('designer_id'=>$uid));
    ?>
        <form action="<?php echo base_url();?>admin/edit_designer_info/<?php echo $user_details[0]->id?>" method="post" enctype="multipart/form-data">
            <div class="row right-border">
                <div class="col-sm-12 col-xs-12">

                    <div class="col-md-4 col-lg-4">
                        <div class="myprofile_box">
                            <img src="<?php if(!empty($user_details[0]->designer_profile)){ echo base_url();?>uploads/designer_profile/<?php echo $user_details[0]->designer_profile;} else { echo base_url();?>assets/images/designer-signup.png<?php }?>" class="myprofile_img">
							<?php if($desiner_total_designs >0){?>
                            <div class="status-rank"><i style="margin-top: -60px; position: absolute; display: inline-block; font-size: 19px; color: rgb(255, 255, 255); margin-left: 7px;"><?php echo $designer_rank[0]->rank;?><span style="font-size:13px"><?php echo ordinal($designer_rank[0]->rank)?></span></i> </div>
							<?php } ?>
                        </div>
                        
                        <h3> ACHIEVEMENTS </h3>
                        <ul style="list-style-type:none;line-height:32px; padding:0px;	">
                            <li><i style=" color:#fff;background:#f4b321;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> GOLD WINS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo $wincount?></span></li>
							<!-- 
                            <li><i style="color:#fff;background:#bcbcbc;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> SILVER WINS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo $finalcount-$wincount?></span></li>-->
                            <li><i style=" color:#fff;background:#006837;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> FINALISTS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo $finalcount;?></span></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h3 style="padding:10px;margin:0px; background: #9b7093">
                            <?php echo ucwords($user_details[0]->designer_name); ?>
                        </h3>
                        <div style="background:#f2f2f2;padding:10px;min-height: 100px;width: 100%;margin-top:10px;display:table;">
                            <span style="display:table;"><b>About Me</b></span>
                            <?php echo $user_details[0]->designer_intro;?>
                        </div>
                        <div style="background:#f2f2f2; padding:10px;margin-top:10px; display:table;width:100%;">
                            <ul style="list-style-type:none;line-height:32px;margin:0px;padding:0px;">
                                <li><i class="fa fa-arrow-circle-right"></i>
                                    <?php echo $Participatcount;?> Contests Entered </li>
                                <!--<li><i class="fa fa-clock-o"></i> Last Login 3 Hours, 50 Minutes ago</li>-->
                                <li><i class="fa fa-exclamation-triangle" style="color:red;"></i>
                                    <?php echo $warning_count?> Warning </li>
                            </ul>

                        </div>
                           <a  style="background:#713365;padding:10px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" href="<?php echo base_url();?>admin/designer_signature">Signature Upload</a>

                   <!--  <input type="file"  style="background:#713365;padding:10px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" id="des_signature" name="signature"> -->
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div style="background:#f2f2f2;padding:13px; display:table;width:100%;">
                            <p>Total Earning<b style="float:right;">$ <?php if($totalearn==""){echo"0";}else{echo $totalearn;}?></b></p>
                            <p>Current Balance:<b style="float:right;">$ <?php if($balance==""){echo"0";}else{echo $balance;}?></b></p>
                        </div>
                        
                        <div style="background:#f2f2f2;padding:13px;margin-top:13px;display:table; width:100%;">
                            <span style="display:table;"><b>EXPERIENCE</b></span>
                            <ul style="display:block;list-style:none;padding:0;text-align:left;">
                               <?php 
                                foreach( $contest_type as $tmp){?>
                                <li style="display: inline-block;margin: 5px 0px;border: 1px solid #ccc;padding: 2px 5px;"><?php echo $tmp->contest_type; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        
                        <a  style="background:#713365;padding:11px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" href="<?php echo base_url();?>admin/update_designer">Edit Profile</a>
                        
                        <a  style="background:#713365;padding:11px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" href="<?php echo base_url();?>admin/change_password_designer">Change Password</a>
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
