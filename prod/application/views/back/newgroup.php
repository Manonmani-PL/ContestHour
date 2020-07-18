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
                     <form action="<?php echo base_url();?>mailer/saveGroup" class="form-horizontal" id="form_sample_1" method="post" enctype="multipart/form-data">
                        <div class="form-body">
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Group Title
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="group_title" name="group_title"/>
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Group Title</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">File Upload
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="file" class="form-control" required id="group_file" name="group_file">
                              </div>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Upload</button>
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