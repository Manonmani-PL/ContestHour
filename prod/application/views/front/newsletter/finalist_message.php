﻿<div style="with:100%;padding:5%;">
<table bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="100%" style="border:none; border:2px solid red;">
    <tbody>
        <tr>
            <td >
			   <div class="contentEditable">
                                  <img src="<?php echo base_url()?>assets/images/email_bg.jpg" width="100%" height="73" alt='' data-default="placeholder" data-max-width="560">
                                </div>
                
            </td>
        </tr>
        <tr>
            <td align="left" style="padding:30px 10px 10px 10px;border:none;font-size:16px;color:#404040;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:150%"> 
			Hey <b><?php echo username($designer_id)?></b>, </td>
        </tr>
        <tr>
            <td style="padding:10px 10px 30px 10px;border:none;font-size:16px;color:#424242;text-align:justify;line-height:150%;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"><p>
                                      <b><?php echo get_name();?> </b> has selected you as a finalist in  <b>"<a href="<?php echo base_url()."contest/contest_entries/".$contest_id;?>"><?php echo ucwords(contestname($contest_id));?></a>"</b> The client has sent a message for your design <b></b>
                                    <br>
                               
									 
								 
                                    <br>
                                    Best Regards,
                                    <br>
                                    <a style="text-decoration:none;color:#000;" href="http://www.contesthours.com/"><b>contesthours.com</b></a>
                                  </p></td>
        </tr>

        <tr>
            <td align="center" >
                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td align="center">
                                <div class="contentEditable">
                                  <img src="<?php echo base_url()?>assets/images/email_bg.jpg" width="100%" height="73"  alt='' data-default="placeholder" data-max-width="560">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

    </tbody>
</table>
</div>