<?php $this->load->view('front/include/left_side_menu_client'); ?>
  <div class="col-sm-9">
  <?php #echo '<pre>'; print_r($my_con); ?>
    <div class="right-border" style="padding:10px;">
    	<div class="row">
            <div class="col-sm-12">
            	
                <div class="jointable">
                <h3 class="">My Contest</h3>
                 <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Contest Type</th>
                    <th>Contest Price</th>
                    <th>Status</th>
                    <th>Action</th>
                   
                </tr>
                </thead>
                <tbody>
                <?php 
				$category= contest_category();
                //var_dump($category);exit;
				if(!empty($my_con)) { 
					foreach($my_con as $mc) { 
				?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>contest/contest_entries/<?php echo $mc->id; ?>" ><?php if($mc->contest_type != 'logodesign' && $mc->contest_type != 'webdesign' && $mc->contest_type != 'movielogodesign' ){ echo $mc->contest_title;} else { echo $mc->org_name; } ?></a></td>
                    <td><?php 
                     $contest_category1 = get_category_type($mc->id);
                                if(is_numeric($mc->contest_type)){
                                foreach ($contest_category1 as $con_category){
                                echo  $con_category; }
                            } else {
                                echo $category[$mc->contest_type];
                            }?></td>
                    <td><?php echo $mc->total_amount; ?></td>
                    <td><?php echo $mc->status; ?></td>
                    <td><a href="<?php echo base_url(); ?>contest/contest_entries/<?php echo $mc->id; ?>" >View</a> <!--/ <a href="#">Delete</a>--></td>
                  
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
