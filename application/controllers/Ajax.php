<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for Admin group only
 */
class Ajax extends MY_Controller {

	protected $access = "*";
	
    public function __construct() {
        parent::__construct();
		$this->system->accessRedirect('Users Access');
		if($_REQUEST[$this->security->get_csrf_token_name()] != $this->security->get_csrf_hash() AND $_GET[$this->security->get_csrf_token_name()] != $this->security->get_csrf_hash()){
			die();
		}
	}		
	
	public function lang($lang)
	{
		$listlng = scandir(APPPATH.'language');
		if(in_array($lang,$listlng)){
		$this->session->set_userdata('language',$lang);	
		$this->config->set_item('language', $lang);
			if($this->session->userdata('id') > 0){
				$this->db->query("UPDATE `users` SET `language`=? WHERE id=?",array($lang,$this->session->userdata('id')));
			}
		}
		 redirect($_SERVER['HTTP_REFERER']);  	
	}
	
	
	
	
	

}