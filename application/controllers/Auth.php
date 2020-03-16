<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for (all) non logged in users
 */
class Auth extends MY_Controller {	

	public function logged_in_check()
	{
		if ($this->session->userdata("logged_in")) {
			redirect("/");
		}
	}

	public function index()
	{
		$this->logged_in_check();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		if ($this->form_validation->run() == true) 
		{
			$this->load->model('auth_model', 'auth');	
			// check the username & password of user
			$status = $this->auth->validate();
			if ($status == ERR_INVALID_USERNAME) {
				$this->session->set_flashdata("error", "Username is invalid");
			}
			elseif ($status == ERR_INVALID_PASSWORD) {
				$this->session->set_flashdata("error", "Password is invalid");
			}
			elseif ($status == ERR_YOU_BANNED) {
				$this->session->set_flashdata("error", $this->users->GetBanReasonByUsername($this->input->post('username')));
			}
			elseif ($status == ERR_YOU_NOT_ACTIVE) {
				$this->session->set_flashdata("error", 'Ваш аккаунт не активирован');
			}
			else
			{
				// success
				// store the user data to session
				$this->session->set_userdata($this->auth->get_data());
				$this->session->set_userdata("logged_in", true);
				$UERDATA = $this->db->query("SELECT * FROM users WHERE id=?",array($this->session->userdata('id')))->row_array();
				$usergroup = $this->db->query("SELECT * FROM user_groups WHERE id=?",array($this->session->userdata('user_group')))->row_array();
				$UERDATA['group'] = $usergroup;
				$this->session->set_userdata($UERDATA);
				$this->session->set_userdata("logged_in", true);
				$this->db->query("UPDATE ci_sessions SET user_id=? WHERE id=?",array($UERDATA['id'],$this->session->session_id));
				// redirect to dashboard
				redirect("admin");
			}
		}

		$this->parser->parse('auth', $this->data);
	}

	public function register()
	{
		$this->logged_in_check();
		$this->load->library('form_validation');
		
		if($this->input->post('register') == 1){
			$ERROR = array('error'=>false,'errors'=>array());

			$countrys = array();
			foreach($this->config->item('country_codes') as $k=>$v){
				$countrys[] = $k;
			}

			$languages = array();
			foreach($this->system->get_lang_list() as $k=>$v){
				$languages[] = $v['SYMBOL'];
			}
			$validation_rules = array(
				array('field' => 'language', 'label' => 'Язык сайта', 'rules' => array('trim','required','in_list['.implode(',',$languages).']')),
				array('field' => 'country', 'label' => 'Страна', 'rules' => array('trim','required','in_list['.implode(',',$countrys).']')),
				array('field' => 'username', 'label' => 'Username', 'rules' => array('trim','required','is_unique[users.username]')),
				array('field' => 'email', 'label' => 'E-mail', 'rules' => array('trim','required','valid_email','is_unique[users.email]')),
				array('field' => 'password', 'label' =>	'Password', 'rules' => array('trim','required')),
				array('field' => 'passconf', 'label' => 'Password Confirmation', 'rules' => array('trim','required','matches[password]')),
				array('field' => 'rules', 'label' => 'Согласен с правилами', 'rules' => array('required')),
			);
			if($this->CONFIG->get('sys_reg_allow_sec_code')){
				$validation_rules[] = array('field' => 'g-recaptcha-response', 'label' => 'reCAPTCHA', 'rules' => array('required'));
			}		
			$this->form_validation->set_rules($validation_rules);			
			if ($this->form_validation->run()){
				$DATA['language'] = $this->input->post('language');
				$DATA['country'] = $this->input->post('country');
				$DATA['username'] = $this->input->post('username');
				$DATA['email'] = $this->input->post('email');
				$DATA['password'] = $this->input->post('password');
				$DATA['rules'] = $this->input->post('rules');
				
				if($this->CONFIG->get('sys_reg_allow_sec_code')){
					$DATA['recaptcha'] = $this->input->post('g-recaptcha-response');
					require APPPATH .'libraries/recaptcha.php';
					$reCaptcha = new ReCaptcha($this->CONFIG->get('recaptcha_private_key'));
			
					$resp = $reCaptcha->verifyResponse($this->input->ip_address(), $DATA['recaptcha'] );

					if ( $resp == null OR !$resp->success ) {
						$ERROR['error'] = true;
						$ERROR['errors']['g-recaptcha-response'] = "Wrong captcha";						
					}				
				}
				
				if($ERROR['error']){
					goto register_fail;
				}
				
				if($this->CONFIG->get('registration_type') == 1){
					$HASH = '';		
regenerate_hash_register:		
					$HASH .= md5(uniqid());
					if($this->db->query("SELECT COUNT(*) as count FROM users WHERE npass=?",array($HASH))->row_array()['count'] != 0){
						goto regenerate_hash_register;
					}
					//Нужно подтверждение
					$BODY = $this->CONFIG->get('reg_mail_text');
					$BODY = str_replace('{%validationlink%}',$this->config->item('base_url').'/register/'.$HASH,$BODY);
					$BODY = str_replace('{%email%}',$DATA['email'],$BODY);
					$BODY = str_replace('{%username%}',$DATA['username'],$BODY);
					$BODY = str_replace('{%password%}',$DATA['password'],$BODY);
					
					$this->mail->send($DATA['email'],$BODY,array('subject'=>'Активация аккаунта'));
				}
				
			
					
					
					$ATA = array(
						null,
						$DATA['email'],
						$DATA['username'],
						crypt($DATA['password'], '$6$rounds=20000$'),
						$DATA['country'],
						$DATA['language'],
						time(),
						$this->CONFIG->get('sys_reg_group'),
						$this->input->ip_address(),
						($this->CONFIG->get('registration_type') == 1) ? $HASH : '',
						($this->CONFIG->get('registration_type') == 1) ? 0 : 1,
						$this->billing->convert(0)
						
					);
					$this->db->query("INSERT INTO `users`(`id`, `email`, `username`, `password`, `country`, `language`, `created_at`, `user_group`, `last_ip`, `npass`, `active`, `balance`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",$ATA);

					$user_id = $this->db->insert_id();

					if(isset($_SESSION['partner']) AND $this->CONFIG->get('billing_module_referrals_active')){
						if($this->db->query("SELECT COUNT(*) as count FROM users WHERE username=?",array($_SESSION['partner']))->row_array()['count'] == 1){
							$ATAS = array(
								null,
								time(),
								$user_id,
								$this->db->query("SELECT * FROM users WHERE username=?",array($_SESSION['partner']))->row_array()['id']
							);
							$this->db->query("INSERT INTO `refferals`(`id`, `date`, `new_user_id`, `user_id`) VALUES (?,?,?,?)",$ATAS);
						}
					}		
					
				if($this->CONFIG->get('registration_type') == 0){
				$UERDATA = $this->db->query("SELECT * FROM users WHERE id=?",array($user_id))->row_array();
				$usergroup = $this->db->query("SELECT * FROM user_groups WHERE id=?",array($UERDATA['user_group']))->row_array();
				$UERDATA['group'] = $usergroup;
						$this->session->set_userdata($UERDATA);
						$this->session->set_userdata("logged_in", true);
						$this->db->query("UPDATE ci_sessions SET user_id=? WHERE id=?",array($UERDATA['id'],$this->session->session_id));	
						$AN['reload'] = 'true';						
				}
				
				
				
				
				$AN['response'] = 'success';
			}else{
register_fail:
				$AN['response'] = 'error';
				foreach($validation_rules as $k=>$v){
					if(form_error($v['field'])){
						$AN['errors'][$v['field']] = form_error($v['field']);
					}
				}
				foreach($ERROR['errors'] as $k=>$v){
						$AN['errors'][$k] = $ERROR['errors'][$k];
				}				
			}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($AN));			
		}else{
			$this->parser->parse('register', $this->data);
		}
	}
	
	function register_confirm($HASH){
		if($this->db->query("SELECT COUNT(*) as count FROM users WHERE npass=?",array($HASH))->row_array()['count'] == 1){
			$this->db->query("UPDATE users SET npass=? , active=? WHERE npass=?",array($HASH,1,$HASH));
			$this->session->set_flashdata("error", "Аккаунт успешно активирован!<br>Теперь вы можете войти в свой аккаунт.");
			redirect('auth');
		}else{
			$this->session->set_flashdata("error", "Ссылка не действительна!");
			redirect('auth');
		}
	}
	
	function lang($lang){
		$listlng = scandir(APPPATH.'language');
		if(in_array($lang,$listlng)){
			$this->session->set_userdata('lang',$lang);	
			$this->config->set_item('language', $lang);
		}
		 redirect($_SERVER['HTTP_REFERER']);
	}

	public function rules()
	{
		$this->data['RULES'] = $this->CONFIG->get('rules');
		$this->parser->parse('rules', $this->data);
	}

	public function logout()
	{
		$this->session->unset_userdata("logged_in");
		$this->session->sess_destroy();
		redirect("auth");
	}

}