<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model 
{
	function __construct()
	{	
		parent::__construct();

	}
	
	function check_login()
	{	
	    $username = $_POST['username'];
		$password = $_POST['password'];
		
		$this->db->select('*')->from('admin_table')->where('email',$username)->where('password',$password);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		
		if($num_rows==0)
		{
			return false;
		}
		else
		{
		 
		 return true;
		
		}
		
	}
	
	function get_admin_details()
	{
	  $username = $_POST['username'];
	  $password = $_POST['password'];
	  $this->db->select('admin_id,email')->from('admin_table')->where('email',$username)->where('password',$password);
	  $query  = $this->db->get();
	  $result = $query->row_array();
	  return $result;
	  
	}
	
	function check_user_login()
	{
		if(($this->session->userdata('admin_id')!='')&&($this->session->userdata('admin_name')!=''))
		{
			return true;
		}
		else
		{
			redirect('admin_panel');
		}
	}
	
	
	  public function designer_contest($designerid)
    {
         $query = $this->db->query("SELECT *,count(c.id)design_count FROM `designs` d, `contest` c WHERE d.designer_id = $designerid and d.contest_id = c.id group by c.id");
         if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }
		 else
		 {
			 return false;
		 }

    }
	
    public function designer_status($designerid)
    {
        
         $query = $this->db->query("SELECT * FROM `designs` d, `contest` c WHERE d.designer_id = $designerid and d.contest_id = c.id ");
         if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }
    }
    
	public function finalistdesigner($designerid)
    {
        
         $query = $this->db->query("SELECT c.* FROM `contest` c, `designs` d WHERE d.`designer_id` =$designerid  and c.`id`=d.`contest_id` and d.`final_status`=1 and d.`design_status`=0 ORDER BY `close_date` DESC");
         if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }
    }
	
	public function join_design($designer_id)
	{
	
	$query = $this->db->query("SELECT DISTINCT(`id`),`contest_title`,`org_name`, `contest_type`, `contest_prize`, `status`, `close_date` FROM `contest` c, `designs` d WHERE c.`id`=d.`contest_id` and d.`display_status`=0 and d.`designer_id`='$designer_id' ORDER BY `close_date` DESC");
	if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }
	}
	
	public function wining_design($designer_id)
	{
		$query = $this->db->query("SELECT c.* FROM `contest` c, `designs` d WHERE  d.`designer_id` = $designer_id and c.`id`=d.`contest_id` and d.`design_status`=1  ORDER BY `close_date` DESC");
		
		if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }

	}
	
	public function all_contest_report($domain=1){
		//****** Conetest Report without draft Contest *******//
		$query = $this->db->query("SELECT c.id, c.contest_title, c.org_name, r.* FROM `contest` c, `contest_pricing_report` r WHERE c.`id`=r.`contest_id` and c.`status`!='draft' and `posted_from`='$domain'  ORDER BY `published_date` DESC");
		
		if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }

	}
	
	public function contest_relaunch($id){
		date_default_timezone_set('Asia/Kolkata');
        $current_time= date('d-m-Y H:i');
        $tym= date('Y-m-d H:i');
 
         $closy=date('Y-m-d H:i', strtotime("+3 days"));
      
          $query = $this->db->query("UPDATE `contest` SET `status`='open', `close_date` = '$closy', `published_date` = '$tym' WHERE `id` = '$id'");
		
	}

	public function all_referral_user_report(){
		$query = $this->db->query("select ref.ref_code as ref_code,usr.user_name as user_name,sum(ref.ref_amount) as ref_amount,ref.ref_created_date as ref_created_date from referral_code ref inner join user_table usr on usr.user_id=ref.user_id group by ref.user_id");
		return $query->result();
	}
}
?>