<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for Admin group only
 */
class Admin extends MY_Controller {

	protected $access = "1";

	
    function __construct() 
    {
        parent::__construct();
		$this->system->accessError('Admin Access');
	}
	public function asdasd(){
		$this->load->library('browser');
		$browser = new Browser();
		echo $browser->getBrowser()."\r\n";
		echo $browser->getVersion()."\r\n";
		echo $browser->getPlatform()."\r\n";
		echo $browser->getAolVersion()."\r\n";
	}	
	public function index()
	{
		$this->data['title'] = "Панель управления";
		$this->data['desc'] = "Панель управления";
		$this->data['CONTENT'] = $this->parser->parse('admin/dashboard', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function dashboard()
	{
		$this->index();
	}
	
	public function messages($id=false)
	{
		$this->data['title'] = "Панель управления";
		$this->data['desc'] = "Сообщения";
		$this->data['START_ID'] = $id;
		$this->data['CONTENT'] = $this->parser->parse('admin/messages/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}

	
	public function users($pages=0){
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
		$this->data['title'] = "Пользователи";
		$this->data['desc'] = "Редактирование пользователя";
		$this->data['USER'] = $this->users->GetUserById($id);
		$this->data['CONTENT'] = $this->parser->parse('admin/users/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	

	
	
	public function users_group()
	{
		$this->data['title'] = "Группы";
		$this->data['desc'] = "Управление группами пользователей";
		$this->data['GROUPS'] = $this->users->GetUserGroups();
		$this->data['CONTENT'] = $this->parser->parse('admin/users/group/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	public function users_group_edit($id)
	{
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
		
		$config['total_rows'] = $this->channels->GetChannelsCount();
		$this->pagination->initialize($config);
		$this->data['PAGES'] = $this->pagination->create_links();
		
		$this->data['CONTENT'] = $this->parser->parse('admin/ch/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function ch_create(){
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Добавление канала";
		$this->data['servers'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/ch/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function ch_edit($id){
		$this->data['title'] = "Каналы";
		$this->data['desc'] = "Редактирование канала";
		$this->data['channel'] = $this->channels->GetChannel($id);
		$this->data['servers'] = $this->admin->GetServers();
		$this->data['CONTENT'] = $this->parser->parse('admin/ch/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function cat($pages=0){
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
		$this->data['title'] = "Категории каналов";
		$this->data['desc'] = "Добавление категории";
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/cat/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function cat_edit($id){
		$this->data['title'] = "Категории каналов";
		$this->data['desc'] = "Редактирование категории";
		$this->data['category'] = $this->category->GetCategory($id);
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/cat/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function tariffs($pages=0){
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
		$this->data['title'] = "Тарифы";
		$this->data['desc'] = "Добавление тарифа";
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/tariff/create', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function tariff_edit($id){
		$this->data['title'] = "Тарифы";
		$this->data['desc'] = "Редактирование тарифа";
		$this->data['tariff'] = $this->tariffs->GetTariff($id);
		$this->data['channels'] = $this->channels->GetChannels();
		$this->data['CONTENT'] = $this->parser->parse('admin/tariff/edit', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing(){
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Управление балансом пользователей";
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_settings(){
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Настройки биллинга";
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/settings', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_transactions($pages=0){
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
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Статистика";
		$this->data['mode'] = (in_array($mode,array('month','now','week','year','paysys'))) ? $mode : 'month';
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/statistics/index', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_refund($pages=0){
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
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Перевод средств";
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/transfer', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	
	
	public function billing_users(){
		$this->data['title'] = "Биллинг";
		$this->data['desc'] = "Перевод средств";
		$this->data['users_top'] = $this->billing->GetUsersTop(10);
		$this->data['CONTENT'] = $this->parser->parse('admin/billing/users', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);
	}
	
	
	public function mail_templates(){
		$this->data['title'] = "E-mail";
		$this->data['desc'] = "Шаблоны E-mail сообщений";
		$this->data['users_top'] = $this->billing->GetUsersTop(10);
		$this->data['CONTENT'] = $this->parser->parse('admin/mail/templates', $this->data,TRUE);
		$this->parser->parse('admin/main', $this->data);		
	}

}