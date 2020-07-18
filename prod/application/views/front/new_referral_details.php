<?php $this->load->view('front/include/left_side_menu_designer');?>
<?php echo $this->session->flashdata('referral_request');?>
<div class="col-md-9 col-sm-9">
   <div class="right-border">
  
       
  
          
          <div class="row" style="    padding-top: 10px; ">
      


            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
            <script>
               $(function(){
               
               var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
               
               $('a[data-modal-id]').click(function(e){
                e.preventDefault();
                   $("body").append(appendthis);
                   $(".modal-overlay").fadeTo(500, 0.7);
                   //$(".js-modalbox").fadeIn(500);
                var modalBox = $(this).attr('data-modal-id');
                $('#'+modalBox).fadeIn($(this).data());
               });  
                 
                 
               $(".js-modal-close, .modal-overlay").click(function(){
                   $(".modal-box, .modal-overlay").fadeOut(500, function() {
                       $(".modal-overlay").remove();
                   });
               });
                
               $(window).resize(function() {
                   $(".modal-box").css({
                       top: ($(window).height() - $(".modal-box").outerHeight()) / 6,
                       left: ($(window).width() - $(".modal-box").outerWidth()) / 6
                   });
               });
                
               $(window).resize();
                
               });
            </script> 
            <div style="padding-top:20px;padding: 1px;
    font-family: 'twncemd';
    
    border: 1px solid rgba(0,0,0,0.1); border-radius: 10px;">
               <table class="table table-hover" id="bootstrap-table" >
                  <thead>
                     <tr>
                        <th>Sno</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Contest Price</th>
                        <th>Referral Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        $sno=1;
                        $ref_id= $this->session->userdata('user_id');
                        $request = get_new_referral_details($ref_id);

                        if($request!=""){
                        foreach($request as $req) { 
          ?>
                     <tr>
                        <td> <?php echo $sno++; ?> </td>
                        <td> <?php echo date("d/M/Y h:i a",strtotime($req->ref_created_date));?> </td>
                        <td><?php 
                        $userid = username($req->user_id);
                        $contest_name = contestname($req->contest_id);

                        echo $userid." <b> - </b>". $contest_name?></td>
                       <td> <?php echo $req->contest_prize;?> </td>
                        <td> <?php echo $req->ref_amount.".00";?> </td>
                     </tr>
                     <?php  
            }
           }
                        else{?>
                     <td> no records</td>
                     <?php  }?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

</div>
</div>
</div>


<div class="gap"></div>
