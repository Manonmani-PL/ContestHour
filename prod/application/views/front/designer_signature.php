<?php $this->load->view('front/include/left_side_menu_designer'); ?>
<div class="col-sm-9">
   <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
   <?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
   
   <form action="<?php echo base_url();?>admin/save_designer_signature"  method="POST" enctype="multipart/form-data" >
      <div class="row right-border" style="min-height:auto">
        <div class="col-sm-12 col-md-12" style="margin-top:15px;">
            <h4>Designer Signature</h4>
        </div>
             
         <div class="col-sm-4 col-xs-12">
            <div class="profilephoto-space"><img src="<?php if(!empty($user_details[0]->signature)){ echo base_url();?>uploads/documents/<?php echo $user_details[0]->signature;} else { echo base_url();?>assets/image/designer_dummy_signature1.png<?php }?>" width="350px" height="60px" /></div>
            <table width="100%" cellpadding="5">
               <tr>
                  <td>
                    <input type="file" name="signature" id="signature" multiple value=""/>

                  </td>
               </tr>
            </table>
         </div>
          <br class="clearfix">
           <div class="col-sm-8 col-xs-12">
            <div class="myprofile-form">
        
                     
               <table width="100%" cellpadding="5" cellspacing="25">
          
            
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