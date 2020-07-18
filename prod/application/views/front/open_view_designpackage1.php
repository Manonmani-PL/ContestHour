
 <!--==========================
    Intro Section
  ============================-->
  <style>
.download_content1 {
    background: #eae7e7;
    padding: 20px 40px;
    margin-top: 15px;
}
.header{
      font-weight: 700;
      color: #fff;
}
a.download_pack, span.download_pack{background:#F94812;padding:5px;color:#fff;float:right;font-weight:bold;margin-top:15px;padding-left:20px;padding-right:20px;}
a.download_grey,span.download_grey{background:#444;padding:5px;color:#fff;float:right;font-weight:bold;margin-top:15px;padding-left:20px;padding-right:20px;}
.text
{
	text-align:left;
}
.modal-content {
	height:400px;
	overflow:scroll;
	
}
 
.modal-content p{
	padding:10px; background-color:rgba(0,0,0,0.1); border-radius:10px;
	color:black !important;
	width:100% !important;
}

</style>
  <?php
   if($this->session->flashdata('msgs')){
   ?>
   <div class="alert alert-<?php echo $this->session->flashdata('type');?> " style="width:50%; margin:auto;">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <?php echo $this->session->flashdata('msgs');?>
</div>
<?php     
   }
   ?>
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
<!-- <section>
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
</section> -->

  <section id="intro" class="contest-brief">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade">
    <img src="<?php echo base_url();?>assets/images/home_bg.jpg" alt="" title="" />
      </div>
    <div class="intro-msg contest-detail">
    <div class="container">
      <div class="row intro-top">
        <div class="col-lg-7 text-left">
          <span class="price-tag">$<?php echo $single_contest[0]->contest_prize ?> </span>
          <h3 class="contest-title"><?php
            $string1 = mb_strimwidth($single_contest[0]->org_name, 0, 12, '...');
            $string2 = mb_strimwidth($single_contest[0]->contest_title, 0, 12, '...');
            if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
            echo ucfirst($string1);
            else
             echo ucfirst($string2);
          ?></h3>
          <span class="category-label"><?php if(is_numeric($single_contest[0]->contest_type)){
                foreach($category as $category_value){
                  echo $category_value;
               } } else {
                  echo $contest_category[$single_contest[0]->contest_type];
              } ?></span>
        </div>
        <div class="col-lg-5 feature-box">
           <?php if(round($single_contest[0]->upgrade_private_contest) >0):?>
          <span class="feature-tag">
            <i class="fa fa-lock"></i> Private Contest
          </span>
           <?php 
                   endif; 
                   if(round($single_contest[0]->upgrade_featured_contest) >0):
                  ?>
          <span class="feature-tag">
            <i class="fa fa-star"></i> Featured Contest
          </span>
           <?php endif;
             $usertype = $this->session->userdata('user_type');
           ?>

        </div>
      </div>
<div class="row intro-bottom">
        <div class="col-lg-3 ">
            <?php 
       $time=time2string(strtotime($single_contest[0]->close_date) - time());
            if(isset($winningcontest) && (($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){
            if(($single_contest[0]->package_status==3)||($single_contest[0]->package_status<3) &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){  ?>
               <span class="status-tag">Winner Selected</span>
           <?php  }
            } else if($single_contest[0]->status =="completed"){
               ?>
                <span class="status-tag">Qualifying Stage</span>
              
             <?php }  ?>
              <?php 
                if($single_contest[0]->status =="judging"){
               ?>
             <span class="status-tag">Judging Contest</span>
              <?php }  ?> 
              <?php 
                if($single_contest[0]->status =="open"){
               ?>
             <span class="status-tag">Open Contest</span>
              <?php }  ?>
            </div>
            <div class="col-lg-5">
              <div class="row">
                <div clas="col-lg-4">
          <span class="time-block"><img src="<?php echo base_url();?>assets/images/time_icon.svg"></span></div><!--  2 Days, 20 Hours, 48 Minutes left -->
                  <span><div clas="col-lg-8"><?php if($single_contest[0]->status == 'open'){ ?>
               <h3 style="color: white; font-weight: bolder;"><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h3>
               <?php  
                  $time=time2string(strtotime($single_contest[0]->close_date) - time()); 
                  ?>
               <p >left to submit design concepts.</p>
               <?php 
          } 
                else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1)){  ?>
               <h3 style="color: white; font-weight: bolder;"><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h3>
               <p>left to submit design concepts.</p>
               <?php 
          }else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && ($user_id==$single_contest[0]->client_id)){ 
        ?>
               <h3 style="color: white;font-weight: bolder;"><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h3>
               <p>left to submit design concepts.</p>
                 <?php } ?>
         
         <?php
         //Partial payment option not use this new contesthours project so remove 
         /*
         if(payment_status($single_contest[0]->id)==0 && $single_contest[0]->status == 'judging'){ ?>
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
         <?php 
        }
        else if(payment_status($single_contest[0]->id)==0 && $single_contest[0]->status == 'open'){
        ?>
          <?php 
          if($user_id == $single_contest[0]->client_id){
          ?>
          <h2>Awaiting balance payment from your side.</h2>
          <p><a href="<?php echo base_url()?>contest/contest_partial_payment/<?php echo $single_contest[0]->id;?>" style="color:#f14b15;"> Click Here </a>to pay the balance payment.</p>
          <?php
          }
          ?>
        <?php 
        }*/
          ?>
             <?php if($single_contest[0]->status == 'completed'){
             if($single_contest[0]->close_date < date("Y-m-d H:i:s")){ ?>
               <h3 style="color: white; font-weight: bolder;"> Finished Date </h3>
            <?php  } else {
                 $remain = remaining_time(date("Y-m-d "),$single_contest[0]->close_date);
                $rdate= date('d',strtotime($remain)); ?>
               <p><?php echo remaining_time(date("Y-m-d H:i:s"),$single_contest[0]->close_date)."left"."</p>";
               // echo remaining_time(date("Y-m-d H:i:s"),$single_contest[0]->close_date)."left";
                //echo $rdate." Remaining Date";
            }
             } ?></span></div></div>
        </div>
         <div class="col-lg-4 feature-box">
             
               <?php 
                    $usertype = $this->session->userdata('user_type');
                    if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1) && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && (!isset($winningcontest) && empty($winningcontest)))
                      {
                     ?>
               <span class="status-tag" data-target="#myModal1" data-toggle="modal" style="background-color: #fbb03b">FINALIST SUBMIT YOUR DESIGN</span>
               <?php } else if(isset($usertype) && !empty($usertype) && ($usertype !='0') && (!isset($winningcontest) && empty($winningcontest)) && $time!="Time Out" && $single_contest[0]->status !="judging"){ ?>
               <span class="status-tag" data-target="#myModal1" data-toggle="modal" style="background-color: #fbb03b">SUBMIT YOUR DESIGN</span>
                <?php }
                        else if($usertype=='' && $single_contest[0]->status =="open")
                        { ?>
                     <a href="<?php echo base_url();?>Admin/loginForm "> 
                     <span class="status-tag js-open-modal btn btn-submit" style="background-color: #fbb03b">SUBMIT YOUR DESIGN</span></a>
                      <?php $this->session->set_flashdata('message_name', 'please Login after then submit your design');
                       }
                        ?> 
            </div>
            <!-- <div class="modal fade show" id="myModal1" style="padding-right: 16px; "> -->
   <!-- <div class="modal fade hide" id="myModal1" style="display: none;"> -->
      <div class="modal fade" id="myModal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Please upload yours file here</h4>
        <button type="button" class="close1" data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
       <!--  <div class="col-lg-8 text-left">   
        <div class=" form-group">
         <label for="email">Comments:</label>
         <textarea class="form-control" name="comments"></textarea>
        </div>
        </div> -->
          <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-5 col-sm-6">
            <input type="file" name="for_upload" id="for_upload" />
            <div class="help-block" style="text-align: left;margin-left: 34px;"> Please Upload the Files Only in <br><strong style="font-weight:  1000; font-size: 16px; color: #000;">(640px * 500px)</strong> Dimension</div>
             <div id="preview1"></div>
                  <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id; ?>" />
                  <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id; ?>" />
                  <?php 
                     if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
                     {
                     ?>
                  <input type="hidden" id="final_status" name="final_status" value="<?php echo $subcheck->final_status; ?>" />
                  <?php } ?>
                  <br><h5 style="margin-left:32px;text-align:left;"><b>Condition</b></h5>
                   <ul>
              <li class="text">I Have read <a href="<?php echo base_url()?>admin/codeofconduct" >Designer code of Conduct</a></li>
              <li class="text">I Have read the design brief</li>
              <li class="text">I did not use stock or clip art</li>
              </ul>
          </div>
          <div class="col-7 col-sm-6">
            <p>No Email Address or any contact info in the design submission or messages</p>
            <p> No Flooding with small changes submissions</p>
            <p>No Requesting client's email or contact info</p>
              <p>No Discussions to be made to client regarding fellow designers</p>
             <p>No Stock images or free vectors or using existing logos with minor modifications</p>
             <p>No copying from fellow designers</p>
             <p>No Foul Language during messaging client or fellow desingers</p>
             <p>No Borders around the design submissions</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
        <input type="submit" value="Upload" id="sbt_button" class="btn btn-primary orange_bttn">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
      </form>
      </div>


      </div>
    </div>
    </div>
    </div>
  </section><!-- #intro -->
    
  <section id="contest-tabs">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="tab-btns">
            <li ><a href="<?php echo base_url()."contest/contest_brief/".$contestid?>"> Brief</a></li>
            <li><a href="<?php echo base_url()."contest/contest_entries/".$contestid?>">Designs<span><?php echo $count_designs;?></span></a></li>
            <li> <a href="<?php echo base_url()."contest/contest_discussions/".$contestid?>" >Client Uploads
           <?php echo client_contest_discussioncount($single_contest[0]->id, $single_contest[0]->client_id);?> </a></li> 
            <?php if(isset($winningcontest)){
                     if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
           <li class="active" style="color: #00bfff;"> Design Package
           </a></li>
              <?php } } ?>
               <?php if(($user_id==$single_contest[0]->client_id)){?>
          <li><a href="<?php echo base_url()."contest/contest_procedure/".$contestid?>"> Help </a></li>
          <?php } ?>
          </ul>

        </div>
      </div>
    </div>
  </section>
 
  <main id="main">
  
 <div class="min-height">
  
    <section id="contests-designs" class="winner-block">
      <div class="container">
        <div class="judging-view">
   <div class="container">
     <!-- price-btn -->
     
    
      <!-- mode -->
     
     
      
      <!--tab-->
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="tab">
        
                        <div class="row">
                           <div class="col-lg-12 section-header">
                                DESIGN PACKAGE
                             
                           </div>
                        </div>


<!-- code start -->

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
          
                     <?php if($user_id==$winningcontest->client_id){?>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <h3>Your design package : (<?php 
                            if(is_numeric($single_contest[0]->contest_type)){
                    foreach($category as $category_value){
                      echo $category_value;
                          } } else {
                  echo ucwords($contest_category[$single_contest[0]->contest_type]);
                          } 
                          ?>)</h3>
                        </div>
            
                        <div class="col-md-6 col-lg-6">              
               <!---First download link after first download-->
                           <?php if($single_contest[0]->package_status==1):?>
                <span class="downloadPackage start-now" style="margin-top: 10px;background: #fbb03b; padding: 5px;color: #fff;float: right;font-weight: bold; margin-top: 15px;   padding-left: 20px; padding-right: 20px;">DOWNLOAD PACKAGE</span>
                           <?php elseif($single_contest[0]->package_status==2):?> 
               <!--
                           <a href="<?php echo base_url()?>contest/confirmpackage/<?php echo $single_contest[0]->id?>" data-modal-id="testimony_pop" class="download_pack">CONFIRM PACKAGE</a>-->
               
                           <a data-target="#testimony_pop" data-toggle="modal" class="download_pack">CONFIRM PACKAGE</a>

                           <div class="modal fade" id="testimony_pop">
                     <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <!-- Modal Header -->
                       <div class="modal-header">
                          <h4 class="modal-title">Testimony</h4>
                          <button type="button" class="close1" data-dismiss="modal">×</button>
                        </div>

                     <!-- Modal body -->
                       <div class="modal-body">

        <form action="<?php echo base_url();?>contest/confirmpackage" name="commentform" method="post" enctype="multipart/form-data">
        <div class="col-lg-10 text-left"> 
        <div class=" form-group">
         <label >Kindly give your testimony about the designer and the contest experience.:</label>
          <textarea rows="5" cols="20" class="form-control" name="testimony_msg" placeholder="your testimony" autocomplete="off"></textarea>
                            <input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id?>">
                           </br>
                          <!--  <input type="submit" class="precomm" value="Add Comment"/> -->
        </div>
        </div> 
      
         <footer> 
                   <div class="modal-footer">
        <input type="submit" value="SUBMIT" id="sbt_button" class="btn btn-primary orange_bttn">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
                </footer>
                </form>
   </div>
</div>
</div>
</div>
               <?php endif;?>
              <!---End First download link after first download-->
              
              <!---Permenant download link after first download-->
               <?php 

               if($single_contest[0]->package_status > 1 ):?>  
                           <a href="<?php echo base_url().'uploads/package_uploads/'.$single_contest[0]->package_path;?>" target="_blank" class="status-tag download_pack" style="border-radius: 5px; background-color: #fbb03b; ">DOWNLOAD PACKAGE</a>
                             <a href="<?php echo base_url().'contest/download_agreement/'.$single_contest[0]->id;?>" target="_blank" class="status-tag download_pack" style="border-radius: 5px;background-color: #00bfff;">DOWNLOAD AGREEMENT</a> 
               <?php endif;?>
               <!---End Permenant download link after first download-->
                        </div>
            <!-- Default content for Client -->
            <div class="col-md-12 col-lg-12">
                           <div class="download_content1">
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
                           <div class="download_content1">
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
                           <div class="download_content1">
                              <p>Dear Client,</p>
                              <p>Kindly let us know if the project is completed or not or else the payment will be released to the winning designer.</p>
                <br>
                <span>-Admin</span>
                           </div>
                        </div>
                        <?php endif;
            }
                           ?>
                        <div class="lastmsg" style="margin-bottom:10px;">
                           <?php 
              $winner_select_time=$single_contest[0]->winner_select_time;
                            $ms1=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id,'created_time>'=>$winner_select_time),'created_time');
                              
                                        foreach($ms1 as $msg2)
                                 {
                                   $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg2->from_id))
                                  ?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content1">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg2->subject;?></p>
                              </div>
                           </div>
                           <?php  } ?>
                        </div>
            <?php if(($single_contest[0]->package_status > 1) && ($single_contest[0]->package_status<3)):?>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_msgbox">
                              <input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                              <textarea rows="3" cols="60"  class="msg_box1 txtarea" name="winner_message" placeholder="Send your message to the designer" ></textarea>
                              <input type="submit" value="Send" style=" border-radius: 5px;border-color:white;background-color: #9b7093" class="comment-btn1 submit2" id="comment-btn1" />
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
                           <h3>Your design package : (<?php  if(is_numeric($single_contest[0]->contest_type)){
                    foreach($category as $category_value){
                      echo $category_value;
                          } } else {
                  echo ucwords($contest_category[$single_contest[0]->contest_type]);
                          } ?>)</h3>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <a data-target="#depack_pop" data-toggle="modal" class="uploadFile start-now" style="margin-top: 10px;background: #fbb03b; padding: 5px;color: #fff;float: right;font-weight: bold; margin-top: 15px;   padding-left: 20px; padding-right: 20px;" >Upload Package</a>
                           
                        </div>

                         <div class="modal fade" id="depack_pop">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">
                        <div class="modal-body">
             <form action="<?php echo base_url();?>contest/upload_package" method="post" enctype="multipart/form-data">
            <div class="form-group">
             <h3> Design Package</h3>    
                           <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                                    <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id;?>">
                           </br>
                            <div class="row" style="margin-top:20px;">
                              <span class="uploadFile1">Upload</span>
                                       <input type="file" name="upload_package" class="uploadBtn upload" />
                           </div>
                 </div>  
                     <!-- Modal footer -->
               <div class="modal-footer">
                 <button type="submit" class="btn btn-primary">Send</button>
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                
               </div>
               </form>
               </div>
              

             </div>
           </div>
         </div>
            <!-- Default content for winning designer -->
            <div class="col-md-12 col-lg-12">
                           <div class="download_content1">
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
                           <div class="download_content1">
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
                              <div class="download_content1">
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
                           <h3 style="margin-top: 15px;">Your design package : (<?php  if(is_numeric($single_contest[0]->contest_type)){
                    foreach($category as $category_value){
                      echo $category_value;
                          } } else {
                  echo ucwords($contest_category[$single_contest[0]->contest_type]);
                          } ?>)</h3>
                        </div>
            <div class="col-md-3 col-lg-3">
                           <a data-target="#depack_pop" data-toggle="modal" class="uploadFile start-now" style="margin-top: 10px;background: #F94812; padding: 5px;color: #fff;float: right;font-weight: bold; margin-top: 15px;   padding-left: 20px; padding-right: 20px;">REUPLOAD PACKAGE</a>
                           
                        </div>

                        <div class="modal fade" id="depack_pop">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">
                        <div class="modal-body">
            <form  action="<?php echo base_url()?>contest/upload_package" method="post" enctype="multipart/form-data">
            <div class="form-group">
             <h3> Design Package</h3>    
                            <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                                    <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id;?>">
                           </br>
                            <div class="row" style="margin-top:20px;">
                              <span class="uploadFile1">Upload</span>
                                       <input type="file" name="upload_package" class="uploadBtn upload" />
                           </div>
                 </div>  
                     <!-- Modal footer -->
               <div class="modal-footer">
                 <button type="submit" class="btn btn-primary">Send</button>
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                
               </div>
               </form>
               </div>
              

             </div>
           </div>
         </div>
            <!--
            <pre>
            <?php //print_r($single_contest[0]);?>
            </pre>
            -->
                        <div class="col-md-3 col-lg-3">

               <?php if(($single_contest[0]->package_status==1) && ($upload_diff>=2) && ($single_contest[0]->payment_req_status == 0)):?>
               <a href="<?php echo base_url()?>contest/requestpayment/<?php echo $single_contest[0]->id?>" class="download_grey">REQUEST PAYMENT</a>
               
               <?php elseif(($single_contest[0]->package_status==2) && ($down_diff>=2) &&($req_diff<2) && ($single_contest[0]->payment_reqtime=="0000-00-00 00:00:00") && ($single_contest[0]->payment_req_status == 0)):?>  
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
                           <div class="download_content1">
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
                           <div class="download_content1">
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
                           <div class="download_content1">
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
                           <div class="download_content1">
                              <p>Dear Client,</p>
                              <p>Kindly let us know if the project is completed or not or else the payment will be released to the winning designer.</p>
                <br>
                <span>-Admin</span>
                           </div>
                        </div>
                        <?php endif;?>
                        <?php if(($single_contest[0]->package_status==3) || (($single_contest[0]->package_status==2) && ($release_diff>=1))):?> 
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content1 text-center">
                              <p>Payment Released.</p>
                           </div>
                        </div>
                        <?php endif;?>  
                        <div class="lastmsg" style="width:100%;     margin-bottom: 13px !important;">
                           <?php 
               $winner_select_time=$single_contest[0]->winner_select_time;
                              $ms4=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id,'created_time>'=>$winner_select_time),'created_time');
                                        foreach($ms4 as $msg5)
                               {
                                 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg5->from_id))
                                ?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content1">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg5->subject;?></p>
                              </div>
                           </div>
                           <?php  }?>
                        </div>
            
                        <div class="col-md-12 col-lg-12">
                           <div class="download_msgbox">
                <input type="hidden" class="check_condition" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                <textarea rows="3" cols="60" class="msg_box1 txtarea" style="width: 100%;
    margin-top: 10px;" name="msg_box" placeholder="Send your message to the client"></textarea>
                <input style="padding: 10px 25px 10px 25px;
    margin-bottom: 10px;"type="submit" value="Send" class="btn btn-primary submit2" id="comment-btn1"/>
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





<!-- code end -->

      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
    </section>
 
   
 
  </div>
  </main>                        
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
                 $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content1'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
                  $(".txtarea").val("");        
                  
              
              } else {
               $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content1'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
                $(".txtarea").val("");
                           }
               
               $('.submit2').removeAttr('disabled');
              
                       }
                   });
               });
   });
   
</script>
<?php endif;?>