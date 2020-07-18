<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model
{
	function __construct()
	{	
		parent::__construct();
	}
	
    //common for all
    public function insert_record($table,$values)
	{		
		$this->db->insert($table,$values);
		return $this->db->insert_id();	
	}
	
	public function update_record($table,$values,$where)
	{
		$this->db->where($where); 	
		$this->db->update($table,$values);
	}
	
	//Select the single record from db
	public function get_record($table,$fields='*',$where='')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			return $this->db->get($table)->row();					
	}
	
	//Select the multiple records from db
	public function get_records($table,$fields='*',$where='')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			return $this->db->get($table)->result();		
			
	}
	
	//Select multiple records using order by
	public function get_records_order_by($table,$fields='*',$where='',$orderby,$type = 'ASC')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			$this->db->order_by($orderby, $type); 
			return $this->db->get($table)->result();		
			
	}
	
	//Select single record using order by
	public function get_record_order_by($table,$fields='*',$where='',$orderby,$type = 'ASC')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			$this->db->order_by($orderby, $type); 
			return $this->db->get($table)->row();	
			
	}
	
	//Select single record using order by
	public function get_records_orderby_limit($table,$fields='*',$where='',$orderby,$type = 'ASC',$limit,$start)
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			$this->db->order_by($orderby, $type);
			$this->db->limit($limit, $start);			
			return $this->db->get($table)->result();	
			
	}
	
	public function delete_record($table,$where)
	{
		$this->db->where($where); 	
		$this->db->delete($table);
	}
	
	//Select the count multiple records from db
	public function get_records_count($table,$where='')
	{
		if(!empty($where))
			$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();	
			
	}
	
	//sum the particular column values
	public function get_records_sum($table,$field,$as,$where='')
	{
		$this->db->select_sum($field,$as);
		if(!empty($where))
			$this->db->where($where);
		
		return $this->db->get($table)->row();
			
	}
	
	//Select the multiple records from db using Where Class in
	public function get_records_in($table,$fields='*',$col, $where)
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where_in($col,$where);
			return $this->db->get($table)->result();		
			
	}
	
	public function get_records_like($table, $fields='*',$where='', $like){
		if($fields)
			$this->db->select($fields);
		if(!empty($where))
			$this->db->where($where);
		if(!empty($like))
			$this->db->like($like);
		return $this->db->get($table)->result();
	}
	
	//Select the multiple records from db using Where Class in
	public function get_records_notin($table, $fields='*',$where='', $col, $notin_data)
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			if(!empty($notin_data))
				$this->db->where_not_in($col,$notin_data);
			return $this->db->get($table)->result();		
			
	}
	
	//Select the multiple records from db using Where Class in
	public function get_records_notin_orderby($table, $fields='*',$where='', $col, $notin_data,$orderby)
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			if(!empty($notin_data))
				$this->db->where_not_in($col,$notin_data);
			if(!empty($orderby))
				foreach($orderby as $ord)
				$this->db->order_by($ord);
			return $this->db->get($table)->result();		
			
	}
	
	//Select the multiple records from db using Where Class in
	public function get_records_notin_orderby_limit($table, $fields='*',$where='', $col, $notin_data, $orderby, $limit, $start){
		
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			if(!empty($notin_data))
				$this->db->where_not_in($col,$notin_data);
			if(!empty($orderby))
				foreach($orderby as $ord)
				$this->db->order_by($ord);
			$this->db->limit($limit, $start);		
			return $this->db->get($table)->result();
			
	}
	
	public function get_records_in_orderby($table,$fields='*',$col, $where,$orderby,$type = 'ASC')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where_in($col,$where);
			$this->db->order_by($orderby, $type); 
			return $this->db->get($table)->result();		
			
	}
	
	//Select the multiple records from db
	public function get_records_unique($table,$fields='*',$where='')
	{
			if($fields)
				$this->db->distinct();
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			return $this->db->get($table)->result();		
			
	}
	
	
	//Select the count multiple records from db
	public function get_records_count_col($table,$fields='*',$where='')
	{
		if(!empty($where))
			$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();	
			
	}
	
	
	/* Client Add Function */
	public function add_client_data(){
		$referral= $this->Contest_model->run_key('alpha','10');
		$this->db->insert("user_table", array("user_name" =>$_POST["client_name"],"user_email" => $_POST["client_email"],"user_pwd" => $_POST["client_password"],"user_country" => $_POST["client_country"], "user_mobile"=> $_POST["client_moblie"],"created_date"=> date('Y-m-d H:i:s'),"user_status"=>"1","user_type"=>"0","user_referral_code"=>$referral));
		
		$insert_id = $this->db->insert_id();
		$insert = array("name" =>$_POST["client_name"],
							"email" => $_POST["client_email"],						
							"password" => $_POST["client_password"],
							"country" =>$_POST["client_country"],
							"mobile"=> $_POST["client_moblie"],
							"created_date"=> date('Y-m-d H:i:s'),
							"status"=>"1",
							"users_id"=>$insert_id);
							
		$this->db->insert("client_table",$insert);
		return $insert_id;					
	}
	
	/* Designer Add Function */
	public function add_designer_data()
	{
		$referral= $this->Contest_model->run_key('alpha','10');
		$this->db->insert("user_table", array("user_name" =>$_POST["designer_name"], "user_email" => $_POST["designer_email"],"user_pwd" => $_POST["designer_password"], "user_country" => $_POST["designer_country"], "user_mobile"=> $_POST["designer_moblie"], "created_date"=> date('Y-m-d H:i:s'),"user_status"=>"1","user_type"=>"1","user_referral_code"=>$referral));
        
		$insert_id = $this->db->insert_id();
		$add_designer = array("designer_name" =>$_POST["designer_name"],
							"designer_email" => $_POST["designer_email"],						
							"designer_password" => $_POST["designer_password"],
							"designer_country" =>$_POST["designer_country"],
							"mobile"=> $_POST["designer_moblie"],
							"paypal_email" => $_POST["paypal_email"],
							"account_number" =>	 $_POST["account_number"],
							"bank_name" =>	 $_POST["bank_name"],
							"bank_branch" => $_POST["bank_branch"],	
							"ifsc_code" =>	 $_POST["ifsc_code"],
							"account_holder" =>	 $_POST["account_holder"],
							"created_date"=> date('Y-m-d H:i:s'),
							"designer_status"=>"1",
							"users_id"=>$insert_id);
							
			//echo "<pre>"; print_r($add_designer);exit;
			$this->db->insert("designer_table",$add_designer);
			
		return $insert_id;				
	}
	
	/* Referral Add Function */
	public function add_referral_data()
	{
		$referralid = $this->Contest_model->run_key('alpha','10');
		$this->db->insert("user_table", array("user_name" =>$_POST["referral_name"], "user_email" => $_POST["referral_email"],"user_pwd" => $_POST["referral_password"], "user_country" => $_POST["referral_country"], "user_mobile"=> $_POST["referral_moblie"], "created_date"=> date('Y-m-d H:i:s'),"user_status"=>"1","user_type"=>"1","user_referral_code"=>$referralid));
        
		$insert_id = $this->db->insert_id();
		$add_referral = array("referral_name" =>$_POST["referral_name"],
							"referral_email" => $_POST["referral_email"],	
							"referral_password" => $_POST["referral_password"],
							"referral_country" =>$_POST["referral_country"],
							"mobile"=> $_POST["referral_moblie"],
							"paypal_email" => $_POST["paypal_email"],
							"account_number" =>	 $_POST["account_number"],
							"bank_name" =>	 $_POST["bank_name"],
							"bank_branch" => $_POST["bank_branch"],	
							"ifsc_code" =>	 $_POST["ifsc_code"],
							"account_holder" =>	 $_POST["account_holder"],
							"created_date"=> date('Y-m-d H:i:s'),
							"referral_status"=>"1",
							"users_id"=>$insert_id,
							"referral_intro"=>"i'am a Referral");
							
			//echo "<pre>"; print_r($add_designer);exit;
			$this->db->insert("referral_table",$add_referral);
			
		return $insert_id;				
	}
	public function checklogin($email, $pass)
	{
		$query = $this->db->query("select * from user_table where user_email='$email' and user_pwd = '$pass'");
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		}
		else{
			return FALSE;
		}
	}
	
	public function get_client_details($user_id)
    {
        $this->db->select('*');
	    $this->db->from('client_table');
		$this->db->join('user_table','user_table.user_id = client_table.users_id');
	    $this->db->where('client_table.users_id',$user_id);
	    $query = $this->db->get();

	    $result = $query->result();
	    
	    return $result;
    }
	
	public function get_designer_details($user_id)
    {
        $this->db->select('*');
	    $this->db->from('designer_table dt');
		$this->db->join('user_table ut','ut.user_id = dt.users_id');
	    $this->db->where('`ut`.`user_id`',$user_id);
	    $query = $this->db->get();
	    $result = $query->result();	    
	    return $result;
    }

        public function get_referral_details($user_id)
    {
        $this->db->select('*');
	    $this->db->from('referral_table rt');
		$this->db->join('user_table ut','ut.user_id = rt.users_id');
	    $this->db->where('`ut`.`user_id`',$user_id);
	    $query = $this->db->get();
	    $result = $query->result();	    
	    return $result;
    }
    
    
	public function counts($table,$feiled,$where='')
	{
		if(!empty($where))
			$this->db->select($feiled);  
			$this->db->where($where);
			$this->db->from($table);
			$query = $this->db->get();
			 $result = $query->num_rows();
			 return $result;
		
		

	}
	
	
	public  function balanceinfo($designer_id)
	{
		$query=$this->db->query("select sum(designer_credit.price_amount)cbal from designer_credit LEFT OUTER JOIN designer_debit on (designer_credit.contest_id=designer_debit.contest_id AND designer_credit.designer_id=designer_debit.designer_id) WHERE designer_credit.designer_id=$designer_id AND (designer_debit.req_status=0 ||designer_debit.req_status IS NULL)");
		$result = $query->result();
		return $result;	
	}
	
	public function status($designer_id,$contest_id)
	{
		$query=$this->db->query("SELECT * FROM `designs` WHERE designer_id=$designer_id and contest_id=$contest_id and (final_status=1 || design_status=1)");
		$result = $query->result();
		return $result;
	}
		
	public function payment_request($designer_id)
	{
		$query=$this->db->query("select designer_credit.* from designer_credit LEFT OUTER JOIN designer_debit on (designer_credit.contest_id=designer_debit.contest_id AND designer_credit.designer_id=designer_debit.designer_id) WHERE designer_credit.designer_id=$designer_id AND (designer_debit.req_status=0 ||designer_debit.req_status IS NULL)");
		$result = $query->result();
		return $result;
	}
	
	public function totalearn($designer_id)
	{
		$query=$this->db->query("SELECT sum(reward_value)toatal_earn from rewards WHERE designer_id=$designer_id and reward_type in(0,1)");
		$result = $query->result();
		return $result;
	}


	public function get_records_groupby($table,$fields='*',$where='',$designer_id,$orderby,$type='DESC')
	{
		if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			 $this->db->group_by($designer_id);
			 if(!empty($orderby))
			 $this->db->order_by($orderby, $type);
			return $this->db->get($table)->result();		
			
	}

	public function designer_page_current_balance($designer_id){
		$result =$this->db->select('sum(price_amount)amount')
				->from('designer_credit')
				->where('designer_id',$designer_id)
				->where('contest_id NOT IN (SELECT contest_id FROM designer_debit WHERE designer_id='.$designer_id.')',NULL,FALSE)->get()->result();
		$balance= ($result[0]->amount!='')?$result[0]->amount:0;
		return $balance;
	}

	public function designer_pending_req_balance($designer_id){
		$result =$this->db->select('sum(trans_balance)amount')
				->from('designer_transaction')
				->where('designer_id',$designer_id)
				->where('trans_type',1)
				->where('pay_req_status',1)->get()->result();
		$balance= ($result[0]->amount!='')?$result[0]->amount:0;
		return $balance;
	}

	public function get_records_orderby_multi($table,$fields='*',$where='',$orderby1,$orderby2,$type){
		if($fields)
			$this->db->select($fields);
		if(!empty($where))
			$this->db->where($where);
			$this->db->order_by($orderby1, $type); 
			$this->db->order_by($orderby2, $type); 
			return $this->db->get($table)->result();				
	}
	public function get_category($contest_id){
		  $query = $this->db->query("select c.cp_pack_name from contest a inner join category_type b on b.ct_id = a.contest_type inner join category_package c on c.cp_id = b.cp_id where a.id= $contest_id");
	  return $query->row();
	}

	public function get_referral_id($user_id){
		$query = $this->db->query("select r.id as ref_id from referral_table r inner join user_table u on u.user_id = r.users_id where r.users_id='$user_id'");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
		return $result->ref_id;
		 }else
		 {
			 return false;
		 }
	}

	public function request_referral_amount($ref_id)
	{
		$query=$this->db->query("SELECT sum(request_old_amount) as request_old_amount from referral_payment_request  WHERE ref_id='$ref_id'");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
		return $result->request_old_amount;
		 }else
		 {
			 return false;
		 }
	}
	
	public function totalearn_referral($referral_id)
	{
		/*$query=$this->db->query("SELECT sum(ref_amount) as ref_amount from referral_code  WHERE ref_code='$referral_id'");*/
		$query=$this->db->query("SELECT sum(a.ref_amount) as ref_amount from referral_code a INNER join contest b on b.id=a.contest_id WHERE a.ref_code='$referral_id' and b.status='open'");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
		return $result->ref_amount;
		 }else
		 {
			 return false;
		 }
	}
}
