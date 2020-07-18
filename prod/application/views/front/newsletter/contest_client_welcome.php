<div style="with:100%;padding:5%;">
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
               Dear <b><?php echo username($client_id)?></b>, 
            </td>
         </tr>
         <tr>
            <td style="padding:10px 10px 30px 10px;border:none;font-size:16px;color:#424242;text-align:justify;line-height:150%;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
               <p>
                  <b>Welcome, Thank you for launching your design contest at CONTESTHOURS.</b>
                  <br>
                  <b> Project Name: <?php echo ucwords(contestname($contest_id));?></b>
                  <br>
                  <b> Project Link:</b> <b>"<a href="<?php echo base_url()."contest/contest_brief/".$contest_id;?>">
				  Click here to view contest</a>"</b>
                  <br>
                  <br>
                  Best Regards,
                  <br>
                  <a style="text-decoration:none;color:#000;" href="http://www.contesthours.com/"><b>contesthours.com</b></a>
               </p>
            </td>
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