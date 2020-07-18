<?php
function is_user_logged_in(){
	$CI = get_instance();
	$user_id = $CI->session->userdata('user_id');
	if($user_id)
		return $user_id;
	else
		return false;
}

function user_id(){
	$CI = get_instance();
	$user_id = $CI->session->userdata('user_id');
	if($user_id)
		return $user_id;
	else
		return false;
}

function is_admin_logged_in(){
	$CI = get_instance();
	return $CI->session->userdata('admin_id');
}

function admin_mail(){
	return "contesthours@gmail.com";
}

function time2string($timeline) {
    $periods = array('day' => 86400, 'hour' => 3600, 'minute' => 60);
	$ret = "";$coma='';
    foreach($periods AS $name => $seconds){
        $num = floor($timeline / $seconds);
        $timeline -= ($num * $seconds);
		if($name=='day' && $num==0){
			$ret='';
		}
		else{
			$ret .= $coma.$num.' '.ucwords($name).(($num > 1) ? 's' : '');
			$coma=', ';
		}
    }
	
	$pos = strpos(trim($ret), '-');
	if($pos === false)		
		return trim($ret);
	else 
		return 'Time Out';
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
	
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' Ago' : 'just now';
}

//Function to get the private comments 
function payment_status($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_record("contest",'pay_option',array("id"=>$cid,'status'=>0));
	
	if(isset($data))
		return $data->pay_option;
	else
		return 0;
}

//Function to get the private comments 
function design_comment($designid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_records("design_comments",'*',array("design_id"=>$designid,'status'=>0));
	if(isset($data))
		return $data;
	else
		return 0;
}

function get_payable_price(){
	$CI = get_instance();
    $CI->load->model("Common_model");
	$res = $CI->Common_model->get_record("pricing_percentage",'payable_price');
	if(!empty($res))
		return ucwords($res->payable_price);
}

function get_name(){
	$CI = get_instance();
    $CI->load->model("Common_model");
	$id = $CI->session->userData('user_id');
	$user = $CI->Common_model->get_record("user_table",'user_name',array("user_id"=>$id));
	if(!empty($user))
		return ucwords($user->user_name);
}

function last_logged_in($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_record("user_table",'last_logged_in',array("user_id"=>$id));
	if(isset($data))
		return $data->last_logged_in;
	else
		return 0;
}

function username($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("user_table",'user_name',array("user_id"=>$id));
	if(isset($data))
		return $data->user_name;
	else
		return 0;
}

function d_imagename($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("designs",'design_name',array("design_id"=>$id));
	if(isset($data))
		return $data->design_name;
	else
		return 0;
}

function design_clientid($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("designs",'client_id',array("design_id"=>$id));
	if(isset($data))
		return $data->client_id;
}

function design_designerid($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("designs",'designer_id',array("design_id"=>$id));
	if(isset($data))
		return $data->designer_id;
}

function designer_tableid($uid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("designer_table",'id',array("users_id"=>$uid));
	if(isset($data))
		return $data->id;
}

function designer_email($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("designer_table",'designer_email',array("users_id"=>$id));
	if(isset($data))
		return $data->designer_email;
	
}

function get_email($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_record("user_table","user_email",array("user_id"=>$id));
	if(isset($data))
		return $data->user_email;
}
function get_mobile($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_record("user_table","user_mobile",array("user_id"=>$id));
	if(isset($data))
		return $data->user_mobile;
}

function paypal_id($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("designer_table",'paypal_email',array("users_id"=>$id));
	if(isset($data))
		return $data->paypal_email;
}

function paypal_referral_id($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("referral_table",'paypal_email',array("users_id"=>$id));
	if(isset($data))
		return $data->paypal_email;
}

function messagecount($id){
	$CI = get_instance();
	$CI->load->model("Common_model");	
	$data = $CI->Common_model->get_records_count("design_comments",array("toview_id"=>$id,"read"=>0,"status"=>0));
	if(isset($data))
		return $data;
	else
		return 0;
}

function notificationcount($id){
	$CI = get_instance();
	$CI->load->model("Common_model");	
	$data = $CI->Common_model->get_records_count("client_notification",array("to_id"=>$id,"read_status"=>0,"status"=>0));
	if(isset($data))
		return $data;
	else
		return 0;
}

function designcount($contestid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_records_count("designs",array("contest_id"=>$contestid, "display_status"=>0));
	if(isset($data))
		return $data;
	else
		return 0;
}

function designer_count($contestid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_records("designs","DISTINCT(designer_id)",array("contest_id"=>$contestid, "display_status"=>0));
	if(isset($data))
		return count($data);
	else
		return 0;
}

function referral_designcount($uid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_records_count("referral_code",array("user_id"=>$uid, "ref_status"=>0));
	if(isset($data))
		return $data;
	else
		return 0;
}

function designer_designcount($uid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_records_count("designs",array("designer_id"=>$uid, "display_status"=>0));
	if(isset($data))
		return $data;
	else
		return 0;
}

function contest_design_no($design_id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_record("designs","design_no",array("design_id"=>$design_id));
	if(isset($data))
		return (!empty($data->design_no))?$data->design_no:$data->design_no;
	else
		return "";
}

function contestname($contestid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("contest","contest_title, org_name",array("id"=>$contestid));
	if(isset($data))
		return (!empty($data->contest_title))?$data->contest_title:$data->org_name;
	else
		return "";
}

function express_count(){
	$CI = get_instance();
	$CI->load->model("Contest_model");
	$data = $CI->Contest_model->ex_opencontestcount();
	if(isset($data))
		return $data;
	else
		return "0";
}

function client_contest_count($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records_count("contest",array("client_id"=>$cid, "status!="=>'draft'));
	if(isset($data))
		return $data;
	else
		return "0";
}

function client_draftcontest($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records_count("contest",array("client_id"=>$cid, "status"=>'draft'));
	if(isset($data))
		return $data;
	else
		return "0";
}

function client_livecontest($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records_count("contest",array("client_id"=>$cid, "status"=>'open'));
	if(isset($data))
		return $data;
	else
		return "0";
}

function client_judgingcontest($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records_count("contest",array("client_id"=>$cid, "status"=>'judging'));
	if(isset($data))
		return $data;
	else
		return "0";
}

function client_completecontest($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records_count("contest",array("client_id"=>$cid, "status"=>'completed'));
	if(isset($data))
		return $data;
	else
		return "0";
}

//Function to send the email from template
function rp_send_email_old($to, $subject, $message, $from = 'noreply@contesthours.com'){
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: Contest Hours <$from>" . "\r\n".'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
}

//Function to send the email from template
function rp_send_email($to, $subject, $message, $from="noreply@contesthours.com", $bcc=""){

	$CI = get_instance();
	$CI->load->library('email');
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.zoho.com';
		$config['smtp_port']    = '465';
		$config['smtp_user']    = 'noreply@contesthours.com';
		$config['smtp_pass']    = 'Contest555';
		
		/* $config['smtp_host'] = 'ssl://smtp.googlemail.com'; //Gmail SMTP
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'contesthours@gmail.com';
		$config['smtp_pass'] = 'infantjesus_123'; */
		
		$config['smtp_timeout'] = '10';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not   
		$CI->email->initialize($config);
		$CI->email->from($from, 'Contesthours');
		$CI->email->to($to); 
		if(!empty($bcc)){
			$CI->email->bcc($bcc);
		}
		$CI->email->subject($subject);
		$CI->email->message($message);  
		$CI->email->send();

		echo $CI->email->print_debugger();
}

function hours_cal($days){
	$thours = $days * 24;
	return $thours;
}
 
function getminval(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("update_package","min_price");
	if(isset($data))
		return $data->min_price;
	else
		return "0";
}

function client_name($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("user_table",'user_name',array("user_id"=>$id));
	if(isset($data))
		return $data->user_name;
	else
		return 0;
}

function client_proimage($id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("client_table",'profile',array("id"=>$id));
	if(isset($data))
		return $data->profile;
	
}

function suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
        switch($num % 10){
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

function remaining_days($date1='',$date2=''){
	$now = new DateTime($date1);
	$future_date = new DateTime($date2);
	$interval = $future_date->diff($now);
	return $interval->format("%a");
}
function remaining_time($date1='',$date2=''){
	$now = new DateTime($date1);
	$future_date = new DateTime($date2);
	$interval = $future_date->diff($now);
	$hours=($interval->format("%a")==0)?'':$interval->format("%a")." days, ";
	$minutes=$interval->format("%h hours, %i mins ");
	return $hours.$minutes;
}

function country_name($country_code){
	$CI = get_instance();
	$CI->load->model("Common_model");
	
	$data = $CI->Common_model->get_record("country_tb",'country_name',array("country_code"=>$country_code));
	if(isset($data))
		return $data->country_name;
	else
		return 0;
}

function admin_notifications(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data['notificatios'] = $CI->Common_model->get_records_orderby_limit("notification",'*','','noti_entry_time','desc',10,0);
	$data['not_new']=$CI->Common_model->get_records_count("notification",array("noti_new_status"=>0));
	$data['not_unread']=$CI->Common_model->get_records_count("notification",array("noti_view_status"=>0));
	return $data;
}

function notiTiming($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hr',
        60 => 'min',
        1 => 'sec'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'')." ago";
    }
}

function notification_types(){
	$data= array(
	0=>"New Contest Created",
	1=>"New Disigner Registered",
	2=>"New Client Registered",
	3=>"Winner Chosen For A Contest",
	4=>"Package Confirmed By Client",
	5=>"Design Court Report",
	6=>"New Designer Payment Request",
	7=>"New Referral Registered",
	);
	return $data;
}

function noti_pages(){
	$data= array(
	0=>"contest_view",
	1=>"designer_single_view",
	2=>"client_single_view",
	3=>"contest_view",
	4=>"contest_view",
	5=>"report_data_view",
	6=>"view_payment_rquest",
	7=>"view_page_referral",
	);
	return $data;
}

function designer_balance($designer_id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$balance=$CI->Common_model->get_records_orderby_limit("transaction",'trans_new_balance',array("designer_id"=>$designer_id),'trans_date','desc',1,0);
	
	$bal=(isset($balance[0]->trans_new_balance) && !empty($balance[0]->trans_new_balance))?$balance[0]->trans_new_balance:0.00;
	return $bal;
}

function referral_balance($ref_id){
	$CI = get_instance();
	$CI->load->model("Contest_model");
	$ref_code = $CI->Contest_model->get_referral_id($ref_id);
	$CI->load->model("Common_model");
	$balance = $CI->Common_model->totalearn_referral($ref_code);
	/*$balance=$CI->Common_model->get_records_orderby_limit("referral_transaction",'trans_amount',array("ref_id"=>$ref_id),'trans_date','desc',1,0);*/
	
	$request_amount = $CI->Common_model->request_referral_amount($ref_id);
	$amount = $balance - $request_amount;
	$bal=(isset($amount) && !empty($amount))?$amount:0.00;
	return $bal;
}

function referral_request_balance($ref_id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$request_amount = $CI->Common_model->get_record("referral_payment_request",'request_amount',array("ref_id"=>$ref_id));
	$bal=(isset($request_amount) && !empty($request_amount))?$request_amount:0.00;
	return $bal;
}

function contest_testimoneytime($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$res=$CI->Common_model->get_record("testimony",'createdTime',array("contest_id"=>$cid));
	
	$msg=(empty($res->createdTime))?"":$res->createdTime;
	return $msg;
}

function contest_testimoney($cid){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$res=$CI->Common_model->get_record("testimony",'message',array("contest_id"=>$cid));
	
	$msg=(empty($res->message))?"":$res->message;
	return mb_strimwidth($msg, 0,100, '...');
	//return $msg;
}

function pagination($url, $rowscount, $per_page,$segment=3) {
	$ci = get_instance();
	$ci->load->library('pagination');
	
	$config = array();
	$config["base_url"] = base_url($url);
	$config["total_rows"] = $rowscount;
	$config["per_page"] = $per_page;
	$config["uri_segment"] = $segment;
	$config['full_tag_open'] = '<div class="col-md-4 offset-8 text-right" ><ul class="pagination">';
	$config['full_tag_close'] = '</ul></div>';
	$config['num_tag_open'] = '<li class="page-link">';
	$config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active page-item"><a  class="page-link">';
	$config['cur_tag_close'] = '</a></li>';
	$config['next_tag_open'] = '<li  class="page-link">';
	$config['next_tag_close'] = '</li>';
	$config['prev_tag_open'] = '<li  class="page-link">';
	$config['prev_tag_close'] = '</li>';
	$config['first_link'] = 'First';
	$config['first_tag_open'] = '<li  class="page-link">';
	$config['first_tag_close'] = '</li>';
	$config['last_link'] = 'Last';
	$config['last_tag_open'] = '<li  class="page-link">';
	$config['last_tag_close'] = '</li>';
	$ci->pagination->initialize($config);
	return $ci->pagination->create_links();
} 

function generate_verififation(){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 32; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generate_orderid(){
	$characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 32; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $ends[$number % 10];
}

function ordinal_suffix($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return 'th';
    else
        return $ends[$number % 10];
}

function contest_category(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$cat=$CI->Common_model->get_records("category",'code, display_name');
	$cat= json_decode(json_encode($cat),true);
	$categories= array_column($cat,"display_name","code");
	return $categories;
}

function contest_minimum_price($code){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$res=$CI->Common_model->get_record("category",'minimum_fee',array("code"=>$code));
	return $res->minimum_fee;
}

function contest_listing_fee(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$res=$CI->Common_model->get_record("update_package","list_fee");
	return $res->list_fee;
}

function winner_percentage(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$res=$CI->Common_model->get_record("pricing_percentage",'winner_percentage');
	return $res->winner_percentage;
}

function contest_status($contest_id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_record("contest", "status", array("id"=>$contest_id));
	if(isset($data))
		return $data->status;
	else
		return "";
}

function supporttypes(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$cat=$CI->Common_model->get_records("support_type",'*');
	$cat= json_decode(json_encode($cat),true);
	$categories= array_column($cat,"support_type","id");
	return $categories;
}

function client_contest_discussioncount($contest_id, $client_id){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records_count("contest_comments", array("contest_id"=>$contest_id, "createdby"=>$client_id));
	return $data>0? "<span>".$data."</span>":"";
}

function user_current_access_country(){
	$ip=$_SERVER['REMOTE_ADDR'];
	$cdata= (object)unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
	return $cdata->geoplugin_countryCode;
}

function mail_groups(){
	$CI = get_instance();
	$CI->load->model("Common_model");
	$data = $CI->Common_model->get_records("mail_groups","group_id, group_title");
	return $data;
}

function currencyConvert($from_Currency,$to_Currency, $amount){
	if($amount!=0){
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);
		//$get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
		$get = file_get_contents("https://xe.com/currencyconverter/convert/?a=$amount&from=$from_Currency&to=$to_Currency");
		$get = explode("<span class=bld>",$get);
		$get = explode("</span>",$get[1]);
		$converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
		return floor($converted_currency);
	}
	else{
		echo'return';exit;
		return 0;
	}
}

function clean_string($string){
	 $res = preg_replace("/[^ \w]+/", "", strtolower($string));
	 return $data=str_replace(" ","_",$res);
}

function randomName(){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 32; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function substring($string,$cnt){
	return mb_strimwidth($string, 0,$cnt, '...');
}

function get_type_package($contest_id){
	$ci =& get_instance();
  $query = $ci->db->query("select c.cp_pack_name,b.ct_business,b.ct_social,b.ct_tshirt,b.ct_others from contest a inner join category_type b on b.ct_id = a.contest_type inner join category_package c on c.cp_id = b.cp_id where a.id= $contest_id");
	  return $query->result();
}
function get_category_type($contest_id){
	$ci =& get_instance();
  $query = $ci->db->query("select c.cp_pack_name from contest a inner join category_type b on b.ct_id = a.contest_type inner join category_package c on c.cp_id = b.cp_id where a.id= $contest_id");
	  //return $query->row();
	  if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			 return $query->row();
		 }else
		 {
			 return false;
		 }
}

function get_package_name($contest_id){
	$ci =& get_instance();
  $query = $ci->db->query("select b.ct_business as ct_business,b.ct_social as ct_social,b.ct_tshirt as ct_tshirt,
  b.ct_packagedesign as ct_packagedesign,b.ct_others as ct_others from contest a inner join category_type b on b.ct_id = a.contest_type where a.id= $contest_id");
	  return $query->row();
}




function convertCurrency($amount){
	$CI = get_instance();
	$to = $CI->session->userdata('sess_country');
	$to= "INR";
	$from= urlencode("USD");
	
	$url = "http://free.currencyconverterapi.com/api/v5/convert?q=".$from."_".$to."&compact=y&apiKey=3b47ad21fcbe30da7b8e";
	if($amount!=0):
		$data = file_get_contents($url);
		
		$data = json_decode($data,TRUE);
		if(isset($data[$from."_".$to])){
			$converted = $data[$from."_".$to]["val"] * $amount;
		}else{
			$converted = $amount;	
		}
		
	else:
    	$converted = 0;
    endif;
	
    return round($converted, 0);	
}

function getCountry(){
	$ip = $_SERVER['REMOTE_ADDR'];
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	if(isset($details->country))
		return $details->country; 	
	else
		return "";
}

function get_contest_pacakgename($contest_id){

	$CI = get_instance();
	$result = $CI->Common_model->get_record('contest_pricing_report','contest_package_name',array('contest_id'=>$contest_id));
	if(isset($result) && $result) {
		return $result->contest_package_name;
	}
}

function get_design_image($designer_id){
	$ci =& get_instance();
  $query = $ci->db->query("select design_name as design_name,design_rating as design_rating from designs  where designer_id= $designer_id and design_status='1' limit 0,2");
	  return $query->result();
}

function get_designer_rating($designer_id){
	$ci =& get_instance();
	$query = $ci->db->query("select design_id as design_id,design_name as design_name,sum(design_rating) as design_rating, count(design_rating) as design_count from designs where designer_id= $designer_id and design_status='1'");
	return $query->result();
		
}

function get_contest_total($contest_id){
	$ci =& get_instance();
	$query = $ci->db->query("select total_amount from contest where id='$contest_id'");
	if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->total_amount;
		 }else
		 {
			 return false;
		 }
}

function get_user_referralname($referral_id){
	$ci =& get_instance();
	$query = $ci->db->query("select user_name from user_table where user_id='$referral_id'");
	if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->user_name;
		 }else
		 {
			 return false;
		 }
}

function get_referral_id($user_id){
		$ci =& get_instance();
	$query = $ci->db->query("select r.id as ref_id from referral_table r inner join user_table u on u.user_id = r.users_id where r.users_id='$user_id'");
		if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->ref_id;
		 }else
		 {
			 return false;
		 }
	}

function get_all_contest(){
	$ci=& get_instance();
	$query=$ci->db->query("select ct.contest_prize as contest_prize,ct.total_amount as total_amount,ds.design_name as design_name from contest ct inner join designs ds on ds.contest_id=ct.id 
		where ct.status LIKE 'completed%' and ct.package_status='3' and ds.design_status='1'");
		if($query->num_rows()>0)
		{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
}
function get_new_referral_details($ref_id){
	$ci=& get_instance();
	$query =$ci->db->query("select * from user_table a right join referral_code b on b.ref_code=a.user_referral_code inner join contest c on c.id=b.contest_id where a.user_id='$ref_id' and c.status='open' and b.ref_status='0' order by b.ref_id desc");
	$result = $query->result();
			return $result;
}
function get_user_names($user_id){
	$CI = get_instance();
    $CI->load->model("Common_model");
	$user = $CI->Common_model->get_record("user_table",'user_name',array("user_id"=>$user_id));
	if(!empty($user))
		return ucwords($user->user_name);
}

function get_records_referral_report(){
	$ci=& get_instance();
	$query =$ci->db->query("select * from referral_code a inner join contest b on b.id=a.contest_id where b.status='open' and a.ref_status='0' order by a.ref_id desc");
	$result = $query->result();
			return $result;
}
function get_referral_not_show($userid){
	$ci=& get_instance();
	$query=$ci->db->query("select a.id as ref_id from referral_table a inner join user_table b on b.user_id=a.users_id where a.users_id='$userid'");
	if($query->num_rows() > 0)
		 {
			 $result = $query->row();
			return $result->ref_id;
		 }else
		 {
			 return false;
		 }
}