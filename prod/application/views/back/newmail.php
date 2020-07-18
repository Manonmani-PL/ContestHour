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
                     <form action="<?php echo base_url();?>mailer/sendMail" class="form-horizontal" id="form_sample_1" method="post">
                        <div class="form-body">
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Select Group
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <select class="form-control" required id="group_id" name="group_id">
								 <?php foreach($groups as $tmp){?>
									<option value="<?php echo $tmp->group_id;?>"><?php echo $tmp->group_title?></option>
								 <?php } ?>
								 </select>
                              </div>
                           </div>
						   <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Subject
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <textarea class="form-control" placeholder="" id="mail_subject" name="mail_subject"/></textarea>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Subject</span>
                              </div>
                           </div>
						   <!--
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Other Emails
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <textarea class="form-control" placeholder="" id="bonus_message" name="bonus_message"/></textarea>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Other Emails (if multiple use ",")</span>
                              </div>
                           </div>
						   -->
                        </div>
                        <div class="form-actions">
                           <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Send</button>
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