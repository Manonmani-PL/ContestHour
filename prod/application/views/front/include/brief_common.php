<tr>
	<td><label>Language</label></td>
</tr>
<tr>
    <td>
        <select name="b_f_l">
		   <option value="">Select Language</option>
		   <option value="Afrikaans">Afrikaans</option>
		   <option value="Albanian">Albanian</option>
		   <option value="Arabic">Arabic</option>
		   <option value="Azerbaijani">Azerbaijani</option>
		   <option value="Basque">Basque</option>
		   <option value="Bengali">Bengali</option>
		   <option value="Belarusian">Belarusian</option>
		   <option value="Bulgarian">Bulgarian</option>
		   <option value="Catalan">Catalan</option>
		   <option value="Chinese Simplified">Chinese Simplified</option>
		   <option value="Chinese Traditional">Chinese Traditional</option>
		   <option value="Croatian">Croatian</option>
		   <option value="Czech">Czech</option>
		   <option value="Danish">Danish</option>
		   <option value="Dutch">Dutch</option>
		   <option value="English">English</option>
		   <option value="Esperanto">Esperanto</option>
		   <option value="Estonian">Estonian</option>
		   <option value="Filipino">Filipino</option>
		   <option value="Finnish">Finnish</option>
		   <option value="French">French</option>
		   <option value="Galician">Galician</option>
		   <option value="Georgian">Georgian</option>
		   <option value="German">German</option>
		   <option value="Greek">Greek</option>
		   <option value="Gujarati">Gujarati</option>
		   <option value="Haitian Creole">Haitian Creole</option>
		   <option value="Hebrew">Hebrew</option>
		   <option value="Hindi">Hindi</option>
		   <option value="Hungarian">Hungarian</option>
		   <option value="Icelandic">Icelandic</option>
		   <option value="Indonesian">Indonesian</option>
		   <option value="Irish">Irish</option>
		   <option value="Italian">Italian</option>
		   <option value="Japanese">Japanese</option>
		   <option value="Kannada">Kannada</option>
		   <option value="Korean">Korean</option>
		   <option value="Latin">Latin</option>
		   <option value="Latvian">Latvian</option>
		   <option value="Lithuanian">Lithuanian</option>
		   <option value="Macedonian">Macedonian</option>
		   <option value="Malay">Malay</option>
		   <option value="Maltese">Maltese</option>
		   <option value="Norwegian">Norwegian</option>
		   <option value="Persian">Persian</option>
		   <option value="Polish">Polish</option>
		   <option value="Portuguese">Portuguese</option>
		   <option value="Romanian">Romanian</option>
		   <option value="Russian">Russian</option>
		   <option value="Serbian">Serbian</option>
		   <option value="Slovak">Slovak</option>
		   <option value="Slovenian">Slovenian</option>
		   <option value="Spanish">Spanish</option>
		   <option value="Swahili">Swahili</option>
		   <option value="Swedish">Swedish</option>
		   <option value="Tamil">Tamil</option>
		   <option value="Telugu">Telugu</option>
		   <option value="Thai">Thai</option>
		   <option value="Turkish">Turkish</option>
		   <option value="Ukrainian">Ukrainian</option>
		   <option value="Urdu">Urdu</option>
		   <option value="Vietnamese">Vietnamese</option>
		   <option value="Welsh">Welsh</option>
		   <option value="Yiddish">Yiddish</option>
		</select>
    </td>
</tr>
</table>
<?php if($design_type!= 'movielogodesign'){ ?>

<?php if($design_type== 'webdesign'){ ?>
<h3>Background information</h3>
<table width="100%" cellpadding="5" cellspacing="5">
    <tr>
    	<td><label>If you have an existing website, please list it here</label></td>
    </tr>
    <tr>
    	<td><input type="text" name="background_info" id="background_info" /></td>
    </tr>
</table>
<?php } elseif($design_type== 'tshirtdesign'){ ?>
<h3>Background information</h3>
<table width="100%" cellpadding="5" cellspacing="5">
<tr>
	<td><label>Who is the t-shirt for?</label></td>
</tr>
<tr>
    <td><input type="radio" value="men" name="background_info" checked="checked" />&nbsp;Men</td>
</tr>
<tr>
	<td ><input type="radio" value="women" name="background_info" />&nbsp;Women</td>
</tr>
<tr>
	<td><input type="radio" value="boys" name="background_info" />&nbsp;Boys</td>
</tr>
<tr>
	<td><input type="radio" value="girls" name="background_info" />&nbsp;Girls</td>
</tr>
</table>
<?php }?>


<h3>Content details</h3>

<table width="100%" cellpadding="5" cellspacing="5">
<?php if($design_type== 'webdesign'){ ?>
    <tr>
    	<td><label>How many pages do you need designed for your website?</label></td>
    </tr>
    <tr>
    	<td><input type="radio" name="condet" checked="checked" />&nbsp; 1 page(from $399+)homepage</td>
    </tr>
    <tr>
    	<td ><input type="radio"  name="condet" />&nbsp; 2 pages(from $549)</td>
    </tr>
    <tr>
    	<td><input type="radio" name="condet" />&nbsp; 3 pages(from $699)</td>
    </tr>
    <tr>
    	<td><input type="radio"  name="condet" />&nbsp; 4 pages(from $849)</td>
    </tr>
    <tr>
    	<td><input type="radio" name="condet" />&nbsp; 5 pages(from $999) </td>
    </tr>
<?php } elseif($design_type== 'tshirtdesign'){ ?>
<tr>
	<td><label>What kind of t-shirt do you want designed?</label></td>
</tr>
<tr>
	<td><input type="radio" value="std_short_sleeve" checked name="choose_tshirt" class="choose_tshirt" />&nbsp;Standard short-sleeve t-shirt</td>
</tr>
<tr>
	<td ><input type="radio" value="tank_top" name="choose_tshirt" class="choose_tshirt" />&nbsp;Tank top</td>
</tr>
<tr>
	<td><input type="radio" value="short_sleeve_btn_up" name="choose_tshirt" class="choose_tshirt" />&nbsp;Short sleeved button up shirt</td>
</tr>
<tr>
	<td><input type="radio" value="polo" name="choose_tshirt" class="choose_tshirt" />&nbsp; Polo shirt  </td>
</tr>
<tr>
	<td><input type="radio" value="business" name="choose_tshirt" class="choose_tshirt" />&nbsp;Dress/business shirt  </td>
</tr>
<tr>
	<td><input type="radio" value="others_tshirt" name="choose_tshirt" class="choose_tshirt" />&nbsp;Other, please specify  </td>
</tr>
<tr class="other_tshirt">
	<td>
        <textarea rows="3" cols="10" class="form-control" name="other_tshirt"></textarea>
	</td>
</tr>
	
<?php } else {?>
<tr>
	<td>Content Details</td>
</tr>
<tr>
	<td><textarea rows="5" cols="10" class="flyer_con_detail" name="flyer_con_detail" id="flyer_con_detail"></textarea></td>
</tr>
<?php } ?>
</table>
<?php  } ?>
<h3>Visual style</h3>
<table width="100%" cellpadding="4" cellspacing="5">
<?php if($design_type== 'webdesign'){ ?>
    <tr>
    	<td><label>What ideas do you have for the style/theme of your website design?</label></td>
    </tr>
    <tr>
    	<td><textarea rows="5" cols="10" class="creative_b_msg_area" name="creative_b_msg_area" id="creative_b_msg_area"></textarea></td>
    </tr>
    <tr>
    	<td><label>Reference website address</label></td>
    </tr>
    <tr>
		<td><input type="text" name="r_w_a" class="r_w_a" id="r_w_a" /></td>
    </tr>
    <tr>
    	<td><label>What do you like about the refence website?</label></td>
    </tr>
    <tr>
    	<td><textarea rows="5" cols="10" class="creative_b_msg_area" name="ref_website" id="creative_b_msg_area"></textarea></td>
    </tr>
<?php } elseif($design_type== 'tshirtdesign'){ ?>
<tr>
	<td><label>Do you have any specific colors in mind?</label></td>
</tr>
<tr>
	<td><textarea rows="5" cols="10" class="color_mind" name="color_mind" id="color_mind"></textarea></td>
</tr>
<tr>
	<td><label>Do you have ideas about the visual style you want?</label></td>
</tr>
<tr>
	<td><textarea rows="5" cols="10" class="visual_style_idea" name="visual_style_idea" id="visual_style_idea"></textarea></td>
</tr>
<?php } else {?>
<tr>
	<td><label>Do you have ideas about the visual style you want?</label></td>
</tr>
<tr>
	<td><textarea rows="5" cols="10" class="visual_style_idea" name="visual_style" id="visual_style_idea" placeholder="Enter the links to reference images"></textarea></td>
</tr>
<?php } ?>    
</table>

<h3>Others</h3>
<table width="100%" cellpadding="5" cellspacing="5">
    <tr>
    	<td><label>Is there anything else you would like to communicate to the designers?</label></td>
    </tr>
    <tr>
    	<td><textarea rows="5" cols="10" class="creative_b_msg_area" name="comm_design" id="creative_b_msg_area"></textarea></td>
    </tr>
   
</table>

<h3>Attachment</h3>
<table width="100%" cellpadding="5" cellspacing="5" class="attachment">
    <tr>
    <td><label>Do you have any documents or images that would be helpful for the contest?</label></td>
    </tr>
    <tr>
    <td><input type="file" name="userfile" />&nbsp;
    </td>
</table>
<?php if($design_type== 'webdesign'){ ?>
<h3>Coding Type</h3>
                   
<table width="100%" cellpadding="5" cellspacing="5">

    <tr>
    <td>
        <select class="form-control coding_type" name="coding_type">
            <option value="notsure">Not sure</option>
            <option value="wordpress">WordPress</option>
            <option value="dropal">Drupal</option>
            <option value="joomla">Joomla</option>
            <option value="other">Other</option>
        </select>

    </td>
    </tr>
	<tr class="other_dis"><td>What are you looking for</td></tr>
	<tr class="other_dis">
    <td>
        <textarea rows="3" cols="10" class="form-control" name="other_code_option"></textarea>
	</td>
    </tr>
</table>
<?php } elseif($design_type== 'businesscarddesign'){ ?>
<!--
<table width="100%" cellpadding="5" cellspacing="5">
<tr>
	<td><label>Would you like a free quote to print your stationery items?</label></td>
</tr>
<tr>
	<td><input type="radio" value="Yes" name="radio_bus"  checked="checked" />&nbsp;Yes - I'd like a Contesthours' printing partner to contact me with a free, no obligation quote</td>
</tr>
<tr>
	<td><input type="radio" value="No" name="radio_bus" />&nbsp;No - I will organize printing myself</td>
</tr>
</table>-->
<?php } ?>
<script>
$(document).ready(function(){
	$('.other_dis').hide();
	$('.other_tshirt').hide();
	
	$('.coding_type').on('change',function(){
		var code_val=$(this).val();
		if(code_val=='other'){
			$('.other_dis').show();
		}
		else{
			$('.other_dis').hide();
		}
	});
	$('.choose_tshirt').on('change',function(){
		var code_val=$(this).val();
		if(code_val=='others_tshirt'){
			$('.other_tshirt').show();
		}
		else{
			$('.other_tshirt').hide();
		}
	});
	
});
</script>