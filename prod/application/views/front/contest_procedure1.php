<style>
/*.p{
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
  font-size: 1rem;
  line-height: 1.5;
  text-align: left;
  padding: 0;
  margin: 0 0 10px 0;
}*/

.h3, h3 {
    font-size: 1.55rem!important;
}
.header{
      font-weight: 700;
      color: #fff;
	  
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
.text
{
	text-align:left;
}
</style>
 <!--==========================
    Intro Section
  ============================-->
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
  <section id="intro" class="contest-brief">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade">
    <img src="<?php echo base_url();?>assets/images/home_bg.jpg" alt="" title="" />
      </div>
    <div class="intro-msg contest-detail">
    <div class="container">
        <div class="row intro-top">
       
<!-- mano -->
    
    <div class="col-lg-12 text-left">
            <div class="col-lg-12">
              <div class="row">
              <div class="col-lg-3" >
               <span class="price-tag">$<?php 

               echo $single_contest[0]->contest_prize ?> </span>
             </div>
             <div class="col-lg-9">
               <h3 class="contest-title" id="contest-title"><?php 
              /*    $string1 = mb_strimwidth($single_contest[0]->org_name, 0, 12, '...');
                  $string2 = mb_strimwidth($single_contest[0]->contest_title, 0, 12, '...');*/
                 if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign") 
                  echo ucfirst($single_contest[0]->org_name);
                 else
                   echo ucfirst($single_contest[0]->contest_title);
               ?></h3>
             </div>
            </div></div></div>
<div class="col-lg-12 text-left">
            <div class="row">
              <div style="margin-top: 10px!important; float: right!important;  " class="col-lg-3">
               <span class="category-label" style="margin-left: 15px;"><?php if(is_numeric($single_contest[0]->contest_type)){
                  foreach($category as $category_value){
                  echo $category_value;
                   } } else {
                     echo $contest_category[$single_contest[0]->contest_type];
                  } ?></span>
            </div>


             <div class="col-lg-6 feature-box" style="float: left!important; text-align: left!important;">
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
                <?php endif;?>
            </div>
          </div></div>

       <!--    mano -->
  
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
              <div class="row" style="padding: inherit;">
                <div clas="col-lg-4">
          <span class="time-block"><img src="<?php echo base_url();?>assets/images/time_icon.svg"></span></div><!--  2 Days, 20 Hours, 48 Minutes left -->
                   <!--  <span><div clas="col-lg-8" style="padding-bottom: 10px!important; margin-top: -18px!important; "> -->
                    <span><div clas="col-lg-8" style="padding-bottom: 10px!important;  "><?php 
                  if($single_contest[0]->status == 'open'){ ?>

 
<!-- //meeeee -->

         <h3 style="color: white; font-weight: bolder; margin-top: 18px!important; margin: 0 0 0 0!important; "><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h3>
               <p>left to submit design concepts.</p>  





               <?php 
         }  else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
          {  ?>
               <h3 style="color: white; font-weight: bolder; padding-bottom: 10px!important; margin-top: -18px!important; margin-bottom: 0!important;"><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h3>
               <p>left to submit design concepts.</p>
               <?php 
         }else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && ($user_id==$single_contest[0]->client_id)){ 
        ?>
            <h3 style="color: white; font-weight: bolder; padding-bottom: 10px!important; /*margin-right: -40px !important;*/margin-top: -0px!important; margin-bottom: 0!important;"><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h2>
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
               <h3 style="color: white; font-weight: bolder;"> Finished Date </h3>;
            <?php  } else {
                 $remain = remaining_time(date("Y-m-d "),$single_contest[0]->close_date);
                $rdate= date('d',strtotime($remain)); ?>
               <p><?php echo remaining_time(date("Y-m-d H:i:s"),$single_contest[0]->close_date)."left"."</p>";
               // echo remaining_time(date("Y-m-d H:i:s"),$single_contest[0]->close_date)."left";
                //echo $rdate." Remaining Date";
            }
             }  ?></span></div></div>
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
            <?php 
           if(isset($winningcontest)){
                     if(($single_contest[0]->status =='completed') && (($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
           <li><a href="<?php echo base_url()."contest/contest_designpackage/".$contestid?>" > Design Package </a> </li>
              <?php } }?>
               <?php if(($user_id==$single_contest[0]->client_id)){?>
          <li class="active"> Help </li>
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
       <?php
        $user_id = $this->session->userdata('user_id');
            ?>
      <?php if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'open' )){ ?>
           
         
          <div class="col-md-12 col-lg-12 section-header">
            
            WELCOME To CONTESTHOURS 
          </div>
        
     
      <div class="contain" >
         <div class="row" style="padding:20px;">
          <p>Thank you for launching your design contest with us. To make most of your contest, We are happy to share a few tips </p>
          <ul style="list-style-type:none;">
           <li> 1.Provide your valuable <a class="highlight_comment" href="#"> comments </a>in the comment box under the designs to help the designers improve their design.</li>
           <li> 2.Provide <a class="highlight_comment" href="#"> Ratings <i class="fa fa-star" aria-hidden="true"></i> </a>for prospective designs so that it will give designers a guided direction .</li>
           <li> 3.For better explanation add pictures or additional information in the  <a class="highlight_comment" href="#"> "discussion"</a> tab beside "entries"</li>
           <li> 4.Encourage designers and appreciate them, they are doing their best for you</li>
           <li> 5.Have fun , it’s a pleasure having you here </li>
          </ul>
         </div>
      </div>
      <?php } ?>

      <?php if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'judging')){ ?>
    
           <div class="col-lg-12 section-header">
           JUDGING STAGE.
           </div>
      <div class="contain" >
         <div class="row" style="padding:20px;">
          <p>           
           Your contest is now in the JUDGING STAGE.
           You can either choose the winner directly or select upto 2 designers as a “FINALIST” by clicking the option below each design . If you have any corrections you can ask them to revise and improvise to achieve your desired design.
          </p>
         </div>
      </div>
      <?php  } ?>
      <?php if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'completed' )){ ?>
    
         
           <div class="col-lg-12 section-header">
          COMPLETION STAGE 
           </div>
      </div>
      <div class="contain" >
         <div class="row" style="padding:20px;">
          <p>           
           Now you have selected your " winner ".
           The winner will upload the design package in the
           " DESIGN PACKAGE " tab in blue beside the " discussions tab " and you can download and check. If you have any changes or queries, message the designer with the comment option there.
           Once you have downloaded and checked, kindly confirm the package so that we will release the payment to the winning designer.  
          </p>
         </div>
      </div>
      <?php } ?>
           






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
      $(".uploadFile").html(fileName);
    });
    
    $(document).on('click','.downloadPackage',function() {   
        $.ajax({ 
          url: "<?php echo base_url();?>contest/packagedownload",
          data:{
            contest_id:<?php echo $single_contest[0]->id;?>
          },
          type: "POST",
          success: function(data){
            if(data=='success'){
             window.location="<?php echo base_url();?>contest/particular_contest/<?php echo $single_contest[0]->id;?>"; 
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
   
   /* $(document).ready(function(){
    $(document).on('click','.choose_winner',function(){
      var pop_id=$(this).attr('data-modal-id');
      var pop_img= $(this).prev('.logo_image');
      
    });
   }); */
    $(document).ready(function(){

    var count = $("#contest-title").text().length;
/*alert(count);*/
if(parseInt(count) > 23) 
{
   $('#contest-title').css('font-size','33px');

}
if(parseInt(count) > 34) 
{
   $('#contest-title').css('font-size','30px');
}
 

  });
</script>
<?php if(!empty($winningcontest)):?>
<script>
   $(document).ready(function() {
        $(".submit2").click(function() {
                   var msg = $(".txtarea").val();
                   var values = $(".check_condition").val();
                   var usertypes = "<?php echo $usertype ?>";
                   if (values == "") {
   
                       var from1 = <?php echo $winningcontest->client_id; ?>;
                       var to = <?php echo $winningcontest->designer_id;?>;
                   } else {
   
                       var from1 = <?php echo $winningcontest->designer_id;?>;
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
                       success: function(response) {
                           if (usertypes == 0) {
                               $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
                  $(".txtarea").val("");            
              
              } else {
                               $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
                $(".txtarea").val("");
                           }
              
                       }
                   });
               });
   });
   
</script>
<?php endif;?>