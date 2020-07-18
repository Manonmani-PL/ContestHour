<script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>
 
<div class="gap-low"></div>
<div class="minheight">
<center>
   <h3 style="color:blue"><?php echo $this->session->flashdata('msgs');?></h3>
</center>
<?php 
	$contest_category= contest_category();
   $user_id = $this->session->userdata('user_id');
   $username = $this->session->userdata('user_name');
   
   if($this->session->flashdata('design_upload')){ echo $this->session->flashdata('design_upload');}
   	//Find industry name
   	$ins = array();
   	foreach ($industry as $in){
   		$ins[$in->id]=$in->industry_name;
   	}
   	//Find designer name
   	$sign = array();
   	foreach($users_list as $ul){
   		$sign[$ul->user_id]=$ul->user_name;
   	}
   	 if(isset($error)) echo $error;
   ?>
<section>
   <div class="container" style="margin-top:15px;">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="contest-head" style="background-color:#f4f2ed; padding-top: 1px;padding-bottom: 1px;">
               <h3> 
					<?php
					  if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
						echo ucfirst($single_contest[0]->org_name);
					  else
						 echo ucfirst($single_contest[0]->contest_title);
					?>
					<span class="contest_category" style="vertical-align: middle;"><?php// echo $contest_category[$single_contest[0]->contest_type];?></span>				  
				</h3>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $time=time2string(strtotime($single_contest[0]->close_date) - time()); ?>
<div class="judging-view">
   <div class="container">
     <!--  price-btn -->
      <div class="row">
         <div class="col-sm-2 col-xs-6">
            <div class="judging-price">
				<?php 
				$select=(round($single_contest[0]->pay_option)==1)?"select":"non-select";
				$gar_type=(round($single_contest[0]->pay_option)==1)?"status-garentee":"status-nongarantee";
				?>
				<div class="<?php echo $gar_type;?>"><i style="margin-top: -44px;position: absolute;display: inline-block;font-size: 19px;color: rgb(255, 255, 255);margin-left: 7px;" class="fa fa-flag" aria-hidden="true"></i> </div>
               <b>$ <?php echo $single_contest[0]->contest_prize; ?></b>
            </div>
         </div>
         <div class="col-sm-6 col-xs-6">
			<div class="hours-entries">
               <?php if($single_contest[0]->status == 'open'){ ?>
               <h2><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h2>
               <?php 	
                  $time=time2string(strtotime($single_contest[0]->close_date) - time()); 
                  ?>
               <p>left to submit design concepts.</p>
               <?php 
			    } 
                else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1)){;?>
               <h2><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h2>
               <p>left to submit design concepts.</p>
               <?php 
			    }else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && ($user_id==$single_contest[0]->client_id)){ 
				?>
               <h2><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h2>
               <p>left to submit design concepts.</p>
               <?php } ?>

				<?php
				if(payment_status($single_contest[0]->id)==0){ ?>
					<?php 
					if($user_id == $single_contest[0]->client_id){
					?>
					<h2>Project on hold. Awaiting balance payment from your.</h2>
					<p><a href="<?php echo base_url()?>contest/contest_partial_payment/<?php echo $single_contest[0]->id;?>">Click Here</a> to pay the balance payment.</p>
					<?php
					}
					else{
					?>
					<h2>Project on hold. Awaiting balance payment from client.</h2>
					<?php				
					} 
					?>
				<?php } ?>
            </div>
         </div>
         <div class="col-sm-4 col-xs-6">
            <div class="judging-entries">
               <ul>
                  <!--
                     <li><img width="18" src="<?php echo base_url(); ?>assets/images/private-contest.png"><i class="fa fa-shield"></i> Private Contest</li>-->
                  
                  <?php if(round($single_contest[0]->upgrade_private_contest) >0):?>
                  <li class="select"><span class="private_icon"><i class="fa fa-lock"></i></span> Private Contest</li>
                  <?php 
                   endif; 
                   if(round($single_contest[0]->upgrade_featured_contest) >0):
                  ?>
                  <li class="select"><span class="featured_icon"><i class="fa fa-star"></i></span> Featured Contest</li>
                  <?php endif;?>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-sm-offset-8 col-xs-6 pull-right">
            <?php 
              $usertype = $this->session->userdata('user_type');
              if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1) && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && (!isset($winningcontest) && empty($winningcontest)))
			  {
            ?>
            <div class="">
               <a class="js-open-modal btn btn-submit" data-modal-id="popup1">FINALIST SUBMIT YOUR DESIGN</a>
            </div>
            <?php } else if(isset($usertype) && !empty($usertype) && ($usertype !='0') && (!isset($winningcontest) && empty($winningcontest)) && $time!="Time Out" && $single_contest[0]->status !="judging"){ ?>
            <div class="">
               <a class="js-open-modal btn btn-submit" data-modal-id="popup1">SUBMIT YOUR DESIGN</a>
            </div>
            <?php }
               else if($usertype=='' && $single_contest[0]->status =="open")
               { ?>
            <?php print_r($usertype); ?>
            <div class="">
               <a href="<?php echo base_url();?>Admin/loginForm " class="js-open-modal btn btn-submit">SUBMIT YOUR DESIGN</a>
            </div>
            <?php $this->session->set_flashdata('message_name', 'please Login after then submit your design'); }
               ?>	
         </div>
      <!--    POP BOX	 -->
         <div id="popup1" class="modal-box">
            <header>
               <a href="#" class="js-modal-close close">x</a>
               <h3>Please upload yours file here</h3>
            </header>
			<form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
               <div class="modal-body" style="margin-top:0px;margin-left:0px;">
			   <div class="col-md-12 offset-12">
			   
                  <input type="file" name="for_upload" id="for_upload" />
                  <div class="help-block"> Please Upload the Files Only in <br><strong style="font-weight:  900; font-size: 16px; color: #000;">(640px * 500px)</strong> Dimension</div>
                  <div id="preview1"></div>
                  <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id; ?>" />
                  <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id; ?>" />
                  <?php	
                     if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
                     {
                     ?>
                  <input type="hidden" id="final_status" name="final_status" value="<?php echo $subcheck->final_status; ?>" />
                  <?php	} ?>
				  <h5 style="margin-left:0px;text-align:left;">Condition</h5>
				  
				  <ul>
				  <li>I Have read <a href="<?php echo base_url()?>admin/codeofconduct" target="_blank" class="link">Designer code of Conduct</a></li>
				  <li>I Have read the design brief</li>
				  <li>I did not use stock or clip art</li>
				  </ul>
				 </div> 
				 
				   <div class="col-sm-6 col-xs-6">
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Email Address or any contact info in the design submission or messages</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Flooding with small changes submissions</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Requesting client's email or contact info</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Discussions to be made to client regarding fellow designers</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Stock images or free vectors or using existing logos with minor modifications</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No copying from fellow designers</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Foul Language during messaging client or fellow desingers</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Borders around the design submissions</p>
				   </div>
				  
				 
               </div>
               <footer> 
                  <input type="submit" value="Upload" onclick="return Upload()" class="btn btn-small orange_bttn" style="margin-righ:10px;" /> 
				  <a href="#" class="btn btn-small js-modal-close">Close</a> 
               </footer>
            </form>
         </div>
         <!-------------END POP BOX --------------->
      </div>
      <!---mode--->
      <?php if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'completed' )){ ?>
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               QUALIFYING STAGE
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               JUDGING STAGE
            </div>
         </div>
         <?php if(($winningcontest->designer_id == $user_id || $winningcontest->client_id==$user_id)&&($single_contest[0]->package_status<3)):?>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="open-mode-active">
               WINNER SELECTED
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               CONTEST COMPLETED
            </div>
         </div>
         <?php elseif(($winningcontest->designer_id == $user_id || $winningcontest->client_id==$user_id)&&($single_contest[0]->package_status==3)):?>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               WINNER SELECTED
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="open-mode-active">
               CONTEST COMPLETED
            </div>
         </div>
         <?php else:?>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="open-mode-active">
               CONTEST COMPLETED
            </div>
         </div>
         <?php endif;?>
      </div>
      <?php } else if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'judging' )) { ?>
      <div class="row">
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>1</span>&nbsp;OPEN
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="open-mode-active">
               <span>2</span>&nbsp;JUDGING MODE
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>3</span>&nbsp;COMPLETED
            </div>
         </div>
      </div>
      <?php } else { ?> 
      <div class="row">
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="open-mode-active">
               <span>1</span>&nbsp;OPEN
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>2</span>&nbsp;JUDGING MODE
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>3</span>&nbsp;COMPLETED
            </div>
         </div>
      </div>
      <?php } ?>
      <!--tab-->
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="tab">
				<div class="top_menu">
					<ul>
						<li><a href="<?php echo base_url()."contest/contest_brief/".$contestid?>">BRIEF</a> </li>
						<li><a href="<?php echo base_url()."contest/contest_entries/".$contestid?>"> DESIGNS <span><?php echo $count_designs;?></span> </a></li>
						<li><a href="<?php echo base_url()."contest/contest_discussions/".$contestid?>"> CLIENT UPLOADS <?php echo client_contest_discussioncount($single_contest[0]->id, $single_contest[0]->client_id);?> </a></li>
						<?php if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
						<li>
							<a style="background: #24a7db;" class="active" href="#"> DESIGN PACKAGE </a> 
						</li>
						<?php } ?>
						<?php if(($user_id==$single_contest[0]->client_id)){?>
						<li><a  class="wnext" style="float:right;" href="<?php echo base_url()."contest/contest_procedure/".$contestid?>"> Help </a></li>
						<?php } ?>
					</ul>
				</div>
            <?php if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>

                     <?php
                        $user_id = $this->session->userdata('user_id');
                        $payreq_date= $single_contest[0]->payment_reqtime;
                        $upload_diff = $single_contest[0]->upload_gap;
                        $down_diff = $single_contest[0]->down_gap;
                        $req_diff = $single_contest[0]->req_gap;
					    $release_diff= $single_contest[0]->release_gap;
						$download_time= $single_contest[0]->package_downloadtime;
                        
                        if(isset($winningcontest) && !empty($winningcontest))
                        { 
                     ?>
					 <div class="row" style="background-color:#f4f2ed; padding:10px; margin:0px;">
                        <div class="col-md-6 col-lg-6">
                           <div >DESIGN PACKAGE </div>
                        </div>
                     </div>
                     <?php if($user_id==$winningcontest->client_id){?>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <h3>Your design package : (<?php echo ucwords($single_contest[0]->contest_type);?>)</h3>
                        </div>
						
                        <div class="col-md-6 col-lg-6">						   
						   <!---First download link after first download-->
                           <?php if($single_contest[0]->package_status==1):?>	
                           <a href="#" class="downloadPackage download_pack">DOWNLOAD PACKAGE</a>
                           <?php elseif($single_contest[0]->package_status==2):?>	
						   <!--
                           <a href="<?php echo base_url()?>contest/confirmpackage/<?php echo $single_contest[0]->id?>" data-modal-id="testimony_pop" class="download_pack">CONFIRM PACKAGE</a>-->
						   
                           <a data-modal-id="testimony_pop" class="download_pack">CONFIRM PACKAGE</a>
                           <div id="testimony_pop" class="modal-box">
                              <header>
                                 <a  class="js-modal-close close" style="top: 1% !important;">&#120;</a>
                                 <h3>Testimony</h3>
                              </header>
							  <form action="<?php echo base_url()?>contest/confirmpackage" method="post" enctype="multipart/form-data">
                              <div class="modal-body" >
                                 
                                    <div class="col-md-12 col-lg-12">
									   <h3>Kindly give your testimony about the designer and the contest experience.</h3>
									   <div class="download_msgbox">
										  <input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id?>">
										  <textarea class="msg_box1" name="testimony_msg" placeholder="your testimony" autocomplete="off" style="height:250px">great designer ! thank you :)</textarea>
									   </div>
									</div>
                              </div>
                              <footer> 							  
								<input type="submit" value="SUBMIT" class="btn btn-small submit_cmt orange_bttn" id="comment-btn1">
								<a  class="btn btn-small js-modal-close">Close</a> 
							  </footer>
                              </form>
                           </div>
						   <?php endif;?>
							<!---End First download link after first download-->
							
						  <!---Permenant download link after first download-->
						   <?php if($single_contest[0]->package_status > 1):?>	
                           <a href="<?php echo base_url().'uploads/package_uploads/'.$single_contest[0]->package_path;?>" target="_blank" class="download_pack" style="margin-right:15px;">DOWNLOAD PACKAGE</a>
						   <?php endif;?>
						   <!---End Permenant download link after first download-->
                        </div>
						<!-- Default content for Client -->
						<div class="col-md-12 col-lg-12">
                           <div class="download_content">
								<p>
								<strong>Our logo package includes the following:<strong>
								<ul>
									<li>Final design in ai, eps, jpeg and pdf formats</li>
									<li>Logo design on black/white background (jpg format) ( LOGO CONEST )</li>
									<li>Logo design on Transparent background (jpg format) ( LOGO CONEST )</li>
									<li>Black &amp; White version of the logo (jpg format) ( LOGO CONEST )
									<li>A text file specifying the colors and fonts used in the design.</li>
								</ul>
								</p>
								<p>
									<strong>Note:</strong> Please leave sufficient white space around the design. The package file should be in ZIP format named LogoName.ZIP
								</p>
                           </div>
                        </div>
						<!-- end message -->
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <?php if($single_contest[0]->package_status==0):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has not uploaded the package till. Please wait for some time.</p>
                              <?php elseif($single_contest[0]->package_status>=1):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has uploaded the package for the winning design, kindly download it , check and if any queries send a message to the designer . If everything is correct please CONFIRM the package .</p>
							  <br>
							  <span>-Admin</span>
                              <?php endif;?>
                           </div>
                        </div>
						<?php 						
						if(!empty($payreq_date))
						{
						$client_message=$this->Common_model->get_record_order_by('message_table','*',array('contest_id'=>$winningcontest->contest_id,'from_id'=>$user_id),'created_time','DESC');
						
						  $down=$download_time;
							$designer_request_time=$payreq_date;
							$datetime1=new DateTime($designer_request_time);
			                $datetime2 = new DateTime();
                            $interval = $datetime1->diff($datetime2);
                            $download_time_check=$interval->format('%a');
						
							$client_msg_time="";   
						if(!empty($client_message)){
								$client_msg_check=$client_message->created_time;		 
								$datetime5=new DateTime($client_msg_check);
								$datetime6 = new DateTime($designer_request_time);
								$interval7 = $datetime5->diff($datetime6);
								$client_msg_time=$interval7->format('%a');
						}
							
						if(($single_contest[0]->package_status==2) && ($req_diff>=2) &&  ($download_time_check >=2) && (($client_msg_time >=2) || ($client_msg_time ==""))):?>	
						
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <p>Dear Client,</p>
                              <p>Kindly let us know if the project is completed or not or else the payment will be released to the winning designer.</p>
							  <br>
							  <span>-Admin</span>
                           </div>
                        </div>
                        <?php endif;
						}
                           ?>
                        <div class="lastmsg">
                           <?php 
							$winner_select_time=$single_contest[0]->winner_select_time;
                            $ms1=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id,'created_time>'=>$winner_select_time),'created_time');
                              
                                        foreach($ms1 as $msg2)
                              	 {
                              		 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg2->from_id))
                              		?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg2->subject;?></p>
                              </div>
                           </div>
                           <?php  }	?>
                        </div>
						<?php if(($single_contest[0]->package_status > 1) && ($single_contest[0]->package_status<3)):?>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_msgbox">
                              <input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                              <textarea rows="3" cols="60"  class="msg_box1 txtarea" name="winner_message" placeholder="Send your message to the designer" ></textarea>
                              <input type="submit" value="Send" class="comment-btn1 submit2" id="comment-btn1" />
                           </div>
                        </div>
						<?php /*elseif($single_contest[0]->package_status>=3):?>
						<form action="<?php echo base_url()?>contest/saveTestimony" method="post">
                        <div class="col-md-12 col-lg-12">
						   <h3>Kindly give your testimony about the designer and the contest experience.</h3>
                           <div class="download_msgbox">
                              <input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                              <textarea rows="3" cols="60"  class="msg_box1 txtarea" name="testimony_msg" placeholder="your testimony" ><?php echo contest_testimoney($single_contest[0]->id);?></textarea>
                              <input type="submit" value="Send" class="comment-btn1" id="comment-btn1" />
                           </div>
                        </div>
						</form>
						<?php */ endif;?>
                     </div>
                     <?php } 
					 else if($user_id==$winningcontest->designer_id){?>
                     <div class="row">
                        <?php if($single_contest[0]->package_status ==0){?>
                        <div class="col-md-8 col-lg-8">
                           <h3>Your design package : (<?php echo $single_contest[0]->contest_type;?>)</h3>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <a data-modal-id="depack_pop" class="uploadFile start-now">Upload Package</a>
                           <div id="depack_pop" class="modal-box">
                              <header>
                                 <a  class="js-modal-close close" style="top: 1% !important;">&#120;</a>
                                 <h3>Design Package</h3>
                              </header>
                              <div class="modal-body" >
                                 <form  action="<?php echo base_url()?>contest/upload_package" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                                    <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id;?>">
                                    <div class="fileUpload" style="border:1px solid red;display:table;float:left;" >
                                       <span class="uploadFile1">Upload</span>
                                       <input type="file" name="upload_package" class="uploadBtn upload" />
                                    </div>
									<br style="clear:both;">
									<div>
                                    <input type="submit" value="Send" class="comment-btn1 btn orange_bttn" id="comment-btn1"/></div>
                                 </form>
                              </div>
                              <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                           </div>
                        </div>
						<!-- Default content for winning designer -->
						<div class="col-md-12 col-lg-12">
                           <div class="download_content">
								<p>
								<strong>Your logo package should include the following:</strong>
								<ul>
									<li>Final design in ai, eps, jpeg and pdf formats</li>
									<li>Logo design on black/white background (jpg format) ( LOGO CONEST )</li>
									<li>Logo design on Transparent background (jpg format) ( LOGO CONEST )</li>
									<li>Black &amp; White version of the logo (jpg format) ( LOGO CONEST )
									<li>A text file specifying the colors and fonts used in the design.</li>
								</ul>
								</p>
								<p>
									<strong>Note:</strong> Please leave sufficient white space around the design. The package file should be in ZIP format named LogoName.ZIP
								</p>
                           </div>
                        </div>
						<!-- end message -->
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <p>Dear <b><?php echo ucwords(username($winningcontest->designer_id));?></b>,</p>
                              <p>Please upload the packge for <b>Wining Design</b>.</p>
							  <br>
							  <span>-Admin</span>
                           </div>
                        </div>
						<div class="lastmsg">
                           <?php 
							  $winner_select_time=$single_contest[0]->winner_select_time;
                              $ms4=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id,'created_time'=>$winner_select_time),'created_time');
                                        foreach($ms4 as $msg5)
                               {
                              	 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg5->from_id))
                              	?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg5->subject;?></p>
                              </div>
                           </div>
                           <?php  }?>
                        </div>
                        <?php 
                           } 
                           else{
                           	
                           ?>
                        <div class="col-md-6 col-lg-6">
                           <h3>Your design package : (<?php echo $single_contest[0]->contest_type;?>)</h3>
                        </div>
						<div class="col-md-3 col-lg-3">
                           <a data-modal-id="depack_pop" class="uploadFile start-now" style="margin-top: 10px;">Reupload Package</a>
                           <div id="depack_pop" class="modal-box">
                              <header>
                                 <a class="js-modal-close close" style="top: 1% !important;">&#120;</a>
                                 <h3>Design Package</h3>
                              </header>
                              <div class="modal-body">
                                 <form  action="<?php echo base_url()?>contest/upload_package" method="post" enctype="multipart/form-data">
									<input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                                    <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id;?>">
                                    <div class="fileUpload" style="border:1px solid red;display:table;float:left;">
                                       <span class="uploadFile1">Upload</span>
                                       <input type="file" name="upload_package" class="uploadBtn upload" />
                                    </div>
									<br style="clear:both;">
									<div>
                                    <input type="submit" value="Send" class="comment-btn1 btn orange_bttn" id="comment-btn1"/></div>
                                 </form>
                              </div>
                              <footer> 
									<a  class="btn btn-small js-modal-close">Close</a> 
							  </footer>
                           </div>
                        </div>
						<!--
						<pre>
						<?php //print_r($single_contest[0]);?>
						</pre>
						-->
                        <div class="col-md-3 col-lg-3">
						
						   <?php if(($single_contest[0]->package_status==1) && ($upload_diff>=2)):?>
						   <a href="<?php echo base_url()?>contest/requestpayment/<?php echo $single_contest[0]->id?>" class="download_grey">REQUEST PAYMENT</a>
						   
						   <?php elseif(($single_contest[0]->package_status==2) && ($down_diff>=2) &&($req_diff<2) && ($single_contest[0]->payment_reqtime=="0000-00-00 00:00:00")):?>	
						   <a href="<?php echo base_url()?>contest/requestpayment/<?php echo $single_contest[0]->id?>" class="download_grey">REQUEST PAYMENT</a>
						   
						   <?php elseif(($single_contest[0]->package_status==2) && ($req_diff>=2) && ($release_diff <1) && ($single_contest[0]->payment_release_reqtime=="0000-00-00 00:00:00")): ?>	
                           <a href="<?php echo base_url()?>contest/releasepayment/<?php echo $single_contest[0]->id?>" class="download_grey">RELEASE PAYMENT</a>
						   
						   <?php elseif(($single_contest[0]->package_status==2) && ($req_diff>=2) && ($release_diff <1) ): ?>	
                           <span class="download_grey">RELEASE PAYMENT</span>
						   
						   <?php elseif(($single_contest[0]->package_status ==3) && ($release_diff>=1) && ($single_contest[0]->payment_release_reqtime!="0000-00-00 00:00:00")): ?> 
						   <span class="download_pack">RELEASE PAYMENT</span>
						   
						   <?php elseif(($single_contest[0]->package_status==3) && ($single_contest[0]->payment_release_reqtime=="0000-00-00 00:00:00")):?>	
                           <span class="download_pack">RELEASE PAYMENT</span>
                           <?php endif; ?>	
						   
                        </div>
						<!-- Default content for winning designer -->
						<div class="col-md-12 col-lg-12">
                           <div class="download_content">
								<p>
								<strong>Your logo package should include the following:</strong>
								<ul>
									<li>Final design in ai, eps, jpeg and pdf formats</li>
									<li>Logo design on black/white background (jpg format) ( LOGO CONEST )</li>
									<li>Logo design on Transparent background (jpg format) ( LOGO CONEST )</li>
									<li>Black &amp; White version of the logo (jpg format) ( LOGO CONEST )
									<li>A text file specifying the colors and fonts used in the design.</li>
								</ul>
								</p>
								<p>
									<strong>Note:</strong> Please leave sufficient white space around the design. The package file should be in ZIP format named LogoName.ZIP
								</p>
                           </div>
                        </div>
						<!-- end message -->
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <?php if($single_contest[0]->package_status==0):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has not uploaded the package till. Please wait for some time.</p>
                              <?php elseif($single_contest[0]->package_status>=1):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has uploaded the package for the winning design, kindly download it , check and if any queries send a message to the designer . If everything is correct please CONFIRM the package .</p>
							  <br>
							  <span>-Admin</span>
                              <?php endif;?>
                           </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <?php if($single_contest[0]->package_status==1):?>	
                              <p>Client not downloaded the package yet.</p>
							  <br>
							  <span>-Admin</span>
                              <?php else:?>
                              <p>Client has downloaded the package.</p>
							  <br>
							  <span>-Admin</span>
                              <?php endif;?>
                           </div>
                        </div>
                        <?php if(($single_contest[0]->package_status==2) && ($req_diff>=2)):?>	
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <p>Dear Client,</p>
                              <p>Kindly let us know if the project is completed or not or else the payment will be released to the winning designer.</p>
							  <br>
							  <span>-Admin</span>
                           </div>
                        </div>
                        <?php endif;?>
                        <?php if(($single_contest[0]->package_status==3) || (($single_contest[0]->package_status==2) && ($release_diff>=1))):?>	
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content text-center">
                              <p>Payment Released.</p>
                           </div>
                        </div>
                        <?php endif;?>	
                        <div class="lastmsg">
                           <?php 
							 $winner_select_time=$single_contest[0]->winner_select_time;
                              $ms4=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id,'created_time>'=>$winner_select_time),'created_time');
                                        foreach($ms4 as $msg5)
                               {
                              	 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg5->from_id))
                              	?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg5->subject;?></p>
                              </div>
                           </div>
                           <?php  }?>
                        </div>
						
                        <div class="col-md-12 col-lg-12">
                           <div class="download_msgbox">
								<input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
								<textarea rows="3" cols="60" class="msg_box1 txtarea" name="msg_box" placeholder="Send your message to the client"></textarea>
								<input type="submit" value="Send" class="comment-btn1 submit2" id="comment-btn1"/>
                           </div>
                        </div>
                        <?php }?>
                     </div>
                     <?php }?>
					<?php } ?> 
                <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="gap"></div>
<script>
   $(document).ready(function(){
   
   var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
   
   	$('a[data-modal-id]').click(function(e) {
   		e.preventDefault();
       $("body").append(appendthis);
       $(".modal-overlay").fadeTo(500, 0.7);
       //$(".js-modalbox").fadeIn(500);
   		var modalBox = $(this).attr('data-modal-id');
   		$('#'+modalBox).fadeIn($(this).data()); 
   	});  
     
     
   $(".js-modal-close, .modal-overlay").click(function() {
       $(".modal-box, .modal-overlay").fadeOut(500, function() {
           $(".modal-overlay").remove();
       });    
   });
    
   $(window).resize(function() {
       $(".modal-box").css({
           top: ($(window).height() - $(".modal-box").outerHeight()) / 16,
           left: ($(window).width() - $(".modal-box").outerWidth()) / 4
       });
   });
    
   $(window).resize();
    
   	$(document).on('change','.uploadBtn',function () {
   		var Name = $(this).val().split( '\\' ).pop();
   		var fileName= (Name!='')?Name:"UPLOAD";
   		$(".uploadFile1").html(fileName);
   	});
   	
	$(document).on('click','.downloadPackage',function() {   
   			$.ajax({ 
   			  url: "<?php echo base_url();?>contest/packagedownload",
   			  data:{
   				  contest_id:<?php echo $single_contest[0]->id;?>
   			  },
   			  type: "POST",
   			  success: function(data){
				  var result=$.parseJSON(data);
   				  if(result.status=='success'){
					 window.open(result.file_path, '_blank');
   					 window.location="<?php echo base_url();?>contest/contest_designpackage/<?php echo $single_contest[0]->id;?>"; 
   				  }
   			  }
   		  	}); 
       });
   });
   
</script> 
<script>
   $('.checkrate').on('rating.change', function() {
             var rateval = $(this).val();			
   	var desid = $(this).attr('for');
   	
   	
   	 $.ajax({ 
   	  url: "<?php echo base_url();?>Contest/design_rate",
   	  data:{
   		  designid:desid,
   		  rateval:rateval
   		  },
   	  type: "POST",
   	  success: function(data){
   		
   	  }
     	});			
         });
   
   $('.setrank').on('change', function() {
             var rankval = $(this).val();			
   	var desid = $(this).attr('for');
   	
    	 $.ajax({ 
   	  url: "<?php echo base_url();?>Contest/design_rank",
   	  data:{
   		  designid:desid,
   		  rankval:rankval
   		  },
   	  type: "POST",
   	  success: function(data){
   		
   	  }
     	}); 				
         });
   
   $(document).on('click','.like_design',function() {
   	var user_id=<?php echo (!empty($user_id))? $user_id:"''";?>;
   	var desid = $(this).attr('data-id');
   	var old =$(this).find('.lcount').html();
   	var target=$(this);
   				
   	if(user_id!=''){
   		$.ajax({ 
   		  url: "<?php echo base_url();?>contest/design_like",
   		  data:{
   			  designid:desid,
   			  user_id: user_id
   		  },
   		  type: "POST",
   		  success: function(data){
   			if(data!='')
   			{
   				var ne=parseInt(old)+1;
   				target.find('.lcount').html(ne);
   				$(this).attr('data-id');
   				target.attr('disabled','disabled');
   				
   			}
   		  } 
   		});	
   	}else{
   		alert("please login to like.");
   	}			
     });		
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/imagepreview/src/imagepreview.js"></script>
<script type="text/javascript">
   jQuery(function($) { 
       $('#preview1').imagepreview({
           input: '[name="for_upload"]',       
           preview: '#preview1'
       });
   });
   
   $(document).ready(function(){
        $(document).on('keyup','.userdesign_id',function(){
   		var email = $(this).val();
   		
   	if(email)
    {
   	var user_id=<?php echo (!empty($user_id))? $user_id:"''";?>;
     $.ajax({
     type: 'post',
     url: "<?php echo base_url();?>contest/design_verification",
     data: {
      design_id:email,
   	designer_id:user_id,
   	contest_id:<?php echo $single_contest[0]->id ?>
     },
     success: function (response) {
      if(response==1)	
      {
   	 $(".check22").html("<span style='color:#00FF00'>valid</span>");
   	$(function(){
     $("input.myBtn2").attr("disabled", false);
   });
   
   }
      else
      {
    $(".check22").html("<span style='color:#cc0000'>invalid designid:</span>");
   		$(function(){
     $("input.myBtn2").attr("disabled",true);
   });
   	
   	 }
     }
     });
    }
   		
       });
   });
</script> 
<script type="text/javascript">
   $("#design_upload").submit( function( e ) {
   	
    var form = this;
      e.preventDefault(); //Stop the submit for now
                                  //Replace with your selector to find the file input in your form
      var fileInput = $(this).find("input[type=file]")[0],
          file = fileInput.files && fileInput.files[0];
   
      if( file ) {
          var img = new Image();
   
          img.src = window.URL.createObjectURL( file );
   
          img.onload = function() {
              var width = img.naturalWidth,
                  height = img.naturalHeight;
   
              window.URL.revokeObjectURL( img.src );
   
              if( width == 640 && height == 500 ) {
                  form.submit();
              }
              else {
                  //fail
   			  alert("Uploaded image has valid Height and Width.");
   			return false;
              }
          };
      }
      else { //No file was input or browser doesn't support client side reading
          form.submit();
      }	
   });
</script>
<script>
   $(document).ready(function(){
   	
   	$(".report_form").hide();
   	
   	$(".rep").click(function(){
   		$(".report_form").hide();
   	});
   	
   	$(".radiooption").change(function(){
   		$(".report_form").show();
   		$(".report_option").hide();
   	});
   	$(".close2").click(function(){
   	 	$(".report_option").show();
   		$(".fname").find('input:radio').removeAttr('checked').removeAttr('selected');
   		$(".fname").trigger('reset');
   		$(".check22").html("<span></span>");
   		$("input.myBtn2").attr("disabled",false);
   	
   	});
   		
   	$(".back").click(function(){
   		$(".report_form").hide();
   		$(".fname").find('input:radio').removeAttr('checked').removeAttr('selected');
   		$(".fname").trigger('reset');
   		$(".check22").html("<span></span>");
   		$("input.myBtn2").attr("disabled",false);
   		$(".report_option").show();
   	});
   	
   });     
</script>
<?php if(!empty($winningcontest)):?>
<script>
   $(document).ready(function() {
   			$(".submit2").click(function() {
                   var msg = $(".txtarea").val();
                   var values = $(".check_condition").val();
                   var usertypes = "<?php echo $this->session->userdata('user_type'); ?>";
                   if (usertypes == 0){
                       var from1 = <?php echo $winningcontest->client_id; ?>;
                       var to = <?php echo $winningcontest->designer_id;?>;
                   }
				   else{
                       var from1 = <?php echo $winningcontest->designer_id; ?>;
                       var to = <?php echo $winningcontest->client_id; ?>;
                   }
				   
                   $.ajax({
                       type: 'post',
                       url: "<?php echo base_url();?>contest/message",
                       data: {
                           from2: from1,
                           to1: to,
                           contest_id: <?php echo $winningcontest->contest_id;?>,
                           subject: msg
                       },
					   beforeSend: function() {
						   $('.submit2').attr('disabled','disabled');
					   },
                       success: function(response) {
                           if (usertypes == 0) {
							   $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
   								$(".txtarea").val("");				
									
   						
   						} else {
							 $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
   							$(".txtarea").val("");
                           }
						   
						   $('.submit2').removeAttr('disabled');
   						
                       }
                   });
               });
   });
   
</script>
<?php endif;?>