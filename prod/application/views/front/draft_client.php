<?php $this->load->view('front/include/left_side_menu_client'); ?>
  <div class="col-sm-9">
    <div class="right-border" style="padding:10px;">
    	<div class="row">
		
            <div class="col-sm-12">
				<div><?php echo $this->session->flashdata('msgs');?></div>
				
                <div class="jointable">
                <h3>Draft</h3>
                 <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Launch</th>
                    <th>Title</th>
                    <th>Contest Type</th>
                    <th>Contest Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                   
                </tr>
                </thead>
                <tbody>
                <?php 
				$category= contest_category();
				if(!empty($draft_con)) { 
					foreach($draft_con as $mc) {
				?>
                <tr>
                   <!--  <td><a class="btn-launch" href="<?php echo base_url(); ?>contest/payment_option?contest_id=<?php echo $mc->id; ?>&type=<?php if($mc->contest_type != 'logodesign' && $mc->contest_type != 'webdesign' && $mc->contest_type != 'movielogodesign' ){ echo $contitle = $mc->contest_title;} else { echo $contitle = $mc->org_name; } ?>">Launch</a></td> -->
                         <td><a class="btn-launch" href="<?php echo base_url(); ?>contest/confirm_order1?contest_id=<?php echo $mc->id; ?>">Launch</a></td>
					<td><?php echo $mc->contest_title;?></td>
                    <td><?php
                     $contest_category1 = get_category_type($mc->id);
                                if(is_numeric($mc->contest_type)){
                                foreach ($contest_category1 as $con_category){
                                echo  $con_category; }
                            } else {
                                echo $category[$mc->contest_type];
                            }
                            //echo $category[$mc->contest_type]; ?></td>
                    <td><?php echo $mc->total_amount; ?></td>
                    <td><?php echo $mc->status; ?></td>                  
                    <td><a href="<?php echo base_url(); ?>contest/deletecontest/<?php echo $mc->id; ?>">Delete</a></td>                  
                </tr>
                <?php } } else {?>
                <tr>
                	<td colspan="5" align="center">No data available in table</td>
                </tr>
                <?php } ?> 
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
<div class="container">
	<div class="col-md-3"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
</div>
<div class="gap"></div>
