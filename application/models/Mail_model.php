<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	


	function send($mail,$TEXT,$array = false){
					$this->load->library('email');
					$config['mailtype'] = ($array['mailtype']) ? $array['mailtype'] : 'text';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = "false";
					$config['wrapchars'] = "1000";
					$config['crlf'] = "\r\n";
					$config['newline'] = "\r\n";
					$config['bcc_batch_mode'] = ($this->CONFIG->get('sys_mail_bcc') == 1) ? true : false;
					$config['dsn'] = true;
					
							$sys_mail_send_mail = $this->CONFIG->get('sys_mail_send_mail');
					if($this->CONFIG->get('sys_mail_metod') == 'smtp'){
						
					$config['protocol'] = "smtp";
						$config['smtp_host'] = $this->CONFIG->get('sys_mail_smtp_host');
						
						if($this->CONFIG->get('sys_mail_smtp_port') != ''){
							$config['smtp_port'] = $this->CONFIG->get('sys_mail_smtp_port');
						}
						
						if($this->CONFIG->get('sys_mail_smtp_user') != ''){
							$config['smtp_user'] = $this->CONFIG->get('sys_mail_smtp_user');
						}
						
						if($this->CONFIG->get('sys_mail_smtp_pass') != ''){
							$config['smtp_pass'] = $this->CONFIG->get('sys_mail_smtp_pass');
						}
						
						if($this->CONFIG->get('sys_mail_smtp_secure') != ''){
							$config['smtp_crypto'] = $this->CONFIG->get('sys_mail_smtp_secure');
						}
						if($this->CONFIG->get('sys_mail_smtp_mail') != ''){
							$sys_mail_send_mail = $this->CONFIG->get('sys_mail_smtp_mail');
						}
					}
					
					$this->email->initialize($config);
					$this->email->from($sys_mail_send_mail, $this->CONFIG->get('billing_admin_login_message'));
					$this->email->to($mail);
					if($array['bcc']){
						$this->email->bcc(implode(',',$array['bcc']));
					}
					
					if($array['subject']){
						$this->email->subject($array['subject']);
					}else{
						$this->email->subject($this->CONFIG->get('sys_mail_subject'));
					}

					
					$this->email->message($TEXT);

					$this->email->send();	 
	}
	
}