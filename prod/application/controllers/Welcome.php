<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller{
	
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
