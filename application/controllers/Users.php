<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for Admin group only
 */
class Users extends MY_Controller {

	protected $access = "*";

	
    function __construct() 
    {
        parent::__construct();
		$this->system->accessRedirect('Users Access');
		$this->db->query("UPDATE users SET last_online=? WHERE id=?",array(time(),$this->session->userdata('id')));
	}

	public function index($user_id=false)
	{
		$this->data['USER'][0] = (!$user_id) ? $this->users->GetUserById($this->session->userdata('id')) : $this->users->GetUserById($user_id);
		$this->data['USER'][0]['group_name'] = $this->users->GetGroupName($this->data['USER'][0]['user_group']);
		$this->data['NEWS'] = $this->system->GetNews(10);
		$this->system->accessError('Users Access');
		$this->data['title'] = "Панель управления";
		$this->data['desc'] = "Панель управления";
		$this->data['CONTENT'] = $this->parser->parse('users/dashboard', $this->data,TRUE);
		$this->parser->parse('users/main', $this->data);
	}
	
	
	
	
	
	
	public function messages($id=false)
	{
		$this->system->accessError('Messages');
		$id = (intval($id) == 0) ? false : intval($id);
		$this->data['title'] = "Сообщения";
		$this->data['desc'] = "Сообщения";
		$this->data['START_ID'] = $id;
		$this->data['CONTENT'] = $this->parser->parse('users/messages/index', $this->data,TRUE);
		$this->parser->parse('users/main', $this->data);
	}	
	
	
	
	public function settings(){
		$this->data['title'] = "Настройки";
		$this->data['desc'] = "Настройки профиля";
		$this->data['USER'] = $this->users->GetUserById($_SESSION['id']);
		$this->data['CONTENT'] = $this->parser->parse('users/settings', $this->data,TRUE);
		$this->parser->parse('users/main', $this->data);
	}
	
	
	
	public function history($pages=0)
	{	
	
		$this->data['title'] = 'История';
		$this->data['desc'] = 'История движения средств';
		
		$this->load->library('pagination');

		$config['base_url'] = '/history/page/';
		$config['per_page'] = 10;
		
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';
		
		
		$this->data['transactions'] = $this->billing->GetTransactions(array('user_id'=>$_SESSION['id'],'offset'=>$pages,'limit'=>$config['per_page']));
		$config['total_rows'] = $this->billing->GetTransactionsCount(array('user_id'=>$_SESSION['id']));

		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();		
		
		
		$this->data['CONTENT'] = $this->parser->parse('users/history', $this->data,TRUE);
		$this->parser->parse('users/main', $this->data);
	}
	
	
	
	
	
}