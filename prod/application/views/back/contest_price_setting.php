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
            Contest Prize Percentage
         </h3>
         <!-- END PAGE TITLE-->
         <!-- END PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <div class="portlet light portlet-fit portlet-form bordered">
                  <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
                  <div class="portlet-body">
                     <!-- BEGIN FORM-->
                     <form action="<?php echo base_url();?>admin_panel/save_price_setting" class="form-horizontal" id="form_sample_1" method="post">
                        <div class="form-body">
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Contesthours Charge (%)
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="contest_percentage" name="contest_percentage" value="<?php echo (isset($setval->contest_percentage) && !empty($setval->contest_percentage))?$setval->contest_percentage: 0;  ?>" onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Contesthours Percentage</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Winner (1st)  (%)
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="winner_percentage" name="winner_percentage" value="<?php echo (isset($setval->winner_percentage) && !empty($setval->winner_percentage))?$setval->winner_percentage: 0;  ?>"  onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Contest Winner(1st Place) Prize Percentage</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Runner (2nd)  ($)
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="runner_percentage" name="runner_percentage" value="<?php echo (isset($setval->runner_percentage) && !empty($setval->runner_percentage))?$setval->runner_percentage: 0;  ?>"  onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Contest Runner(2nd Place) Price Percentage</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Transaction Charge ($)
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="transaction_charge" name="transaction_charge" value="<?php echo (isset($setval->transaction_charge) && !empty($setval->transaction_charge))?$setval->transaction_charge: 0;  ?>"  onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Price Amount Transaction Charges</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Contest Custom Payment Price ($)
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="payable_price" name="payable_price" value="<?php echo (isset($setval->payable_price) && !empty($setval->payable_price))?$setval->payable_price: 0;  ?>"  onkeypress="return isNumberKey(event)"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Custom Contest Payable Amount</span>
                              </div>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Save</button>
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