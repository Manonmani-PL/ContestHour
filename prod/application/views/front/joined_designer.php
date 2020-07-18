<?php $this->load->view('front/include/left_side_menu_designer'); ?>
  <div class="col-sm-9">
    <div class="right-border">
    	<div class="row">
            <div class="col-sm-12">
            	
                <div class="jointable">
                <h3>Joined</h3>
                 <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Contest Title</th>
                    <th>Contest Type</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Ending Time</th>
                </tr>
                </thead>
                <tbody>
		<?php
			$category= contest_category();
		 if(!empty($join_record)){
					foreach($join_record as $temp)
					{ ?>
					
                <tr>
					<td><a href="<?php echo base_url();?>contest/particular_contest/<?php echo $temp->id?>"><?php echo ($temp->contest_title!="")?$temp->contest_title:$temp->org_name; ?></a></td>
                    <td><?php 
                    $contest_category1 = get_category_type($temp->id);
                                if(is_numeric($temp->contest_type)){
                                foreach ($contest_category1 as $con_category){
                                echo  $con_category; }
                            } else {
                                echo $category[$temp->contest_type];
                            }
                    //echo $category[$temp->contest_type];?></td>
                    <td><?php echo $temp->status ?></td>
                    <td><?php echo $temp->contest_prize?></td>
                    <td><?php echo date("d M, Y h:i a",strtotime($temp->close_date));?></td>
                </tr>
                
		 <?php }} ?>
                
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
