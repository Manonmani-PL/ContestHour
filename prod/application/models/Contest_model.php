<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contest_model extends CI_Model
{
	function __construct()
	{	
		parent::__construct();
	}
	
	public function get_industry_id($indus_type)
	{
		if(!empty($indus_type)){
			$this->db->select('*');
			$this->db->from('industry');
			//$this->db->join('contest', 'contest.industry = industry.id', 'left'); 
			$this->db->where('industry_name',$indus_type);
			$query = $this->db->get();
			$res = $query->result_array();
			return $res[0]['id'];
		}
	}
	
	function check_user_login()
	{
		if(($this->session->userdata('user_id')!='')&&($this->session->userdata('user_name')!=''))
		{
			return true;
		}
		else
		{
			$this->session->set_flashdata('login_required','<div class="alert alert-block alert-warning" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Please login and continue...</div>');
			redirect('admin/loginForm');
		}
	}
	
	function check_client_login()
	{
		if(($this->session->userdata('user_id')!='')&&($this->session->userdata('user_name')!='')&&($this->session->userdata('user_type')==0))
		{
			return true;
		}
		else
		{
			$this->session->set_flashdata('client_login_required','<div class="alert alert-block alert-warning" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Please login as client and continue...</div>');
			redirect('admin/loginForm');
		}
	}
	
	function check_designer_login()
	{
		if(($this->session->userdata('user_id')!='')&&($this->session->userdata('user_name')!='')&&($this->session->userdata('user_type')==1))
		{
			return true;
		}
		else
		{
			$this->session->set_flashdata('designer_login_required','<div class="alert alert-block alert-warning" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Please login as designer and continue...</div>');
			redirect('admin/loginForm');
		}
	}
   
	/*public function insert_brief_details($insert_data)
	{
		//echo '<pre>'; print_r($insert_data); exit;
		
		print_r($insert_data);
		$contest_type = $insert_data['contest_type'];
		$data_insert  = $insert_data['podata'];
		switch ($contest_type) {
				case 'logodesign':
					
					$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$logo_extras = array(
						'tagline' => $data_insert['logo_tag_line'],
						'slider1' => $data_insert['fem_mas'],
						'slider2' => $data_insert['sim_com'],
						'slider3' => $data_insert['mod_lux'],
						'slider4' => $data_insert['ply_ser'],
						'slider5' => $data_insert['mod_vin'],
						'slider6' => $data_insert['spo_ele'],
						
						'color1' => $data_insert['color1'],
						'color2' => $data_insert['color2'],
						'color3' => $data_insert['color3'],
						'color4' => $data_insert['color4'],
						
						'ideas' => $data_insert['logo_style_idea']
					);
					
					$data['extras'] = serialize($logo_extras);
					
				break;
				case 'webdesign' :
					$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['background_info'] = $data_insert['c_b_w_a'];
					$data['content_details'] =  $data_insert['condet'];


					$visual_style = array(
						'org_name' => $data_insert['org_bus'],
						'website_address' => $data_insert['r_w_a'],
						'ideas' => $data_insert['creative_b_msg_area'],
						'describesite' => $data_insert['ref_website'],
					);
					$data['visual_style'] =  serialize($visual_style);

					$other_details = array(
						'designersinfo' => $data_insert['comm_design'],
						'coding_type' => $data_insert['coding_type']
					);
					$data['other_details'] =  serialize($other_details);
				break;

				case 'tshirtdesign' :
				  	$data['contest_title'] = $data_insert['cont_tit'];
		   			$data['contest_title'] = $data_insert['cont_desc'];
		   			$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['size'] = $data_insert['ts_size'];
					
					$data['background_info'] = $data_insert['tshirt_for'];
					$data['content_details'] = $data_insert['choose_tshirt'];
					$visual_style = array(
						'specific_color' => $data_insert['color_mind'],
						'ideas' => $data_insert['visual_style_idea']
					);
					$data['visual_style'] =  serialize($visual_style);
					$data['other_details'] =  $data_insert['comm_design'];
					break;

				case 'businesscarddesign' :
					$data['contest_title'] = $data_insert['cont_tit'];
		   			$data['contest_title'] = $data_insert['cont_desc'];
		   			$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['size'] = $data_insert['ts_size'];
					$data['content_details'] = $data_insert['flyer_con_detail'];
					$data['visual_style'] = $data_insert['visual_style'];
					$other_details = array(
						'designersinfo' => $data_insert['comm_design'],
						'radio_bus' => $data_insert['radio_bus']
					);
					$data['other_details'] =  serialize($other_details);
					break;

				
				default:
					$data['contest_title'] = $data_insert['cont_tit'];
		   			$data['contest_title'] = $data_insert['cont_desc'];
		   			$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['size'] = $data_insert['ts_size'];
					$data['background_info'] = $data_insert['w_org_nam'];
					$data['content_details'] = $data_insert['flyer_con_detail'];
					$data['visual_style'] = $data_insert['visual_style'];
					$data['other_details'] =  $data_insert['comm_design'];
					break;
			}
			
			//$this->db->insert('contest', $data);
			
	}*/
	
	
	 public function opencontestlist()
    {
         $query = $this->db->query("SELECT * FROM `contest` WHERE `admin_status` = 1 AND `delete_status` =0 AND `status` != 'completed' and `status` != 'judging' ORDER by upgrade_featured_contest DESC, published_date DESC");
         if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }
    }
	
	public function opencontestcount()
    {
         $query = $this->db->query("SELECT COUNT(*) AS `numrows` FROM `contest` WHERE `admin_status` = 1 AND `delete_status` =0 AND `status` != 'completed' and `status` != 'judging' and `status` != 'draft' ");
         if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			 return $result->numrows;
		 }else
		 {
			 return false;
		 }
    }
	
	public function ex_opencontestlist()
    {
        
         $query = $this->db->query("SELECT * FROM `contest` WHERE `admin_status` = 1 AND `delete_status` =0 AND `status` != 'completed' and `status` != 'judging' and duration_hours !='' ORDER BY `id` DESC ");
         if($query->num_rows() > 0)
		 {
			 return $query->result();
		 }else
		 {
			 return false;
		 }
    }
	
	public function ex_opencontestcount()
    {
         $query = $this->db->query("SELECT COUNT(*) AS `numrows` FROM `contest` WHERE `admin_status` = 1 AND `delete_status` =0 AND `status` = 'open' and time_format(timediff( `close_date`, CONVERT_TZ(now(),'+00:00', `user_timezone`)),'%H')<= 24 ");
		 
		 
         if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			 return $result->numrows;
		 }else
		 {
			 return false;
		 }
    }
	
	public function portfoliolist($contest_type="", $industry="")
    {	

		$filter_con="";
		if(!empty($contest_type)){
			$filter_con .= " and c.contest_type='$contest_type'";
		}
		if(!empty($industry)){
			$filter_con .= " and c.industry='$industry'";
		}
		
         $query = $this->db->query("SELECT * FROM `contest` c, `designs` d WHERE c.admin_status =1 and c.status = 'completed'and c.delete_status = 0 and c.id = d.contest_id and d.design_status = 1 $filter_con order by c.id DESC");
       
         
         if($query->num_rows() > 0)
		 {
			 $result = $query->result();
			 return $result;
		 }else
		 {
			 return false;
		 }
    }
    public function get_portfoliolist_count($contest_type="", $industry="")
    {	

		$filter_con="";
		if(!empty($contest_type)){
			$filter_con .= " and c.contest_type='$contest_type'";
		}
		if(!empty($industry)){
			$filter_con .= " and c.industry='$industry'";
		}
		
         $query = $this->db->query("SELECT * FROM `contest` c, `designs` d WHERE c.admin_status =1 and c.status = 'completed'and c.delete_status = 0 and c.id = d.contest_id and d.design_status = 1 $filter_con order by c.id DESC");
       
        return $query->count_all_results();	 
        //return $this->db->count_all_results();	 
        /* if($query->num_rows() > 0)
		 {
			 $result = $query->result();
			return $this->db->count_all_results();	
		 }else
		 {
			 return false;
		 }*/
    }
	
	
	public function portfoliolistlimit()
    {

         $query = $this->db->query("SELECT c.id, c.contest_title, c.org_name, c.client_id, c.contest_prize, c.contest_type, d.design_id, d.design_name, d.design_rating, t.message, t.createdTime FROM `contest` c, `designs` d, `testimony` t WHERE c.admin_status =1 and c.status = 'completed' and c.delete_status = 0 and c.id = d.contest_id and d.design_status = 1 and c.id= t.contest_id order by t.createdTime DESC LIMIT 10");
         if($query->num_rows() > 0)
		 {
			 $result = $query->result();
			 return $result;
		 }
		 else
		 {
			 return false;
		 }
    }
	
	public function designer_transaction($did){
		$this->db->select('t.*,r.reward_msg');
		$this->db->from('transaction t');
		$this->db->join('rewards r','r.id = t.reward_id');
		$this->db->where('t.designer_id',$did);
		$this->db->order_by("t.trans_date",'DESC');
		$query = $this->db->get()->result();
		return $query;	
	}

	public function referral_transaction($rid){
		$this->db->select('*');
		$this->db->from('referral_transaction ');
		$this->db->where('ref_id',$rid);
		$this->db->order_by("trans_date",'DESC');
		$query = $this->db->get()->result();
		return $query;	
	}
	
	public function designers_rank_list($start)
    {
         $query = $this->db->query("SELECT @rank := @rank + 1 AS rank, dt.*, (select count(design_status) FROM designs wt where design_status=1 and wt.designer_id=dt.users_id) won, (select count(final_status) FROM designs ft where final_status=1 and ft.designer_id=dt.users_id) final, (select count(distinct(contest_id)) FROM designs pt where pt.designer_id=dt.users_id)part FROM `designer_table` dt, (SELECT @rank := $start) r ORDER BY `won` DESC, final DESC LIMIT $start,10");
         $result = $query->result();
		 return $result;	
    }
	
	public function designers_search_list($search_text)
    {
         $query = $this->db->query("select * from (SELECT @rank := @rank + 1 AS rank, dt.*, (select count(design_status) FROM designs wt where design_status=1 and wt.designer_id=dt.users_id) won, (select count(final_status) FROM designs ft where final_status=1 and ft.designer_id=dt.users_id) final, (select count(distinct(contest_id)) FROM designs pt where pt.designer_id=dt.users_id)part FROM `designer_table` dt, (SELECT @rank := 0)r ORDER BY `won` DESC, final DESC)res where res.designer_name like '%".$search_text."%'");
         $result = $query->result();
		 return $result;	
    }
	
	public function designers_user_rank($uid)
    {
         $query = $this->db->query("select * from (SELECT @rank := @rank + 1 AS rank, dt.*, (select count(design_status) FROM designs wt where design_status=1 and wt.designer_id=dt.users_id) won, (select count(final_status) FROM designs ft where final_status=1 and ft.designer_id=dt.users_id) final, (select count(distinct(contest_id)) FROM designs pt where pt.designer_id=dt.users_id)part FROM `designer_table` dt, (SELECT @rank := 0)r ORDER BY `won` DESC, final DESC)res where res.users_id='".$uid."'");
         $result = $query->result();
		 return $result;	
    }
	
	public function designer_contest_type($uid)
    {
         $query = $this->db->query("select distinct(ca.display_name)contest_type from category ca,contest co where ca.code=co.contest_type and co.id in (SELECT DISTINCT(contest_id) FROM `designs` WHERE `designer_id`=$uid)");
         $result = $query->result();
		 return $result;	
    }
	
	public function contest_designers($par_id)
	{
		$query=$this->db->query("select DISTINCT(designer_id) FROM designs where contest_id = $par_id");
		$result = $query->result();
		return $result;
	}
	
	public function contest_fianlist($par_id)
	{
		$query=$this->db->query("select DISTINCT(designer_id) FROM designs where contest_id = $par_id and final_status=1");
		$result = $query->result();
		return $result;
	}

	public function run_key() {

   		$length="10"; // Define length of the Random string.
		$char="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; // Define characters which you needs in your random string
		$random=substr(str_shuffle($char), 0, $length); // Put things together.
    	return $random;
}
	public function get_referral_id($user_id){
		$query = $this->db->query("select user_referral_code  from user_table where user_id=$user_id;");
		$result = $query->row();
		return $result->user_referral_code;
	}
	public function get_referral_code($referral_id){
		$query = $this->db->query("select user_referral_code  from user_table where user_referral_code='$referral_id';");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->user_referral_code;
		 }else
		 {
			 return false;
		 }
	}
	public function verify_referral_code($referral_code="",$userid=""){

		$query = $this->db->query("select user_referral_code from user_table where user_referral_code='$referral_code';");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->user_referral_code;
		 }else
		 {
			 return false;
		 }
	}

	/*public function already_used_code($referral_code="",$userid=""){

		$query = $this->db->query("select referral_code from coupon_code where referral_code='$referral_code'  and user_id ='$userid'  ;");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->referral_code;
		 }else
		 {
			 return false;
		 }
	}*/

	public function user_referral_code($referral_code="",$userid=""){

		$query = $this->db->query("select user_referral_code from user_table where user_referral_code='$referral_code'  and user_id ='$userid'  ;");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->user_referral_code;
		 }else
		 {
			 return false;
		 }
	} 

	public function allow_referral_code($ref_code="",$userid=""){

		$query = $this->db->query("select count(ref_code) as ref_code from referral_code where  user_id ='$userid' ;");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->ref_code;
		 }else
		 {
			 return false;
		 }
	}

	public function allow_user_code(){

		$query = $this->db->query("select referral_allow_user from update_package ;");
			$result = $query->row();
			return $result->referral_allow_user;
		
	}
	
	public function get_referral_contestid($contest_id){
		$userid = $this->session->userdata('user_id');
		$query = $this->db->query("select con.referral_code as referral_code from contest con inner join user_table usr on usr.user_id = con.client_id where con.id='$contest_id' and usr.user_id = $userid ");
		$result=$query->row();
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->referral_code;
		 }else
		 {
			 return false;
		 }
	}
	public function get_referral_amount(){
		$query = $this->db->query("select referral_amount from update_package");
		$result=$query->row();
		return $result->referral_amount;
	}
}
?>