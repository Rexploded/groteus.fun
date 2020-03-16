<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    /**
     * '*' all user
     * '@' logged in user
     * @var string
     */
    protected $access = "*";
    
    public function __construct() {
        parent::__construct();
		$this->data = null;
 
		if($this->session->userdata('language') =='')
		{
			$q = $this->db->query("SELECT language FROM users WHERE id=? ",array($this->session->userdata('id')));
			$q = $q->row_array();
			($q['language']) ? $this->session->set_userdata('language',$q['language']) : $this->session->set_userdata('language',$this->CONFIG->get('default_language'));
		} else {
			$this->config->set_item('language', $this->session->userdata('language'));
		}


 
        $this->login_check();
		$this->ACCESS();
		$this->data['CSRF'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->data['LANGS'] = $this->system->get_lang_list();
		$this->data['LANG'] = $_SESSION['language'];
    }
    
	public function ACCESS(){
		if($this->session->userdata("logged_in")){
			$this->db->query("UPDATE ci_sessions SET user_id=?,server=? WHERE id=?",array($this->session->userdata('id'),json_encode($_SERVER),session_id()));
			$this->db->query("UPDATE users SET last_online=? WHERE id=?",array(time(),$this->session->userdata('id')));
				$UERDATA = $this->db->query("SELECT * FROM users WHERE id=?",array($this->session->userdata('id')))->row_array();
				$usergroup = $this->db->query("SELECT * FROM user_groups WHERE id=?",array($this->session->userdata('user_group')))->row_array();
				$UERDATA['group'] = $usergroup;
				$this->session->set_userdata($UERDATA);
				$this->session->set_userdata("logged_in", true);
		}
	}
	
    public function login_check() {
        if ($this->access != "*") {
            // here we check the role of the user
            if (!$this->permission_check()) {
				if(!$this->session->userdata("logged_in")){
					redirect("auth");
				}else{
					show_404();
				}
            }
            
            // if user try to access logged in page
            // check does he/she has logged in
            // if not, redirect to login page
            if (!$this->session->userdata("logged_in")) {
                redirect("auth");
            }
        }
    }
    
    public function permission_check() {
        $this->ACCESS();
        $this->data['metod'] = $this->router->fetch_method();
        $this->data['class'] = $this->router->fetch_class();
        $this->data['classmetod'] = $this->router->fetch_class().$this->router->fetch_method();
        
		
		
		
        if ($this->access == "@") {
            return true;
        } else {
            
            $access = is_array($this->access) ? $this->access : explode(",", $this->access);
            if (in_array($this->session->userdata("user_group"), array_map("trim", $access))) {
                return true;
            }
            
            return false;
        }
    }
    
}