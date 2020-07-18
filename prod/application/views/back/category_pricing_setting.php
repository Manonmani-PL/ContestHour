<!-- BEGIN CONTAINER -->
<div class="page-container">
   <?php require('include/side_bar.php'); ?>        
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
         <!-- BEGIN PAGE HEADER-->
         <!-- BEGIN PAGE TITLE-->
         <h3 class="page-title"> 
            Category Based Pricing
         </h3>
         <!-- END PAGE TITLE-->
         <!-- END PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <div class="portlet light portlet-fit portlet-form bordered">
                  <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
                  <div class="portlet-body">
                     <!-- BEGIN FORM-->
                     <form action="<?php echo base_url();?>admin_panel/save_category_pricing_setting" class="form-horizontal" id="form_sample_1" method="post">
                        <div class="form-body">
						<?php foreach ($setval as $sv){?>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1"><?php echo $sv->display_name;?>
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="minimum_fee" name="<?php echo $sv->code;?>" value="<?php echo (isset($sv->minimum_fee) && !empty($sv->minimum_fee))?$sv->minimum_fee: 0;  ?>" onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block"><?php echo $sv->code;?></span>
                              </div>
							  </div>
						<?php }?>
                           
                           
                        </div>
                        <div class="form-actions">
                           <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Add</button>
                                 <button type="reset" class="btn default">Reset</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- END FORM-->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   function isNumberKey(evt){
       var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
           return false;
       return true;
   }    
</script>