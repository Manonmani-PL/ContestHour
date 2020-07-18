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
           Announcements
         </h3>
         <!-- END PAGE TITLE-->
         <!-- END PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <div class="portlet light portlet-fit portlet-form bordered">
                  <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
                  <div class="portlet-body">
                     <!-- BEGIN FORM-->
					  <form action="<?php echo base_url();?>admin_panel/save_announcements" class="form-horizontal" id="form_sample_1" method="post">
                          <input type="hidden" class="form-control" placeholder="" name="id"  value="<?php echo isset($announcement)?$announcement->id:"";?>"/>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Tittle
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <input type="text" class="form-control" required placeholder="" id="Title" name="tittle" value="<?php echo isset($announcement)?$announcement->title:"";?> " />
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Tittle</span>
                              </div>
                           </div>
                           <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="form_control_1">Message
                              <span class="required">*</span>
                              </label>
                              <div class="col-md-5">
                                 <textarea class="form-control" required placeholder="" id="message" name="message" /><?php echo isset($announcement)?$announcement->message:"";?></textarea>
								 
                                 <div class="form-control-focus"> </div>
                                 <span class="help-block">Message</span>
                              </div>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Submit</button>
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
