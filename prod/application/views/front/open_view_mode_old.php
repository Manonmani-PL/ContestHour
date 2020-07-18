<script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>

<div class="gap-low"></div>

<div class="minheight">
				<?php 
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
<div class="container" style="background-color:#f4f2ed; margin-top:15px;">
	<div class="row">
    	<div class="col-md-4 col-lg-4">
        	<div class="contest-head">
            	<h3> <?php
						if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
							echo ucfirst($single_contest[0]->org_name);
						else
							 echo ucfirst($single_contest[0]->contest_title);
					?> </h3>
            </div>
        </div>
      </div>
</div>
</section>

<div class="judging-view">
	<div class="container" style="border:1px solid rgba(0,0,0,0.1);">
    <!--price-btn--->
    	<div class="row">
            <div class="col-sm-2 col-xs-6">
				<div class="judging-price">
				    <b>$ <?php echo $single_contest[0]->contest_prize; ?></b>
                </div>
            </div>
            <div class="col-sm-6 col-xs-6">
				<div class="hours-entries">
					<?php if($single_contest[0]->status == 'open' || $single_contest[0]->status == 'draft' ){ ?>
						<h2><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h2>
                        <p>left to submit design concepts.</p>								
					<?php } ?>
                    </div>
            </div>    
			<div class="col-sm-4 col-xs-6">
                <div class="judging-entries">
						<ul>
						<!--
						<li><img width="18" src="<?php echo base_url(); ?>assets/images/private-contest.png"><i class="fa fa-shield"></i> Private Contest</li>-->
						
						<li class="<?php echo (round($single_contest[0]->upgrade_private_contest) >0)?"select":'';?>"><span><i class="fa fa-shield"></i></span> Private Contest</li>
                        <li class="<?php echo (round($single_contest[0]->pay_option)==1)?"select":'';?>"><span><i class="fa fa-check"></i></span> Guaranteed Contest</li>
						<li class="<?php echo (round($single_contest[0]->upgrade_featured_contest) >0)?"select":'';?>"><span><i class="fa fa-star"></i></span> Featured Contest</li>
						</ul>		
                    </div>
            </div>
        </div>
		<div class="row">
                <div class="col-sm-4 col-sm-offset-8 col-xs-6 pull-right">
				
				<?php 
				$usertype = $this->session->userdata('user_type');
				
				 if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1) && (!isset($winningcontest) && empty($winningcontest)))
					{
						?>
				    <div class="">
                    	<a class="js-open-modal btn btn-submit" data-modal-id="popup1">FINALIST SUBMIT YOUR DESIGN</a>
                    </div>			
			    <?php } else if(isset($usertype) && !empty($usertype) && ($usertype !='0') && (!isset($winningcontest) && empty($winningcontest)) ){ ?>
                	<div class="">
                    	<a class="js-open-modal btn btn-submit" data-modal-id="popup1">SUBMIT YOUR DESIGN</a>
                    </div>
				<?php } ?>	
                </div>
				
			   <!-------------POP BOX --------------->	
                <div id="popup1" class="modal-box">
                      <header> <a href="#" class="js-modal-close close">X</a>
                        <h3>Please upload yours file here</h3>
                      </header>
                      <div class="modal-body">
                      
                       	<form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
                       		<input type="file" name="for_upload" id="for_upload" />
							<div class="help-block"> Please Upload the Files Only in (320px * 250px) Dimension</div>
							<div id="preview1"></div>
							   
                            <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id; ?>" />
                           
						<?php	
						
						if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
						{
						?>
						<input type="hidden" id="final_status" name="final_status" value="<?php echo $subcheck->final_status; ?>" />
                   <?php	} ?>
					
						   </br>
                            <input type="submit" value="Upload" onclick="return Upload()" />
                       	</form>
                       
                      </div>
                      <footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
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
                	<ul tabbed>
	                 <li>
                     <div>BRIEF</div>
                     
                   <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-name_desc">
                        	<p>NAME & DESCRIPTION</p>
                        </div>
                     </div>
                     <div class="col-md-8 col-sm-6 col-xs-12">
                     	<div class="d-name_desc_detail">
                        	<?php
							
								$many = unserialize($single_contest[0]->extras);
								
								
								
								if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign") {?>								
                        		<b>COMPANY TITLE (LOGO NAME)</b>
                            <?php } else {?>
							 	<b>CONTEST TITLE</b>
							<?php }?>
							<p>
                            <?php
								if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
									echo $single_contest[0]->org_name;
								else
									 echo $single_contest[0]->contest_title;
							?>
                            </p>

                           <b>PLEASE DESCRIBE WHAT YOUR BUSINESS DOES IN ONE SENTENCE</b>
						   <p><?php echo $single_contest[0]->business_description; ?></p>

                          <b>INDUSTRY</b>
                           <p><?php echo $ins[$single_contest[0]->industry]; ?></p>
						  <?php if($single_contest[0]->contest_type=="logodesign"){ ?>
						  <b>TAGLINE</b>
                          <?php } else {?>
                          <b>BACKGROUND INFO</b>
                          <?php } ?>
				          <p>
                          <?php if($single_contest[0]->contest_type=="logodesign") 
						  	 	echo $many['tagline'];
							  else
							  	echo $single_contest[0]->background_info;
							  ?>
                          </p>
                          
                        </div>
                      </div>
                     </div>   
                        
                       
                      
                     
                  <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-style_desc">
                        	<p>
                            <?php
							
						
							$data = @unserialize($single_contest[0]->visual_style);
							if ($data !== false) 
								$vis = unserialize($single_contest[0]->visual_style);		

							
							
							if($single_contest[0]->contest_type == "logodesign") 
                            	echo "STYLE SLIDERS";
							else
								echo "VISUAL STYLE";	
							?>
                            </p>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-6 col-xs-12">
                     	<div class="d-style_desc_detail">
                        <?php if($single_contest[0]->contest_type=="logodesign") { ?>
						
                        <p><span>FEMININE</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly value="<?php echo $many['slider1']; ?>" /></span>&nbsp;&nbsp;<span>MASCULINE</span></p>
                        <p><span>SIMPLE</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider2']; ?>" /></span>&nbsp;&nbsp;<span>COMPLEX</span></p>
                        <p><span>MODEST</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider3']; ?>" /></span>&nbsp;&nbsp;<span>LUXURY</span></p>
                        <p><span>PLAYFUL</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider4']; ?>" /></span>&nbsp;&nbsp;<span>SERIOUS</span></p>
                        <p><span>MODERN</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider5']; ?>" /></span>&nbsp;&nbsp;<span>VINTAGE</span></p>
                        <p><span>SPORTY</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider6']; ?>" /></span>&nbsp;&nbsp;<span>ELEGANT</span></p>
                          

						  <?php } elseif($single_contest[0]->contest_type=="webdesign"){ ?>
                            
                                    <b>ORG NAME</b>
                                
                                    <p><?php if(isset($vis) && !empty($vis)) { echo $vis['org_name']; } ?></p>
                              
                                    <b>WEBSITE ADDRESS</b>
                                
                                    <p><?php if(isset($vis) && !empty($vis)) { echo $vis['website_address']; } ?></p>
                                 
                            <?php } elseif($single_contest[0]->contest_type=="tshirtdesign"){ ?>                            
                             <b>SPECIFIC COLOR</b>
                           	 <p><?php if(isset($vis) && !empty($vis)) { echo $vis['specific_color']; } ?></p>

                             <?php } else {?>
                             
                                    <b>VISUAL STYLE</b>
                                
                                    <p><?php echo $single_contest[0]->visual_style;?></p>
                                 
                             <?php } ?>
                         </div>
                      </div>
                     </div>
                     
                     <?php if($single_contest[0]->contest_type=="logodesign") { ?>
                     <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-color_desc">
                        	<p>COLORS</p>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-6 col-xs-12">
                     	<div class="d-style_desc_detail">
                        	<button style="background-color:#<?php echo $many['color1'];?>" class="r-color"></button>
                            <button style="background-color:#<?php echo $many['color2'];?>" class="r-color"></button>
                            <button style="background-color:#<?php echo $many['color3'];?>" class="r-color"></button>
                            <button style="background-color:#<?php echo $many['color4'];?>" class="r-color"></button>
                        	
                         </div>
                      </div>
                     </div>
                     <?php } elseif($single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="businesscarddesign") { 
					 
					 $chother = @unserialize($single_contest[0]->other_details); 
					 if( $chother !== false)
					 $other = unserialize($single_contest[0]->other_details); 
					 
					 ?>
                     <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-idea_desc">
                        	<p>OTHER DETAILS</p>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-6 col-xs-12">
                     	<div class="d-idea_desc_detail">
                        	<p><?php if(isset($chother) && !empty($chother)){ echo $other['designersinfo'];} ?></p>
                         </div>
                      </div>
                     </div> 
                     <?php } else {?>
                     <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-idea_desc">
                        	<p>OTHER DETAILS</p>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-6 col-xs-12">
                     	<div class="d-idea_desc_detail">
                        	<p><?php echo $single_contest[0]->other_details; ?></p>
                         </div>
                      </div>
                     </div>
                     <?php } ?>
                    <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-idea_desc">
                        	<p>IDEAS</p>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-6 col-xs-12">
                     	<div class="d-idea_desc_detail">
                        	<p><?php
							if($single_contest[0]->contest_type == "logodesign") 
								echo $many['ideas']; 
							else if(isset($vis) && !empty($vis))
								echo $vis['ideas'];
							?></p>
                         </div>
                      </div>
                     </div>    
                                        
                     <div class="row">  
                     <div class="col-md-4 col-sm-6 col-xs-12">
                     	<div class="d-attach_desc">
                        	<p>FILE ATTACHED</p>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-6 col-xs-12">
                     	<div class="d-logo_desc_detail">
                        	<a target="_blank" download class="js-open-modal btn" href="<?php echo base_url(); ?>uploads/brief/<?php echo $single_contest[0]->filename; ?>" ><?php echo $single_contest[0]->filename; ?></a>
                            
                         </div>
                      </div>
                      
                     
                      
                     </div>
                  
                     <div id="popup1" class="modal-box">
                      <header> <a href="#" class="js-modal-close close">×</a>
                        <h3><?php echo $single_contest[0]->filename; ?></h3>
                      </header>
                      <div class="modal-body">
                       <img src="<?php echo base_url();?>uploads/brief/<?php echo $single_contest[0]->filename ?>" width="100%"/>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>
                     <!------------------------------------->
                  
                     </li>
                     
                     <li>
                     <div>DESIGNS (<?php echo $count_designs;?>)</div>
					 
					 <?php
						$user_id = $this->session->userdata('user_id');
						
						if(isset($winningcontest) && !empty($winningcontest)){ 
					?>
				 
				 		
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design">Winning Contest </div>
                                
						</div>
					</div>
								
					<div class="row">
                            <?php 
							
							if(isset($winningcontest) && !empty($winningcontest))
							 {
							
									$prvcomments = design_comment($winningcontest->design_id);
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">								
                                # <?php echo $winningcontest->design_id;?>  <!-- by <a href="#"><?php echo $sign[$winningcontest->designer_id];?></a>-->

                                    <div class="logo_image">
									
									<img src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $winningcontest->design_name;?>" width="100%" />
									<span class="logo-status"><img src="<?php echo base_url(); ?>assets/icons/award.png">
									</div>
                                   
								   <div class="user_review">
                          

										
                                    </div>
								
                                 </div>   
                                </div>
								
								
									 <div class="col-sm-8 col-xs-4">
									 <div>
										<?php if(isset($single_contest[0]->win_comments) && empty($single_contest[0]->win_comments)){
											
												

											if($user_id == $winningcontest->client_id)
											{ 
										?>
									 
									 <div>
										 <label>Comments</label>
										 <form action="<?php echo base_url();?>contest/contest_wincomment" name="windesign_upload" method="post" enctype="multipart/form-data">
		 
										   <textarea name="win_comments" id="win_comments" style="width: 723px; height: 106px;" class="msg_box" cols='20' rows="20" ></textarea>
										
											<input type="hidden" name="wincontestid" value="<?php echo $single_contest[0]->id; ?>" />
											<input type="hidden" name="windesignid" value="<?php echo $winningcontest->design_id; ?>" />
                           
										 <input class="precomm" type="submit" value="SUBMIT" />
										</form>	
					                  </div>
									  
											<?php } } else { ?>
										
										<div>
											<label>Comments Given By Client</label>
											<p><?php echo $single_contest[0]->win_comments; ?></p>
										</div>
										
										<?php } ?>
									 </div>
                                      </div>
									  
									  
									  
							 <?php }  ?>
    </div>
	
	<br><br>.
				<?php }
					 ?>
					 <?php 
					if(isset($subfinaldesigns) && !empty($subfinaldesigns))
							 {
						?>
				
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design"> Finalist Submited Designers</div>
                                
						</div>
					</div>
								
					<div class="row">
                            <?php 
							
							if(isset($subfinaldesigns) && !empty($subfinaldesigns))
							 {
								foreach($subfinaldesigns as $subfdes) { 
									$prvcomments = design_comment($subfdes->design_id);
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">								
                                # <?php echo $subfdes->design_id;?> <!-- by <a href="#"><?php echo $sign[$subfdes->designer_id];?></a> -->

                                    <div class="logo_image">
									
										<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $subfdes->client_id) && ($user_id != $subfdes->designer_id) ) { ?>
									<img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									
									
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  /></div>
                                   
									
									<?php } ?>
									
								   <div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<a></a>
   
                                        </div>

										
                                    </div>
                                 </div>   
                                </div>
								
								  <div class="col-sm-4 col-xs-12">
                                        
										 	
											
                                        </div>
										<div class="col-sm-48 col-xs-12">
											
										<?php if($user_id == $subfdes->client_id){ ?>
											
											<div class="col-md-3" >	<a  for='<?php echo $subfdes->design_id;  ?>' data-modal-id="subfinpopup<?php echo $subfdes->design_id; ?>" >Choose Winner</a>
											</div>	
											
											
										<?php } ?>

											<div class="col-md-3" >
											
										<?php 
											if(($user_id == $subfdes->client_id) || (($user_id == $subfdes->designer_id) && (count($prvcomments) > 0))){
											?>
											<?php echo count($prvcomments); ?> &nbsp;<a  style='color:#f14b15'  data-modal-id="finpopup<?php echo $subfdes->design_id; ?>" >Comments</a>
									
											<?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<a style='color:#f14b15' >Comments</a>
									 <?php } ?>
											</div>
											</div>
											
											
				<div id="subfinpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                <header> 
				   <a class="js-modal-close close" style="top: 1% !important;">×</a>
                   <h3>Choose Winner</h3>
                </header>
				<form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                      
                      <div class="modal-body">
                            <label>Do You Want Choose As A Winner ?</label>    
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                            </br>                       
                      </div>
                   <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                  </form>
			</div>
			
			
			 <div id="finpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                      <header> 
					  <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h3>Comments</h3>
                      </header>
                      <div class="modal-body">
                      
					   <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>" /></div>
                            
					  <?php
						$finalprvcomments = design_comment($subfdes->design_id);
						
					  if(isset($finalprvcomments) && !empty($finalprvcomments)) { 
								foreach($finalprvcomments as $tmp3)
								{
									
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp3->createdname; ?></b> <?php  if($tmp3->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp3->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp3->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                            <input type="hidden" name="designerid" value="<?php echo $subfdes->designer_id; ?>" />
                            </br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>
					
							 <?php } } ?>
    </div>
	
	<br><br>
	
							 <?php } ?>
	
	
					<?php 
					if(isset($finaldesigns) && !empty($finaldesigns))
							 {
						?>
				
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design">The Finalist Designers</div>
                                
						</div>
					</div>
								
					<div class="row">
                            <?php 
							
							if(isset($finaldesigns) && !empty($finaldesigns))
							 {
								foreach($finaldesigns as $fdes) { 
									$prvcomments = design_comment($fdes->design_id);
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">								
                                # <?php echo $fdes->design_id;?> <!-- by <a href="#"><?php echo $sign[$fdes->designer_id];?></a> -->

                                    <div class="logo_image">
									
									<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $fdes->client_id) && ($user_id != $fdes->designer_id) ) { ?>
									
									<img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									<span class="logo-status"><img src="<?php echo base_url(); ?>assets/icons/medal-01.png"></span>
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
									
									<?php } ?>
								  <div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<a></a>
   
                                        </div>

										
                                    </div>
                                 </div>   
                                </div>
								
								  <div class="col-sm-4 col-xs-12">
                                        
										 	
											
                                        </div>
										<div class="col-sm-48 col-xs-12">
											
										<?php if($user_id == $fdes->client_id){ ?>
											
											<div class="col-md-3" >	<a  for='<?php echo $fdes->design_id;  ?>'  data-modal-id="apopup<?php echo $fdes->design_id; ?>" >Choose Winner</a>
											</div>	
											
											
										<?php } ?>

											<div class="col-md-3" >
											
										<?php 
											if(($user_id == $fdes->client_id) || (($user_id == $fdes->designer_id) && (count($prvcomments) > 0))){
											?>
											<?php echo count($prvcomments); ?> &nbsp;<a  style='color:#f14b15'  data-modal-id="popup<?php echo $fdes->design_id; ?>" >Comments</a>
									
											<?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<a style='color:#f14b15' >Comments</a>
									 <?php } ?>
											</div>
											</div>
							 <?php } } ?>
    </div>
	
	<br><br>
	
							 <?php } ?>
	
                        <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        	
								
                            	<div class="col-md-6 col-lg-6">
                                	<div class="submit-design">Designs Submited By Designers</div>
                                </div>
                                <div class="col-md-3 col-lg-3"></div>
                                <div class="col-md-3 col-lg-3">
                                	<div class="design-rate">
                                    	<!--<select size="1" class="s_rane">
                                        <option>Rank</option>
                                        <option>Star Rating</option>
                                        <option>Posted Rating</option>
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                            <?php 
							$dno=0;
							foreach($designs as $des) { 
								$dno++;
								$prvcomments = design_comment($des->design_id);											
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">
								
                                	<div class="logo_d_name">
									
								<?php if($user_id == $des->client_id){ ?>	
								<!--<select name='desrank' class='setrank' for="<?php echo $des->design_id; ?>" >
								<option value='0'>Rank</option>
								<?php 
									for($i=1; $i<=10; $i++)
									{	
										if(isset($des->design_rank) && !empty($des->design_rank) &&($des->design_rank == $i))
											echo "<option selected='selected' value='".$i."'>".$i."</option>";						
										else
											echo "<option value='".$i."'>".$i."</option>";						
									
									}
								?></select>-->
								<?php } else if(isset($des->design_rank) && !empty($des->design_rank))
								{ echo 'Rank-'.$des->design_rank; } ?> 
									# <?php echo $dno;?> by <a href="#"> <?php echo $sign[$des->designer_id];?></a></div>
                                    <div class="logo_image">
									<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $des->client_id) && ($user_id != $des->designer_id) ) { ?>
									<img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  />
									<?php } ?>
									
									</div>
                                    
									<div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<div class="star-rating">
												
                                                	 <input for="<?php echo $des->design_id; ?>" id="input-21b"  <?php 
														
													 if($user_id != $des->client_id){ echo 'readonly'; } ?> value="<?php echo $des->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                                </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                        	<div class="commend">										
											<?php 
											if(($user_id == $des->client_id) || (($user_id == $des->designer_id) && (count($prvcomments) > 0))){
											?>
											<?php echo count($prvcomments); ?> &nbsp;<a  data-modal-id="popup<?php echo $des->design_id; ?>" >Comments</a>
									
											<?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<a href="#" >Comments</a>
									 <?php } ?>
											</div>
                                        </div>
										<?php if($user_id == $des->client_id){ ?>
											<div class="col-sm-48 col-xs-12">
											
											<div class="col-md-6" >	<a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>" >Choose Winner</a>
											</div>	
											
											 <div class="col-md-6" >
											 <?php if(isset($ctfinaldes) && ($ctfinaldes < 2)){ ?>
												<a for='<?php echo $des->design_id;  ?>'  data-modal-id="bpopup<?php echo $des->design_id; ?>" >Choose Finalist</a>
											 <?php } ?>
											</div>
											 
											</div>
										<?php } ?>	
                                    </div>
									<div id="demo" style="float:right;">
    <div class="wrapper">
        <div class="content">
            <ul>
                <a href="#"><li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li></a>
                <a href="#"><li><i class="fa fa-heart" aria-hidden="true"></i> Like</li></a>
			    <a href="#"><li><i class="fa fa-download" aria-hidden="true"></i> Withdraw</li></a>
            </ul>
        </div>
        <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
    </div>
    </div>
                                 </div>   
                                </div>
								
								
								   <!---------------POP BOX--------------->
					 

					 
			<div id="bpopup<?php echo $des->design_id; ?>" class="modal-box">
                <header> 
				   <a class="js-modal-close close" style="top: 1% !important;">×</a>
                   <h3>Choose A Finalist</h3>
                </header>
				<form action="<?php echo base_url();?>contest/final_contest" name="design_upload" method="post" enctype="multipart/form-data">
                      
                      <div class="modal-body">
                            <label>Do You Want Choose As A Finalist ?</label>    
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                            </br>                       
                      </div>
                   <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Finalist" /> </footer>
                  </form>
			</div>
			
			
			<div id="apopup<?php echo $des->design_id; ?>" class="modal-box">
                <header> 
				   <a class="js-modal-close close" style="top: 1% !important;">×</a>
                   <h3>Choose Winner</h3>
                </header>
				<form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                      
                      <div class="modal-body">
                            <label>Do You Want Choose As A Winner ?</label>    
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                            </br>                       
                      </div>
                   <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                  </form>
			</div>

					  <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                      <header> 
					  <a class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h3>Comments</h3>
                      </header>
                      <div class="modal-body">
                      
					   <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                            
					  <?php
							
					  if(isset($prvcomments) && !empty($prvcomments)) { 
								foreach($prvcomments as $tmp2)
								{
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp2->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                              <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
							</br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>
					
					
					  <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                      <header> 
					  <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h3>Comments</h3>
                      </header>
                      <div class="modal-body">
                      
					   <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                            
					  <?php
							
					  if(isset($prvcomments) && !empty($prvcomments)) { 
								foreach($prvcomments as $tmp2)
								{
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp2->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                            <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                            </br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>

					
                     <!------------------------------------->
					 
                                <?php } ?>
                                
                            </div>
                      </li>
                      
					    
					  <li>
                     <div>Enteries (<?php echo $count_designs; ?>)</div>
					 
					 <?php
						$user_id = $this->session->userdata('user_id');
						
					 if(isset($winningcontest) && !empty($winningcontest) )
					 { ?>
				 
				 		
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design">WINNING DESIGN </div>
                                
						</div>
						
					</div>
							<div class="col-md-4 col-lg-4">
								 <div class="logo_design_model">
								
                                	<div class="logo_d_name" style="text-align:right;">
									
								<?php if($user_id == $des->client_id){ ?>	
								<!--<select name='desrank' class='setrank' for="<?php echo $des->design_id; ?>" >
								<option value='0'>Rank</option>
								<?php 
									for($i=1; $i<=10; $i++)
									{	
										if(isset($des->design_rank) && !empty($des->design_rank) &&($des->design_rank == $i))
											echo "<option selected='selected' value='".$i."'>".$i."</option>";						
										else
											echo "<option value='".$i."'>".$i."</option>";						
									
									}
								?></select>-->
								<?php } else if(isset($des->design_rank) && !empty($des->design_rank))
								{ echo 'Rank-'.$des->design_rank; } ?> 
									# <?php echo $des->design_id;?> <!-- by <a href="#"><?php echo $sign[$des->designer_id];?></a> --> </div>
                                    <div class="logo_image" >
									<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $des->client_id) && ($user_id != $des->designer_id) ) { ?>
									<img align="center" class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  />
									<?php } ?>
									
									</div>
                                    
									<div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<div class="star-rating">
												
                                                	 <input for="<?php echo $des->design_id; ?>" id="input-21b"  <?php 
														
													 if($user_id != $des->client_id){ echo 'readonly'; } ?> value="<?php echo $des->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                                </div>
                                        </div>
                                    
										<?php if($user_id == $des->client_id){ ?>
											<div class="col-sm-48 col-xs-12">
											
											<div class="col-md-6" >	<a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>" >Choose Winner</a>
											</div>	
											
											 <div class="col-md-6" >
											 <?php if(isset($ctfinaldes) && ($ctfinaldes < 2)){ ?>
												<a for='<?php echo $des->design_id;  ?>'  data-modal-id="bpopup<?php echo $des->design_id; ?>" >Choose Finalist</a>
											 <?php } ?>
											</div>
											 
											</div>
										<?php } ?>	
                                    </div>
                                 </div>   
								 
								 </div>
					<div class="col-md-7 col-lg-7">
					<div class="client-description">
						<p><b><?php echo username($des->client_id);?></b> has selected <b><?php echo username($des->designer_id);?></b> as the winner from <b><?php echo $count_designs; ?></b> designers </p>
					</div>
					</div>
	
	<br><br style="clear:both;">
				<?php }
					 ?>
					 <?php 
					if(isset($subfinaldesigns) && !empty($subfinaldesigns))
							 {
						?>
				
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design"> Finalist Submited Designers</div>
                                
						</div>
					</div>
								
					<div class="row">
                            <?php 
							
							if(isset($subfinaldesigns) && !empty($subfinaldesigns))
							 {
								foreach($subfinaldesigns as $subfdes) { 
									$prvcomments = design_comment($subfdes->design_id);
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">								
                                # <?php echo $subfdes->design_id;?> <!-- by <a href="#"><?php echo $sign[$subfdes->designer_id];?></a> -->

                                    <div class="logo_image">
									
										<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $subfdes->client_id) && ($user_id != $subfdes->designer_id) ) { ?>
									<img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									
									
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  /></div>
                                   
									
									<?php } ?>
									
								   <div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<a></a>
   
                                        </div>

										
                                    </div>
                                 </div>   
                                </div>
								
								  <div class="col-sm-4 col-xs-12">
                                        
										 	
											
                                        </div>
										<div class="col-sm-48 col-xs-12">
											
										<?php if($user_id == $subfdes->client_id){ ?>
											
											<div class="col-md-3" >	<a  for='<?php echo $subfdes->design_id;  ?>' data-modal-id="subfinpopup<?php echo $subfdes->design_id; ?>" >Choose Winner</a>
											</div>	
											
											
										<?php } ?>

											<div class="col-md-3" >
											
										<?php 
											if(($user_id == $subfdes->client_id) || (($user_id == $subfdes->designer_id) && (count($prvcomments) > 0))){
											?>
											<?php echo count($prvcomments); ?> &nbsp;<a  style='color:#f14b15'  data-modal-id="finpopup<?php echo $subfdes->design_id; ?>" >Comments</a>
									
											<?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<a style='color:#f14b15' >Comments</a>
									 <?php } ?>
											</div>
											</div>
											
											
				<div id="subfinpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                <header> 
				   <a class="js-modal-close close" style="top: 1% !important;">×</a>
                   <h3>Choose Winner</h3>
                </header>
				<form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                      
                      <div class="modal-body">
                            <label>Do You Want Choose As A Winner ?</label>    
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                            </br>                       
                      </div>
                   <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                  </form>
			</div>
			
			
			 <div id="finpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                      <header> 
					  <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h3>Comments</h3>
                      </header>
                      <div class="modal-body">
                      
					   <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>" /></div>
                            
					  <?php
						$finalprvcomments = design_comment($subfdes->design_id);
						
					  if(isset($finalprvcomments) && !empty($finalprvcomments)) { 
								foreach($finalprvcomments as $tmp3)
								{
									
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp3->createdname; ?></b> <?php  if($tmp3->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp3->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp3->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                            <input type="hidden" name="designerid" value="<?php echo $subfdes->designer_id; ?>" />
                            </br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>
					
							 <?php } } ?>
    </div>
	
	<br><br>
	
							 <?php } ?>
	
	
					<?php 
					if(isset($finaldesigns) && !empty($finaldesigns))
							 {
						?>
				
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design">The Finalist Designers</div>
                                
						</div>
					</div>
								
					<div class="row">
                            <?php 
							
							if(isset($finaldesigns) && !empty($finaldesigns))
							 {
								foreach($finaldesigns as $fdes) { 
									$prvcomments = design_comment($fdes->design_id);
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">								
                                # <?php echo $fdes->design_id;?> <!-- by <a href="#"><?php echo $sign[$fdes->designer_id];?></a> -->

                                    <div class="logo_image">
									
									<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $fdes->client_id) && ($user_id != $fdes->designer_id) ) { ?>
									
									<img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									<span class="logo-status"><img src="<?php echo base_url(); ?>assets/icons/medal-01.png"></span>
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
									
									<?php } ?>
								  <div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<a></a>
   
                                        </div>

										
                                    </div>
                                 </div>   
                                </div>
								
								  <div class="col-sm-4 col-xs-12">
                                        
										 	
											
                                        </div>
										<div class="col-sm-48 col-xs-12">
											
										<?php if($user_id == $fdes->client_id){ ?>
											
											<div class="col-md-3" >	<a  for='<?php echo $fdes->design_id;  ?>'  data-modal-id="apopup<?php echo $fdes->design_id; ?>" >Choose Winner</a>
											</div>	
											
											
										<?php } ?>

											<div class="col-md-3" >
											
										<?php 
											if(($user_id == $fdes->client_id) || (($user_id == $fdes->designer_id) && (count($prvcomments) > 0))){
											?>
											<?php echo count($prvcomments); ?> &nbsp;<a  style='color:#f14b15'  data-modal-id="popup<?php echo $fdes->design_id; ?>" >Comments</a>
									
											<?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<a style='color:#f14b15' >Comments</a>
									 <?php } ?>
											</div>
											
											</div>
											
							 <?php } } ?>
							 
    </div>
	
	<br><br>
	
							 <?php } ?>
	
                        <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        	
								
                            	<div class="col-md-6 col-lg-6">
                                	<div class="submit-design">Designs Submited By Designers</div>
                                </div>
                                <div class="col-md-3 col-lg-3"></div>
                                <div class="col-md-3 col-lg-3">
                                	<div class="design-rate">
                                    	<!--<select size="1" class="s_rane">
                                        <option>Rank</option>
                                        <option>Star Rating</option>
                                        <option>Posted Rating</option>
                                        	
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                            
                    <div class="row">
                            <?php foreach($designs as $des) { 
							$prvcomments = design_comment($des->design_id);
																		
																				
											
							?>
                            	<div class="col-md-4 col-lg-4">
                                <div class="logo_design_model">
								
                                	<div class="logo_d_name">
									
								<?php if($user_id == $des->client_id){ ?>	
								<!--<select name='desrank' class='setrank' for="<?php echo $des->design_id; ?>" >
								<option value='0'>Rank</option>
								<?php 
									for($i=1; $i<=10; $i++)
									{	
										if(isset($des->design_rank) && !empty($des->design_rank) &&($des->design_rank == $i))
											echo "<option selected='selected' value='".$i."'>".$i."</option>";						
										else
											echo "<option value='".$i."'>".$i."</option>";						
									
									}
								?></select>-->
								<?php } else if(isset($des->design_rank) && !empty($des->design_rank))
								{ echo 'Rank-'.$des->design_rank; } ?> 
									# <?php echo $des->design_id;?> <!-- by <a href="#"><?php echo $sign[$des->designer_id];?></a> --> </div>
                                    <div class="logo_image">
									<?php  if( ($single_contest[0]->status != "completed") && ($user_id != $des->client_id) && ($user_id != $des->designer_id) ) { ?>
									<img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
									
									<?php } else{ ?>
									<img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  />
									<?php } ?>
									
									</div>
                                    
									<div class="user_review">
                                    	<div class="col-sm-8 col-xs-12">
                                        		<div class="star-rating">
												
                                                	 <input for="<?php echo $des->design_id; ?>" id="input-21b"  <?php 
														
													 if($user_id != $des->client_id){ echo 'readonly'; } ?> value="<?php echo $des->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                                </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-12" style="border:1px so">
                                        	<div class="commend">									 
											 <ul>
											 
											 </ul>
											</div>
                                        </div>
										<?php if($user_id == $des->client_id){ ?>
											<div class="col-sm-48 col-xs-12">
											
											<div class="col-md-6" >	<a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>" >Choose Winner</a>
											</div>	
											
											 <div class="col-md-6" >
											 <?php if(isset($ctfinaldes) && ($ctfinaldes < 2)){ ?>
												<a for='<?php echo $des->design_id;  ?>'  data-modal-id="bpopup<?php echo $des->design_id; ?>" >Choose Finalist</a>
											 <?php } ?>
											</div>
											 
											</div>
										<?php } ?>	
                                    </div>
									<div id="demo" style="float:right;">
    <div class="wrapper">
        <div class="content">
            <ul>
                <a href="#"><li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li></a>
                <a href="#"><li><i class="fa fa-heart" aria-hidden="true"></i> Like</li></a>
			    <a href="#"><li><i class="fa fa-download" aria-hidden="true"></i> Withdraw</li></a>
            </ul>
        </div>
        <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
    </div>
    </div>
                                 </div>   
                                </div>
								
								
								   <!---------------POP BOX--------------->
					 

					 
			<div id="bpopup<?php echo $des->design_id; ?>" class="modal-box">
                <header> 
				   <a class="js-modal-close close" style="top: 1% !important;">×</a>
                   <h3>Choose A Finalist</h3>
                </header>
				<form action="<?php echo base_url();?>contest/final_contest" name="design_upload" method="post" enctype="multipart/form-data">
                      
                      <div class="modal-body">
                            <label>Do You Want Choose As A Finalist ?</label>    
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                            </br>                       
                      </div>
                   <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Finalist" /> </footer>
                  </form>
			</div>
			
			
			<div id="apopup<?php echo $des->design_id; ?>" class="modal-box">
                <header> 
				   <a class="js-modal-close close" style="top: 1% !important;">×</a>
                   <h3>Choose Winner</h3>
                </header>
				<form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                      
                      <div class="modal-body">
                            <label>Do You Want Choose As A Winner ?</label>    
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                            </br>                       
                      </div>
                   <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                  </form>
			</div>

					  <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                      <header> 
					  <a class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h3>Comments</h3>
                      </header>
                      <div class="modal-body">
                      
					   <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                            
					  <?php
							
					  if(isset($prvcomments) && !empty($prvcomments)) { 
								foreach($prvcomments as $tmp2)
								{
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp2->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                              <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
							</br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>
					
					
					  <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                      <header> 
					  <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h3>Comments</h3>
                      </header>
					  
                      <div class="modal-body">
                      
					   <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                            
					  <?php
							
					  if(isset($prvcomments) && !empty($prvcomments)) { 
								foreach($prvcomments as $tmp2)
								{
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp2->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                            <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                            </br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
					  
                    </div>

					
                     <!------------------------------------->
					 
                                <?php } ?>
                                
                            </div>
                        
                        
                      <li>
					  
					   <div> Message</div>
					 
					<?php
						$user_id = $this->session->userdata('user_id');
					?>
	
                        
                            
                    
                      	<div class="contain" style="background-color:#f4f2ed; margin-top:15px;">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="contest-head">
                                        <h4>Public Discussion Board</h4>
                                    </div>
                                </div>
                              </div>
                        </div>
                        
                        <div class="contain" style="border:1px solid rgba(0,0,0,0.1);">
						<?php 
						if(isset($allcomments) && !empty($allcomments)) { 
							foreach($allcomments as $tmp1){
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp1->createdname; ?></b> <?php  if($tmp1->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp1->createddate)); ?></div>
                            </div>
							<div class="row">
								<?php if(!empty($tmp1->attachment)){?>
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12">
								<img src="<?php echo base_url()."uploads/brief/".$tmp1->attachment;?>"></div>
								<?php } ?>
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp1->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
                            
                            <div class="row" style="padding:20px;">
                                <div class="col-md-12 col-lg-12">
                                    <form action="<?php echo base_url();?>Contest/contest_comment" method="post" onsubmit="#" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $contestid; ?>" id='contestid' name='contestid' />
										
										<table width="100%" cellpadding="5">                                        
										<?php if($user_id == $des->client_id){?>
										<tr>
											<td><input type="file" name="comment_file" required style="padding-left:20px; margin-bottom:30px;" ></td>
                                        </tr>
										<?php }?>										
                                        <tr>
											<td>
												<textarea rows="10" cols="20" class="msg_box" id="msg_box" name="msg_box" required ></textarea>
											</td>
                                        </tr>
                                        <tr>
											<td>
												<input type="submit" value="Add Comment" class="comment-btn" id="comment-btn" />
											</td>
										</tr>
                                        </table>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                      </li>
					 
					  <li>
					  
					   <div> Design package (<?php echo $count_designs; ?>)</div>
					 
					 <?php
						$user_id = $this->session->userdata('user_id');
						
					 if(isset($winningcontest) && !empty($winningcontest) )
					 { ?>
				 
				 		
					<div class="row" style="background-color:#f4f2ed; padding:10px;">

						<div class="col-md-6 col-lg-6">
                         <div class="submit-design">DESIGN PACKAGE </div>
                             
						</div>
						
					</div>
		<div class="col-md-12 col-lg-12">					
		<div class="col-md-8 col-lg-8">					
	   <h3>Your design package : (design package name)</h3>  
	</div>
	
		<div class="col-md-4 col-lg-4">
			<a href="#" class="download_pack">DOWNLOAD PACKAGE</a>
		</div>
		<div class="col-md-12 col-lg-12">
			<div class="download_content">
			<p>Dear Client,</p>
			<p><b>( designer name ) </b>has uploaded the package for the winning design, kindly download it , check and if any queries send a message to the designer . If everything is correct please CONFIRM the package .</p>
			</div>
			
		</div>
		<br>
			<div class="col-md-12 col-lg-12">
				<div class="download_msgbox">
				<textarea rows="3" cols="60" class="msg_box1" name="msg_box" placeholder="Send your message to the designer" ></textarea>
				<input type="submit" value="Send" class="comment-btn1" id="comment-btn1" />
			</div>
		</div>
	</div>
	
	<div class="col-md-12 col-lg-12">					
		<div class="col-md-8 col-lg-8">					
	   <h3>Your design package : (design package name)</h3>  
	</div>
	
		<div class="col-md-4 col-lg-4">
			<a href="#" class="download_pack">UPLOAD</a>
		</div>
		<div class="col-md-12 col-lg-12">
			<div class="download_content">
			<p>Dear Client,</p>
			<p><b>( designer name ) </b>has uploaded the package for the winning design, kindly download it , check and if any queries send a message to the designer . If everything is correct please CONFIRM the package .</p>
			</div>
			
		</div>
		<br>
			<div class="col-md-12 col-lg-12">
				<div class="download_msgbox">
				<textarea rows="3" cols="60" class="msg_box1" name="msg_box" placeholder="Send your message to the designer" ></textarea>
				<input type="submit" value="Send" class="comment-btn1" id="comment-btn1" />
			</div>
		</div>
	</div>
	
<br style="clear:both;">	

						<?php } ?>
	
                        
                            
                    
                      		<div class="contain" style="background-color:#f4f2ed; margin-top:15px;">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="contest-head">
                                        <h4>Public Discussion Board</h4>
                                    </div>
                                </div>
                              </div>
                        </div>
                        
                        
                        <div class="contain" style="border:1px solid rgba(0,0,0,0.1);">
						<?php 
						if(isset($allcomments) && !empty($allcomments)) { 
							foreach($allcomments as $tmp1){
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp1->createdname; ?></b> <?php  if($tmp1->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp1->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp1->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
                            
                            <div class="row" style="padding:20px;">
                                <div class="col-md-8 col-lg-8">
                                    <form action="<?php echo base_url(); ?>Contest/contest_comment" method="post" onsubmit="#">
                                        <input type="hidden" value="<?php echo $contestid; ?>" id='contestid' name='contestid' />
										
										<table width="100%" cellpadding="5">
                                        <tr>
                                        <td><textarea rows="10" cols="20" class="msg_box" id="msg_box" name="msg_box" required ></textarea></td>
                                        </tr>
                                        <tr>
                                        <td><input type="submit" value="Add Comment" class="comment-btn" id="comment-btn" /></td>
                                        </table>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                      </li>
                    </ul>
                    
                </div>
                	
            </div>
        </div>
        
    </div>
</div>


<div class="gap"></div>
<script>
$(function(){

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

            if( width <= 320 && height <= 250 ) {
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