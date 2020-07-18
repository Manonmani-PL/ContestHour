<div class="gap-low"></div>
<div class="minheight">
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2">
<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
<?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
    
   <form action="<?php echo base_url();?>admin/mailContact"  method="post">
      <div class="right-border">
         <div class="col-sm-12 col-xs-12">
            <div class="myprofile-form"> 
			   <h4 style="">Support Form</h4>
               <table width="100%" cellpadding="5" cellspacing="25">
				  <tr>
                     <td width="10%">
                        <div align="left"><label>Name</label></div>
                     </td>
                     <td width="70%">
                        <div align="left"><input type="text" name="name" id="name" class="message" value="" placeholder="" required="" /></div>
                     </td>
                  </tr>
				  <tr>
                     <td width="10%">
                        <div align="left"><label>Email</label></div>
                     </td>
                     <td width="70%">
                        <div align="left"><input type="text" name="email" id="email" class="message" value="" required="" /></div>
                     </td>
                  </tr>
				  <tr>
                     <td width="10%">
                        <div align="left"><label>Subject</label></div>
                     </td>
                     <td width="70%">
                        <div align="left"><input type="text" name="subject" id="subject" class="message" value="" required="" /></div>
                     </td>
                  </tr>
                  <tr>
                     <td width="10%">
                        <div align="left"><label>Message</label></div>
                     </td>
                     <td width="70%">
                        <div align="left">
                           <textarea rows="10" cols="20" class="myself" id="myself" name="intro"></textarea>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td width="10%"></td>
                     <td width="70%">
                        <div align="left"><input type="submit" value="Submit" class="submit" /></div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </form>
</div>
</div>
</div>
</div>
</div>