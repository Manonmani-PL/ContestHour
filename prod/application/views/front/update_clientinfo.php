<?php $this->load->view('front/include/left_side_menu_designer'); ?>
<div class="col-sm-9">   
   <form action="<?php echo base_url();?>admin/edit_client_info/<?php echo $user_details[0]->id?>"  method="post" enctype="multipart/form-data" >
      <div class="row right-border" style="min-height:auto">
        <div class="col-sm-12 col-md-12" style="margin-top:15px;">
            <h4>Update Designer Status</h4>
        </div>
             
         <div class="col-sm-4 col-xs-12">
            <div class="profilephoto-space"><img src="<?php if(!empty($user_details[0]->profile)){ echo base_url();?>uploads/client_profile/<?php echo $user_details[0]->profile;} else { echo base_url();?>assets/image/dummy-images.png<?php }?>" width="150px" height="150px" /></div>
            <table width="100%" cellpadding="5">
               <tr>
                  <td><input type="file" name="profile_photo" id="profile_photo" value="<?php echo $user_details[0]->profile; ?>" />
                     <input type="hidden" name="old_file_name" id="old_file_name" value="<?php echo $user_details[0]->profile;?>" />
                  </td>
               </tr>
            </table>
         </div>
          <br class="clearfix">
         <div class="col-sm-8 col-xs-12">
            <div class="myprofile-form">         
               <table width="100%" cellpadding="5" cellspacing="25">
                  <tr>
                     <td width="10%">
                        <div align="left"><label>Intro</label></div>
                     </td>
                     <td width="70%">
                        <div align="left">
                           <textarea rows="10" cols="20" class="myself" id="myself" name="myself"><?php echo $user_details[0]->intro; ?></textarea>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td width="10%"></td>
                     <td width="70%">
                        <div align="left"><input type="submit" value="Update" class="submit" /></div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         
      </div>
   </form>
   <br style="clear:both;">
   
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