<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for Admin group only
 */
class Admin_ajax extends MY_Controller {

	protected $access = "1";
	
    public function __construct() {
        parent::__construct();
		
		if($_REQUEST[$this->security->get_csrf_token_name()] != $this->security->get_csrf_hash() AND $_GET[$this->security->get_csrf_token_name()] != $this->security->get_csrf_hash()){
			die();
		}
	}		
	
	public function users_group_edit($id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_users_group($id)));	
	}	
	
	public function users_edit()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_users()));	
	}	
	
	public function fl_create()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->create_fl()));	
	}	
	
	public function fl_edit($id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_fl($id)));	
	}
	
	public function ch_create()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->create_channel()));	
	}
	
	public function ch_edit($id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_channel($id)));	
	}
	
	public function news_create()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->create_news()));	
	}
	
	public function news_edit($id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_news($id)));	
	}
	
	public function ch_action()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->action_channel()));	
	}
	
	public function users_session_delete($user_id=false,$session_id=false)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->delete_session_users($user_id,$session_id)));	
	}
	
	public function ch_session_delete($server_id,$session_id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->delete_session_ch($server_id,$session_id)));	
	}
	
	public function users_delete($user_id=false)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->delete_users($user_id)));	
	}
	
	public function billing_referrals_action()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->action_referrals_billing()));	
	}
	
	public function billing_referrals_users_action()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->action_users_referrals_billing()));	
	}
	
	public function cat_create()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->create_category()));	
	}
	
	public function cat_edit($id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_category($id)));	
	}
	
	public function cat_delete($id,$new_id=null)
	{
		if($new_id != null){
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($this->ajax->delete_category_confirm($id,$new_id)));			
		}else{
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($this->ajax->delete_category($id)));
		}
	}
	
	public function tariff_create()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->create_tariff()));	
	}
	
	public function tariff_edit($id)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->edit_tariff($id)));	
	}
	
	public function tariff_delete($id,$new_id=null)
	{
		if($new_id != null){
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($this->ajax->delete_tariff_confirm($id,$new_id)));			
		}else{
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($this->ajax->delete_tariff($id)));
		}
	}
	
	public function billing_settings()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->settings_billing()));	
	}
	
	public function billing_prcode_generate()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->generate_prcode_billing()));	
	}
	
	public function billing_prcode_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->save_prcode_billing()));	
	}
	
	public function billing_prcode_action()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->action_prcode_billing()));	
	}
	
	public function billing_refund_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->save_refund_billing()));	
	}
	
	public function billing_refund_action()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->action_refund_billing()));	
	}
	
	public function billing_referrals_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->save_referrals_billing()));	
	}
	
	public function billing_referrals_create()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->create_referrals_billing()));	
	}
	
	public function billing_transfer_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->save_transfer_billing()));	
	}
	
	public function billing_users_pay_users()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->users_pay_users_billing()));	
	}
	
	public function billing_users_pay_group()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->group_pay_users_billing()));	
	}
	
	public function mail_templates_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->save_templates_mail()));	
	}
	
	public function settings_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->save_settings()));	
	}
	
	public function mails_send($offset=0,$limit=0)
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->send_mails($offset,$limit)));	
	}
	
	public function rules_save()
	{
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->ajax->rules_save()));	
	}

}