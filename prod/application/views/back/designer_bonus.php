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
            Designer Bonus/ Deduction
         </h3>
         <!-- END PAGE TITLE-->
         <!-- END PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <div class="portlet light portlet-fit portlet-form bordered">
                  <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
                  <div class="portlet-body">
                     <!-- BEGIN FORM-->
                     <form action="<?php echo base_url();?>admin_panel/save_bonus_transaction" class="form-horizontal" id="form_sample_1" method="post">
                        <div class="form-body">
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Desginer Name
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="designer_name" name="designer_name" value="<?php echo $user_data->user_name;?>" readonly />
                                 <input type="hidden" class="form-control" placeholder="" name="designer_id" onkeypress="return isNumberKey(event)" value="<?php echo $user_data->user_id;?>"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Desginer Id</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Price
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="bonus_price" name="bonus_price" value=""  onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Bonus Price</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Description
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <textarea class="form-control" required placeholder="" id="bonus_message" name="bonus_message"/></textarea>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Description</span>
                              </div>
                           </div>
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
       var charCode = (evt.which) ? evt.which : event.keyCode;
	   var value= evt.key;
       if (charCode > 31 && (charCode < 45 || charCode > 57 || charCode==47 || value.indexOf('.') != -1))
           return false;
       return true;
   }    
</script>