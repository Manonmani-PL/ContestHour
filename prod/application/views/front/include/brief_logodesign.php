<script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>
<link href="<?php echo base_url();?>assets/js/mcColorPicker.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/mcColorPicker.js" type="text/javascript"></script>
<tr>
   <td><label>Tagline</label></td>
</tr>
<tr>
   <td><input type="text" name="logo_tag_line" class="logo_tag_line" id="logo_tag_line" /></td>
</tr>
</table>
<h3>Style Sliders <span>Move the slider accordingly to your style</span></h3>
<table width="100%" cellpadding="5" cellspacing="5">
   <tr>
      <td>
         <div class="d-style_desc_detail">
            <p>
               <span style="width:100px;">Feminine</span> &nbsp;&nbsp;
               <span style="margin-top:8px;" class="range_slider"><input type="range" class="range" name="fem_mas" /></span>&nbsp;&nbsp;
               <span style="width:100px;">Masculine</span>
            </p>
            <p> 
               <span style="width:100px;">Simple</span>&nbsp;&nbsp;
               <span style="margin-top:8px;" class="range_slider"><input type="range" class="range" name="sim_com"/></span>&nbsp;&nbsp;
               <span style="width:100px;">Complex</span>
            </p>
            <p> 
               <span style="width:100px;">Modest</span>&nbsp;&nbsp;
               <span style="margin-top:8px;" class="range_slider"><input type="range" class="range" name="mod_lux" /></span>&nbsp;&nbsp;
               <span style="width:100px;">Luxury</span>
            </p>
            <p> 
               <span style="width:100px;">Playful</span>&nbsp;&nbsp;
               <span style="margin-top:8px;" class="range_slider"><input type="range" class="range" name="ply_ser" /></span>&nbsp;&nbsp;
               <span style="width:100px;">Serious</span>
            </p>
            <p>
               <span style="width:100px;">Modern</span>&nbsp;&nbsp;
               <span style="margin-top:8px;" class="range_slider"><input type="range" class="range" name="mod_vin" /></span>&nbsp;&nbsp;
               <span style="width:100px;">Vintage</span>
            </p>
            <p> 
               <span style="width:100px;">Sporty</span>&nbsp;&nbsp;
               <span style="margin-top:8px;" class="range_slider"><input type="range" class="range" name="spo_ele" /></span>&nbsp;&nbsp;
               <span style="width:100px;">Elegant</span>
            </p>
         </div>
      </td>
   </tr>
</table>
<h3>Color</h3>
<table width="100%" cellpadding="5" cellspacing="5">
   <tr>
      <td>Please describe the colors you would like to see in your logo:</td>
   </tr>
   <tr>
      <td>
         <div id="pick_color" class="d-style_desc_detail">
            <div class="d-style_desc_detail">
               <input name="color1" style="border:1px solid red;width:100px;float:left;display:none;" type="text" class="color" value="#fff" />
               <input name="color2" style="border:1px solid red;width:100px;float:left;display:none;" type="text" class="color" value="#fff"/>
               <input name="color3" style="border:1px solid red;width:100px;float:left;display:none;" type="text" class="color" value="#fff" />
               <input name="color4" style="border:1px solid red;width:100px;float:left;display:none;" type="text" class="color" value="#fff" />
            </div>
            <!--
               <br style="clear:both;">
               <br style="clear:both;">
			   <button name="color_pick" class="r-color jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'}"></button>
               <input type="hidden" name="color1" id="chosen-value" value="FFFFFF">
                                  <button class="r-color jscolor {valueElement:'chosen-value1', onFineChange:'setTextColor(this)'}"></button>
               <input type="hidden" name="color2" id="chosen-value1" value="FFF">
                                  <button class="r-color jscolor {valueElement:'chosen-value2', onFineChange:'setTextColor(this)'}"></button>
               <input type="hidden" name="color3" id="chosen-value2" value="FFFFFF">
                                  <button class="r-color jscolor {valueElement:'chosen-value3', onFineChange:'setTextColor(this)'}"></button>
               <input type="hidden" name="color4" id="chosen-value3" value="FFFFFF">
               
               <!--<div class="r-color"><input type="text" name="color1" value="red" id="color0" /></div>
               <div class="g-color"><input type="hidden" name="color2" value="green" id="color2" /></div>
               <div class="l-color"><input type="hidden" name="color3" value="yellow" id="color3" /></div>
               <div class="b-color"><input type="hidden" name="color4" value="blue" id="color4" /></div>-->
         </div>
         <span style="margin-left:15px;">Click on the boxes to choose your color</span>
      </td>
   </tr>
</table>
<h3>Ideas</h3>
<table width="100%" cellpadding="4" cellspacing="5">
   <tr>
      <td><label>Please provide any ideas or concepts that you have for your logo:</label></td>
   </tr>
   <tr>
      <td><textarea rows="5" cols="10" class="logo_style_idea" name="logo_style_idea" id="logo_style_idea" ></textarea></td>
   </tr>
</table>
<h3>Attachment</h3>
<table width="100%" cellpadding="5" cellspacing="5" class="attachment">
   <tr>
      <td><label>Do you have any documents or images that would be helpful for the contest?</label></td>
   </tr>
   <tr>
      <td><input type="file" name="userfile"  />&nbsp;</td>
	</tr>
</table>
<table width="100%" cellpadding="5" cellspacing="5">
   <tr>
      <td><input type="radio" name="copy_right" checked />&nbsp; No Attachments </td>
   </tr>
   <tr>
      <td><input type="radio" name="copy_right"/>&nbsp; I certify that I own full copyrights to the attached material. </td>
   </tr>
   <tr>
      <td><input type="radio" name="copy_right"/>&nbsp; I do not own the full copyrights to the attached material and it is for reference purposes only. </td>
   </tr>
</table>