<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller{
	public function __Construct()
	{
        parent::__construct();
		$logged_in = is_admin_logged_in();		
		$currentMethod = $this->router->fetch_method();
		if(!$logged_in){
				redirect("admin_panel/index");
		}
    }
	
	public function index(){
		$data['page_name'] ='Send Mail';
		$data['groups'] = $this->Common_model->get_records("mail_groups","*");
		$data['content']='back/newmail';
		$this->load->view('back/template',$data);
	}
	
	public function sendMail(){
		$group_id= $this->input->post('group_id');
		$mlist= $this->Common_model->get_records("mail_group_emails","email_id",array("group_id"=>$group_id));
		$fmail= array_shift($mlist);
		$to= $fmail->email_id;
		$bcc= array_column(json_decode(json_encode($mlist),true),"email_id");
		$subject=$this->input->post('mail_subject');		
		$data=array();
		$message = $this->load->view("mail_templates/marketing_1",$data,true);
		rp_send_email($to, $subject, $message, "noreply@contesthours.com", $bcc);
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Messages have been sent successfully.</div>');
		redirect("mailer/index");
	}
	
	public function newgroup(){
		$data['page_name'] ='New Email Group';
		$data['content']='back/newgroup';
		$this->load->view('back/template',$data);
	}
	
	public function saveGroup(){
		$value["group_title"]= $this->input->post("group_title");
		ini_set('auto_detect_line_endings', true);
		
		if(!empty($_FILES['group_file']['name'])){
			
			$config['upload_path'] = 'uploads/group_mails/';
			$config['allowed_types'] = 'comma-separated-values|csv|ms-excel|msexcel';
			
			$fname= explode(".", $_FILES['group_file']['name']);
			$config['file_name'] = $filename= clean_string($fname[0]).".".$fname[1] ;
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
                
            if($this->upload->do_upload('group_file')){
				$group_id= $this->Common_model->insert_record("mail_groups",$value);
				$file_path="uploads/group_mails/$filename";
				$source = fopen($file_path, 'r') or die("Problem open file");
				while (($data = fgetcsv($source, 1000, ",")) !== FALSE){
						$values= array();
						$values['group_id']=$group_id;
						$values['email_id']=strtolower(trim(strip_tags($data[0])));
						$this->Common_model->insert_record("mail_group_emails",$values);
					
				}
				$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Group Created Successfully.</div>');	
				redirect("mailer/grouplist/$group_id");	
            }
			else{
				 $error = array('error' => $this->upload->display_errors());
				 print_r($error);
				$this->session->set_flashdata('message','<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Somthing Went Wrong. Try Again Later.</div>');	
				redirect("mailer/newgroup/$group_id");
            }
		}
	}
	
	public function grouplist($id){
		$data['page_name'] ='Mail Group List';
		$data['grouptitle']=$this->Common_model->get_record('mail_groups',"group_title",array("group_id"=>$id));
		$data['grouplist']=$this->Common_model->get_records('mail_group_emails',"*",array("group_id"=>$id));
		$data['content']='back/mail_group_list';
		$this->load->view('back/template',$data);
	}
	
	
	public function zohotest(){
		$data=array();
		$to= "sahayajeswin@gmail.com";
		$bcc= array("ram4uever24@gmail.com", "jeswin@addobyte.com", "piyali@addobyte.com");
		$subject="Launch Your Logo Contest Today";
		$message = $this->load->view("front/newsletter/marketing",$data,true);
		zohomail($to, $subject, $message, "noreply@contesthours.com", $bcc);
	}

	public function zomail(){
		$this->load->library('email');
		
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

		$data=array();
		$to= array("ram4uever24@gmail.com", "jeswin@addobyte.com", "piyali@addobyte.com");
		$subject="Launch Your Logo Contest Today-SMTP";
		$message = $this->load->view("front/newsletter/marketing",$data,true);
		
		$this->email->initialize($config);
		$this->email->from('noreply@contesthours.com', 'Contesthours');
		$this->email->to('sahayajeswin@gmail.com'); 
		$this->email->bcc($to);
		$this->email->subject($subject);
		$this->email->message($message);  
		$this->email->send();

		echo $this->email->print_debugger();
	}
	
}
