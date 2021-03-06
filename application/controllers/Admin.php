<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for Admin group only
 */
class Admin extends MY_Controller {

	protected $access = "*";

	
    function __construct() 
    {
        parent::__construct();
		$this->system->accessRedirect('Admin Access');
	}
	public function asdasd(){
		$this->load->library('browser');
		$browser = new Browser();
		echo $browser->getBrowser()."\r\n";
		echo $browser->getVersion()."\r\n";
		echo $browser->getPlatform()."\r\n";
		echo $browser->getAolVersion()."\r\n";
	}	
	public function news($pages=0){
		$this->system->accessError('Admin Channels View');
		$this->data['title'] = "Новости";
		$this->data['desc'] = "Список новостей";

		$config['base_url'] = '/admin/news/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		
		$this->data['news'] = $this->admin->GetNewsPage(array('offset'=>$pages,'limit'=>$config['per_page']));
		
		$config['total_rows'] = $this->admin->GetNewsCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		$this->data['CONTENT'] = $this->parser->parse('admin/news/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}	
	
	
	public function news_create(){
		//$this->system->accessError('Admin Channels Create');
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Добавление канала";
		$this->data['servers'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/news/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function news_edit($id){
		//$this->system->accessError('Admin Channels Edit');
		$this->data['title'] = "Новости";
		$this->data['desc'] = "Редактирование новости";
		$this->data['news'] = $this->admin->GetNews($id);
		$this->data['CONTENT'] = $this->parser->parse('admin/news/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}	
	
	public function index()
	{
		$this->system->accessError('Admin Access');
		$this->data['title'] = "Панель управления";
		$this->data['desc'] = "Панель управления";
		$this->data['CONTENT'] = $this->parser->parse('admin/dashboard', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function dashboard()
	{
		$this->system->accessError('Admin Access');
		$this->index();
	}
	
	public function messages($id=false)
	{
		$this->system->accessError('Messages');
		$id = (intval($id) == 0) ? false : intval($id);
		$this->data['title'] = "Панель управления";
		$this->data['desc'] = "Сообщения";
		$this->data['START_ID'] = $id;
		$this->data['CONTENT'] = $this->parser->parse('admin/messages/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}

	
	public function users($pages=0){
		$this->system->accessError('Admin Users View');
		$this->data['title'] = "Управление пользователями";
		$this->data['desc'] = "Управление пользователями";
		
		$this->load->library('pagination');

		$config['base_url'] = '/admin/users/page/';
		$config['per_page'] = 50;
		
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->data['USERS'] = $this->users->GetUsersPage(array('offset'=>$pages,'limit'=>$config['per_page']));
		$config['total_rows'] = $this->users->GetUsersCount();

		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		$this->data['CONTENT'] = $this->parser->parse('admin/users/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);		
	}
	
	public function users_edit($id)
	{
		$this->system->accessError('Admin Users Edit');
		$this->data['title'] = "Пользователи";
		$this->data['desc'] = "Редактирование пользователя";
		$this->data['USER'] = $this->users->GetUserById($id);
		$this->data['CONTENT'] = $this->parser->parse('admin/users/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	

	
	
	public function users_group()
	{
		$this->system->accessError('Admin Users Group View');
		$this->data['title'] = "Группы";
		$this->data['desc'] = "Управление группами пользователей";
		$this->data['GROUPS'] = $this->users->GetUserGroups();
		$this->data['CONTENT'] = $this->parser->parse('admin/users/group/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function users_group_edit($id)
	{
		$this->system->accessError('Admin Users Group Edit');
		$this->data['title'] = "Группы";
		$this->data['desc'] = "Редактирование группы пользователей";
		$this->data['GROUP'] = $this->users->GetUserGroups($id);
		$this->data['CONTENT'] = $this->parser->parse('admin/users/group/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function fl()
	{
		$this->system->accessError('Admin Fl View');
		$this->data['title'] = "Flussonic";
		$this->data['desc'] = "Управление серверами";
		$this->data['LIST'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/fl/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function fl_create()
	{
		$this->system->accessError('Admin Fl Create');
		$this->data['title'] = "Flussonic";
		$this->data['desc'] = "Добавить сервер";
		$this->data['LIST'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/fl/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function fl_edit($id)
	{
		$this->system->accessError('Admin Fl Edit');
		$this->data['title'] = "Flussonic";
		$this->data['desc'] = "Редактировать сервер";
		$this->data['server'] = $this->admin->GetServers($id);
		$this->data['CONTENT'] = $this->parser->parse('admin/fl/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function ch($pages=0){
		$this->system->accessError('Admin Channels View');
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Список каналов";

		$config['base_url'] = '/admin/ch/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		
		$this->data['channels'] = $this->channels->GetChannelsPage(array('offset'=>$pages,'limit'=>$config['per_page']));
		
		
		
		$this->data['CH_DATA'] = $this->flussonic->GetChannelsData($this->data['channels']);


		
		$config['total_rows'] = $this->channels->GetChannelsCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		$this->data['CONTENT'] = $this->parser->parse('admin/ch/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function ch_create(){
		$this->system->accessError('Admin Channels Create');
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Добавление канала";
		$this->data['servers'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/ch/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function ch_edit($id){
		$this->system->accessError('Admin Channels Edit');
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Редактирование канала";
		$this->data['channel'] = $this->channels->GetChannel($id);
		$this->data['servers'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/ch/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function ch_sessions($id){
		$this->system->accessError('Admin Channels Edit');
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Подключения к каналу";
		$this->data['channel'] = $this->channels->GetChannel($id);
		$this->data['servers'] = $this->admin->GetServers();
		$this->data['sessions'] = $this->flussonic->GetChannelSessions($this->data['channel']);

		$this->data['SESSIONS'] = $this->parser->parse('admin/ch/sessions_list', $this->data,TRUE);
		if($this->input->is_ajax_request()){
			echo $this->data['SESSIONS'];
		}else{
			$this->data['CONTENT'] = $this->parser->parse('admin/ch/sessions', $this->data,TRUE);
			$this->parser->parse('admin/main', $this->data);
		}
	}
	
	
	public function cat($pages=0){
		$this->system->accessError('Admin Category View');
		$this->data['title'] = "Категории каналов";
		$this->data['desc'] = "Список категорий";

		$config['base_url'] = '/admin/cat/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		
		$this->data['category'] = $this->category->GetCategoryPage(array('offset'=>$pages,'limit'=>$config['per_page']));
		
		$config['total_rows'] = $this->category->GetCategoryCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		$this->data['CONTENT'] = $this->parser->parse('admin/cat/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function cat_create(){
		$this->system->accessError('Admin Category Create');
		$this->data['title'] = "Категории каналов";
		$this->data['desc'] = "Добавление категории";
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/cat/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function cat_edit($id){
		$this->system->accessError('Admin Category Edit');
		$this->data['title'] = "Категории каналов";
		$this->data['desc'] = "Редактирование категории";
		$this->data['category'] = $this->category->GetCategory($id);
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/cat/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function tariffs($pages=0){
		$this->system->accessError('Admin Tariffs View');
		$this->data['title'] = "Тарифы";
		$this->data['desc'] = "Список тарифов";

		$config['base_url'] = '/admin/tariff/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		
		$this->data['tariffs'] = $this->tariffs->GetTariffsPage(array('offset'=>$pages,'limit'=>$config['per_page']));
		
		$config['total_rows'] = $this->tariffs->GetTariffsCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		$this->data['CONTENT'] = $this->parser->parse('admin/tariff/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function tariff_create(){
		$this->system->accessError('Admin Tariffs Create');
		$this->data['title'] = "Тарифы";
		$this->data['desc'] = "Добавление тарифа";
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/tariff/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function tariff_edit($id){
		$this->system->accessError('Admin Tariffs Edit');
		$this->data['title'] = "Тарифы";
		$this->data['desc'] = "Редактирование тарифа";
		$this->data['tariff'] = $this->tariffs->GetTariff($id);
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/tariff/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing(){
		$this->system->accessError('Admin Billing');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Управление балансом пользователей";
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_settings(){
		$this->system->accessError('Admin Billing Settings');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Настройки биллинга";
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/settings', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_transactions($pages=0){
		$this->system->accessError('Admin Billing Transactions');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Транзакции пользователей";

		$config['base_url'] = '/admin/billing/transactions/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		$search = (isset($_GET['search'])) ? true : false;

		$this->data['transactions'] = $this->billing->GetTransactions(array('offset'=>$pages,'limit'=>$config['per_page'],'search'=>$search));
		$config['total_rows'] = $this->billing->GetTransactionsCount(array('search'=>$search));
		
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/transactions', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_invoice($pages=0){
		$this->system->accessError('Admin Billing Invoice');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Поступление средств";

		$config['base_url'] = '/admin/billing/invoice/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		$search = (isset($_GET['search'])) ? true : false;
		$this->data['invoices'] = $this->billing->GetInvoices(array('offset'=>$pages,'limit'=>$config['per_page'],'search'=>$search));
		
		$config['total_rows'] = $this->billing->GetInvoicesCount(array('search'=>$search));
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/invoice', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_statistics($mode='month'){
		$this->system->accessError('Admin Billing Statistics');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Статистика";
		$this->data['mode'] = (in_array($mode,array('month','now','week','year','paysys'))) ? $mode : 'month';
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/statistics/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_refund($pages=0){
		$this->system->accessError('Admin Billing Refund');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Вывод средств";

		$config['base_url'] = '/admin/billing/refund/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		$search = (isset($_GET['search'])) ? true : false;
		$this->data['refunds'] = $this->billing->GetRefunds(array('offset'=>$pages,'limit'=>$config['per_page'],'search'=>$search));
		
		$config['total_rows'] = $this->billing->GetRefundsCount(array('search'=>$search));
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/refund', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_prcode($pages=0){
		$this->system->accessError('Admin Billing Prcode');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Промокоды";

		$config['base_url'] = '/admin/billing/prcode/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		
		$this->data['prcodes'] = $this->billing->GetPrcodes(array('offset'=>$pages,'limit'=>$config['per_page']));
		
		$config['total_rows'] = $this->billing->GetPrcodesCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/prcode', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_referrals($pages=0){
		$this->system->accessError('Admin Billing Refferals');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Рефералы";

		$config['base_url'] = '/admin/billing/referrals/page/';
		$config['per_page'] = 50;
		$config['reuse_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open']  = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';

		
		$this->data['referrals'] = $this->billing->GetReferrals(array('offset'=>$pages,'limit'=>$config['per_page']));
		$this->data['refferals_rules'] = $this->billing->GetReferralsRules();
		
		$config['total_rows'] = $this->billing->GetReferralsCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/referrals', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_transfer(){
		$this->system->accessError('Admin Billing Transfer');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Перевод средств";
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/transfer', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_users(){
		$this->system->accessError('Admin Billing Users');
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Пользователи";
		$this->data['users_top'] = $this->billing->GetUsersTop(10);
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/users', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function mail_templates(){
		$this->system->accessError('Admin Mail Templates View');
		$this->data['title'] = "E-mail";
		$this->data['desc'] = "Шаблоны E-mail сообщений";
		$this->data['users_top'] = $this->billing->GetUsersTop(10);
		$this->data['CONTENT'] = $this->parser->parse('admin/mail/templates', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);		
	}
	
	
	public function mails(){
		$this->system->accessError('Admin Mail Send');
		
		if($this->input->post('send') == 1){
			$validation_rules = array(
				array('field' => 'type', 'label' => 'Тип сообщения', 'rules' => array('required','in_list[0,1]','max_length[255]')),
				array('field' => 'user_groups[]', 'label' => 'Группы', 'rules' => array('required','max_length[255]')),
				array('field' => 'start_reg', 'label' => 'Дата регистрации', 'rules' => array('max_length[255]')),
				array('field' => 'end_reg', 'label' => 'Дата регистрации', 'rules' => array('max_length[255]')),
				array('field' => 'start_online', 'label' => 'Дата последнего посещения', 'rules' => array('max_length[255]')),
				array('field' => 'end_online', 'label' => 'Дата последнего посещения', 'rules' => array('max_length[255]')),
				array('field' => 'title', 'label' => 'Заголовок', 'rules' => array('required','max_length[255]')),
				array('field' => 'message', 'label' => 'Сообщение', 'rules' => array('required')),
			);
			$this->form_validation->set_rules($validation_rules);
			if ($this->form_validation->run()){
				$type = $this->input->post('type');
				$user_groups = $this->input->post('user_groups');
				$start_reg = $this->input->post('start_reg');
				$end_reg = $this->input->post('end_reg');
				$start_online = $this->input->post('start_online');
				$end_online = $this->input->post('end_online');
				$WHERE = array();
				
				if(!in_array(0,$user_groups)){
					foreach($user_groups as $k=>$v){
						$group[] = 'user_group='.$v;
					}
					$WHERE[] = '('.implode(' OR ',$group).')';
				}
				
				if($start_reg){
					$start_reg = strtotime($start_reg.' 00:00:01');
					$WHERE[] = 'created_at>'.$start_reg;
				}
				
				if($end_reg){
					$end_reg = strtotime($end_reg.' 23:59:59');
					$WHERE[] = 'created_at<'.$end_reg;
				}
				
				if($start_online){
					$start_online = strtotime($start_online.' 00:00:01');
					$WHERE[] = 'last_online>'.$start_online;
				}
				
				if($end_online){
					$end_online = strtotime($end_online.' 23:59:59');
					$WHERE[] = 'last_online<'.$end_online;
				}
				
				$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : 1;
				
				$COUNT = $this->db->query("SELECT COUNT(*) as count FROM users WHERE {$WHERE}")->row_array();
				echo $COUNT['count'];
				
				
				print_r($WHERE);
				$this->data['title'] = "Рассылка сообщений";
				$this->data['desc'] = "Массовая отправка сообщений зарегистрированным пользователям";
				
				$this->data['COUNT'] = $COUNT['count'];
				$this->data['type'] = $type;
				
				$this->data['CONTENT'] = $this->parser->parse('admin/mail/process', $this->data,TRUE);
				$this->parser->parse('admin/main', $this->data);
			}else{

				goto mail_mass;
			}
		}else{
		
mail_mass:		

			$this->data['title'] = "Рассылка сообщений";
			$this->data['desc'] = "Массовая отправка сообщений зарегистрированным пользователям";
			$this->data['CONTENT'] = $this->parser->parse('admin/mail/send', $this->data,TRUE);
			$this->parser->parse('admin/main', $this->data);
		}		
	}
	
	
	public function settings(){
		$this->system->accessError('Admin Settings');
		$this->data['title'] = "Настройки";
		$this->data['desc'] = "Управление настройками скрипта";
		$this->data['CONTENT'] = $this->parser->parse('admin/settings', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);		
	}
	
	
	public function rules(){
		$this->system->accessError('Admin Rules Edit');
		$this->data['title'] = "Правила сайта";
		$this->data['desc'] = "Редактирование правил сайта";
		$this->data['CONTENT'] = $this->parser->parse('admin/rules', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);		
	}

}