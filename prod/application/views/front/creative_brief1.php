<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker-plus.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-colorpicker-plus.js"></script>
<div class="gap-low"></div>


<div class="minheight">
<form action="<?php echo base_url(); ?>contest/insert_brief" name="creative_brief" id="creative_brief" method="post" enctype="multipart/form-data">
                <input type="hidden" name="dis_type" value="<?php echo $design_type; ?>"  />
<div class="container">
	<div class="row">
    	
        <div class="col-md-3 col-lg-3">
        	<div class="choose_cat">
            	<div class="choose_cat_icon "><img src="<?php echo base_url();?>assets/image/last_choose_cat_icon1.png" width="71" height="72" />&nbsp;&nbsp;<span class="before_page" >Choose category</span></div>
            </div>
        </div>
         <div class="col-md-3 col-lg-3">
         		<div class="creative_brief">
            	<div class="creative_brief_icon"><img src="<?php echo base_url();?>assets/image/creative_brief_active_icon.png" width="71" height="72" />&nbsp;&nbsp;<span class="select">Creative brief</span></div>
            </div>
         </div>
          <div class="col-md-3 col-lg-3">
          	<div class="payment_option">
            	<div class="payment_icon"><img src="<?php echo base_url();?>assets/image/payment_icon.png" width="71" height="72" />&nbsp;&nbsp;<span>Payment options</span></div>
            </div>
          </div>
           <div class="col-md-3 col-lg-3">
           
           <div class="conform_order">
            	<div class="conform_ordert_icon"><img src="<?php echo base_url();?>assets/image/conformorder_icon.png" width="71" height="72" />&nbsp;&nbsp;<span>Confirm order</span></div>
            </div>
           
           </div>
        
    </div>
</div>

<section>
	<div class="col-md-12 col-lg-12">
    	<div class="col-sm-3">
        	<div class="line"></div>
        </div>
        <div class="col-sm-6">
        	<div class="creative_breif-header">
            	<b>Describe the <?php echo $title; ?> you need</b>
                <p>Lets get started with some basic information about your project</p>
            </div>
        </div>
        <div class="col-sm-3">
        	<div class="line"></div>
        </div>
    </div>
</section>

<section>
<div class="container">
	<div class="row">
    	<div class="col-md-3 col-lg-3"></div>
        <div class="col-md-6 col-lg-6">
        	<div class="creative_brief">
            		<h3>Name & Description</h3>
					
            	
                	<table width="100%" cellpadding="5" cellspacing="5">
                    
                    <?php 
                        if($design_type != 'logodesign' && $design_type != 'webdesign' && $design_type != 'movielogodesign' ){
                    ?>
                    
                    <tr>
                    <td><label>Contest Title</label></td>
                    </tr>
                    <tr>
                    <td><input type="text" name="cont_tit" class="cont_tit" id="cont_tit" /></td>
                    </tr>
                    <tr>
                    <td><label>Contest Description</label></td>
                    </tr>
                    <tr>
                    <td><textarea rows="5" cols="10" class="cont_desc" name="cont_desc" id="cont_desc"></textarea>
                    </td>
                    </tr>
                    <?php }?>
                    <tr>
                    <td><label>
                    <?php  
                        if($design_type == 'logodesign'){
                            echo 'Company Title (Logo Name)';
                        }
                        else{
                            echo 'Organization or business name';
                        }
                    ?>
                    </label></td>
                    </tr>
                    <tr>
                    <td><input type="text" name="org_bus" class="org_bus" id="org_bus" /></td>
                    </tr>
                    <tr>
                    <td><label>Please describe what your business does in one sentence</label></td>
                    </tr>
                    <tr>
                    <td><textarea rows="5" cols="10" class="creative_brief_msg_area" name="creative_brief_msg_area" id="creative_brief_msg_area"></textarea>
                    </td>
                    </tr>
                    <?php if( $design_type != 'webdesign' && $design_type != 'logodesign' && $design_type != 'movielogodesign' && $design_type != 'cdcoverdesign' ){ ?>
                    <tr>
                    <td><label>Size</label></td>
                    </tr>
                    <tr>
                    <td><input type="text" name="ts_size" id="ts_size" class="ts_size" /></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td><label>Select Industries</label></td>
                    </tr>
                    <tr>
                    <td>
                    <select name="indus">
                      <option value="">Select Industries</option>
                      <?php foreach ($industries as $indus) { ?>
                                <option <?php  echo'value='. $indus->id;?>><?php echo $indus->industry_name;?></option>
                            <?php } ?>
                                     
                    </select>
                    </td>
                    </tr>
                    <?php
                        if($design_type == 'logodesign'){
                            require('include/brief_logodesign.php');
                        }
                        else{
                            require('include/brief_common.php');   
                        }
                    ?>
                    
                
            </div>
        </div>
        <div class="col-md-3 col-lg-3"></div>
    </div>
	
</div>
</section>

<section>
<hr />
</section>

<section>

<div class="container">
	<div class="col-md-3"></div>
    <div class="col-md-2">
    	<div class="save_progress">
        		<input type="submit" name="sub_btn" value="Save Progress" />
        </div>
    </div>
    <div class="col-md-3">
    	<div class="proceed_payment">
        		<input type="submit" name="sub_btn" value="Proceed to Payment Option" />
        </div>
    </div>
    <div class="col-md-4"></div>
</div>	

</section>

</form>
</div>

<div class="gap"></div>
