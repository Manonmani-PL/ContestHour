<?php $this->load->view('front/include/left_side_menu_client'); ?>
<div class="col-sm-9">
<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
<?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
    
   <form action="<?php echo base_url();?>admin/save_support"  method="post" enctype="multipart/form-data" >
      <div class="right-border">
         <div class="col-sm-12 col-xs-12">
            <div class="myprofile-form"> 
				<h4 style="">Support Form</h4>
               <table width="100%" cellpadding="5" cellspacing="25">
                  
                  <tr>
                     <td width="10%">
                        <div align="left"><label>Support</label></div>
                     </td>
                     <td width="70%">
                        <div align="left">
                           <select  name="support_payment" class="form-control" id="select-country">
							  <option value=""> Choose Any </option>
                              <?php foreach ($support as $supp) { ?>
                              <option value="<?php echo $supp->id; ?>"><?php echo $supp->support_type; ?></option>
                              <?php } ?>
                           </select>
                        </div>
						<p class="error"><?php echo form_error('support_payment');?></p>
                     </td>
                  </tr>
				  <tr>
                     <td width="10%">
                        <div align="left"><label>Subject</label></div>
                     </td>
                     <td width="70%">
                        <div align="left"><input type="text" name="message" id="message" class="message" value="" /></div>
						<p class="error"><?php echo form_error('message');?></p>
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
                     <td width="10%">
                        <div align="left"><label>File Upload</label></div>
                     </td>
                     <td width="70%">
                        <div align="left">
                           <input style="width:100%;border:none;" type="file" name="support_file" id="support_file" />
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