<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Billing_model extends CI_Model {
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	

	function Plus($amount,$plugin,$user_id,$text){
		$amount = $this->convert($amount);
		$new_balance = $this->db->query("SELECT balance FROM users WHERE id=?",array($user_id))->row_array()['balance'] + $amount;
		$time = time();
		$ATA = array(
			null,
			$plugin,
			$user_id,
			$amount,
			'0.00',
			$new_balance,
			$this->system->declines($amount,$this->CONFIG->get('billing_currency_decline')),
			$text,
			$time
		);
		$this->db->query("INSERT INTO `billing_history`(`id`, `plugin`, `user_id`, `plus`, `minus`, `balance`, `currency`, `text`, `date`) VALUES (?,?,?,?,?,?,?,?,?)",$ATA);
		
		
			if($this->CONFIG->get('billing_module_referrals_active') == 1){
				if($this->db->query("SELECT COUNT(*) as count FROM refferals WHERE new_user_id=?",array($user_id))->row_array()['count'] > 0){
					$user_id_my_upref = $this->db->query("SELECT * FROM refferals WHERE new_user_id=?",array($user_id))->row_array()['user_id'];
					
					
					if($this->users->GetUserById($user_id_my_upref)['refferals_success'] == 1 OR $this->users->GetUserById($user_id_my_upref)['refferals_success'] == 2){
					
						if($this->users->GetUserById($user_id_my_upref)['refferals_success'] == 1){
							$referrals_rules = $this->db->query("SELECT * FROM refferals_rules WHERE status=? AND plugin=? AND plus=?",array(1,$plugin,1))->result_array();
						}else{
							$referrals_rules = $this->db->query("SELECT * FROM refferals_rules_users WHERE status=? AND plugin=? AND plus=? AND user_id=?",array(1,$plugin,1,$user_id_my_upref))->result_array();
						}
						
						
							$true = false;
							foreach($referrals_rules as $k=>$v){
								switch ($v['type']) {
									case 0:
										//Больше
										$true = ($amount > $v['summ']) ? true : false;
										break;
									case 1:
										//Меньше
										$true = ($amount < $v['summ']) ? true : false;
										break;
									case 2:
										//Равно
										$true = ($amount == $v['summ']) ? true : false;
										break;
									case 3:
										//Не равно
										$true = ($amount != $v['summ']) ? true : false;
										break;
								}
								
								if($true){
									$reward = ($v['percent'] > 0) ? $this->convert($amount / 100 * $v['percent']) : $v['amount'];
									if($reward > 0){
										$this->plus($reward,'referrals',$user_id_my_upref,'Пополние рефералом');
									}
								}
							}
						
					
					}
				}
			}
			
			

			if(($this->CONFIG->get('billing_notif_mail_balancechangeadmin') AND $plugin == 'admin') OR ($this->CONFIG->get('billing_notif_mail_balancechange') AND $plugin != 'admin')){	
					$this->db->query("UPDATE users SET balance=? WHERE id=?",array($new_balance,$user_id));
					$USER = $this->db->query("SELECT * FROM users WHERE id=?",array($user_id))->row_array();

					$config['mailtype'] = $this->CONFIG->get('billing_plus_mail_type');



					$config['subject'] = $this->CONFIG->get('billing_payment_plus_minus_mail_subject');
					$BODY = $this->CONFIG->get('billing_notif_mail_balancechangeadmin_text');

					$BODY = str_replace('{%username%}',$USER['username'],$BODY);
					$BODY = str_replace('{%amount%}','+'.$amount,$BODY);
					$BODY = str_replace('{%comment%}',$text,$BODY);
					$BODY = str_replace('{%balacne%}',$new_balance,$BODY);
					$BODY = str_replace('{%date%}',date('d.m.Y H:i:s',$time),$BODY);
					$BODY = str_replace('{%declines_amount%}',$this->system->declines($amount,$this->CONFIG->get('billing_currency_decline')),$BODY);
					$BODY = str_replace('{%declines_balance%}',$this->system->declines($new_balance,$this->CONFIG->get('billing_currency_decline')),$BODY);
					

					$this->mail->send($USER['email'],$BODY,$config);
			}		
		
		
		
	}
	
	function Minus($amount,$plugin,$user_id,$text){
		$amount = $this->convert($amount);
		$new_balance = $this->db->query("SELECT balance FROM users WHERE id=?",array($user_id))->row_array()['balance'] - $amount;
		$time = time();
		$ATA = array(
			null,
			$plugin,
			$user_id,
			'0.00',
			$amount,
			$new_balance,
			'USD',
			$text,
			$time
		);	
		$this->db->query("INSERT INTO `billing_history`(`id`, `plugin`, `user_id`, `plus`, `minus`, `balance`, `currency`, `text`, `date`) VALUES (?,?,?,?,?,?,?,?,?)",$ATA);
		
			if($this->CONFIG->get('billing_module_referrals_active') == 1){
				if($this->db->query("SELECT COUNT(*) as count FROM refferals WHERE new_user_id=?",array($user_id))->row_array()['count'] > 0){
					$user_id_my_upref = $this->db->query("SELECT * FROM refferals WHERE new_user_id=?",array($user_id))->row_array()['user_id'];
					
					$referrals_rules = $this->db->query("SELECT * FROM refferals_rules WHERE status=? AND plugin=? AND minus=?",array(1,$plugin,1))->result_array();
					//print_r($referrals_rules);
					$true = false;
					foreach($referrals_rules as $k=>$v){
						switch ($v['type']) {
							case 0:
								//Больше
								$true = ($amount > $v['summ']) ? true : false;
								break;
							case 1:
								//Меньше
								$true = ($amount < $v['summ']) ? true : false;
								break;
							case 2:
								//Равно
								$true = ($amount == $v['summ']) ? true : false;
								break;
							case 3:
								//Не равно
								$true = ($amount != $v['summ']) ? true : false;
								break;
						}
						
						if($true){
							$reward = ($v['percent'] > 0) ? $this->convert($amount / 100 * $v['percent']) : $v['amount'];
							if($reward > 0){
								$this->plus($reward,'referrals',$user_id_my_upref,'Пополние рефералом');
							}
						}
					}
				}
			}
			
			
			if(($this->CONFIG->get('billing_notif_mail_balancechangeadmin') AND $plugin == 'admin') OR ($this->CONFIG->get('billing_notif_mail_balancechange') AND $plugin != 'admin')){
					$this->db->query("UPDATE users SET balance=? WHERE id=?",array($new_balance,$user_id));
					$USER = $this->db->query("SELECT * FROM users WHERE id=?",array($user_id))->row_array();

					$config['mailtype'] = $this->CONFIG->get('billing_plus_mail_type');
					$config['subject'] = $this->CONFIG->get('billing_payment_plus_minus_mail_subject');
					$BODY = $this->CONFIG->get('billing_notif_mail_balancechangeadmin_text');

					$BODY = str_replace('{%username%}',$USER['username'],$BODY);
					$BODY = str_replace('{%amount%}','-'.$amount,$BODY);
					$BODY = str_replace('{%comment%}',$text,$BODY);
					$BODY = str_replace('{%balacne%}',$new_balance,$BODY);
					$BODY = str_replace('{%declines%}',$this->system->declines($amount,$this->CONFIG->get('billing_currency_decline')),$BODY);
					$BODY = str_replace('{%date%}',date('d.m.Y H:i:s',$time),$BODY);
					

					$this->mail->send($USER['email'],$BODY,$config);	
			}				
		
		
	}
	
	
	function convert( $money, $format = '' )
	{
		if( ! $format ) $format = 'float';
		if( ! $money ) $money = 0;

		if( $format == 'int' ) return intval( $money );
		return number_format($money, 2, '.', '');
		//return floatval(number_format($money, 2, '.', ''));
	}
	


	
	function GetTransactionsCount($array = false){
		$WHERE = array();
		if($array['search'] == true){
			$search_plugin = ($this->input->get('search_plugin') != '') ? $this->input->get('search_plugin') : false;
			$search_type = ($this->input->get('search_type') != '') ? $this->input->get('search_type') : false;
			$search_summa = ($this->input->get('search_summa') != '') ? $this->input->get('search_summa') : false;
			$search_login = ($this->input->get('search_login') != '') ? $this->input->get('search_login') : false;
			$login = ($this->input->get('login') != '') ? $this->input->get('login') : false;
			$user_id = ($array['user_id']) ? $array['user_id'] : false;
			$search_comment = ($this->input->get('search_comment') != '') ? $this->input->get('search_comment') : false;
			$search_date = ($this->input->get('search_date') != '') ? strtotime($this->input->get('search_date')) : false;
			$search_date_to = ($this->input->get('search_date_to') != '') ? strtotime($this->input->get('search_date_to')) : false;
			if($search_plugin){
				$WHERE[] = "plugin='".$search_plugin."'";
			}
			if($search_type){
				if($search_type == 1){
					$WHERE[] = "plus>0";
				}else{
					$WHERE[] = "minus>0";
				}
			}
			if($search_summa){
				if($search_summa[0] == '>' OR $search_summa[0] == '<' OR $search_summa[0] == '='){
					$num = intval(substr($search_summa, 1));
					$cos = $search_summa[0];
					$WHERE[] = "(`minus`{$cos}{$num} OR `plus`{$cos}{$num})";
				}else{
					$num = intval($search_summa);
					$WHERE[] = "(`minus`={$num} OR `plus`={$num})";
				}
			}
			if($login){
				$USER = $this->db->query("SELECT * FROM users WHERE username=?",array($login))->row_array();
				$login = ($USER['id']) ? $USER['id'] : 0;
				$WHERE[] = "user_id = {$login}";
			}
			if($user_id){
				$WHERE[] = "user_id = {$user_id}";
			}
			if($search_login){
				$USERS = $this->db->query("SELECT * FROM users WHERE username LIKE '{$search_login}'")->result_array();
				$IN = array(0);
				foreach($USERS as $k=>$v){
					$IN[] = $v['id'];
				}
				$IN = implode(',',$IN);
				$WHERE[] = "user_id IN (".$IN.")";
			}
			if($search_comment){
				$WHERE[] = "text LIKE '".$search_comment."'";
			}
			if($search_date AND $search_date_to){
				$WHERE[] = "date>{$search_date} AND date<{$search_date_to}";
			}else{
				$_GET['search_date'] = '';
				$_GET['search_date_to'] = '';
			}
		}
		$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		
		return $this->db->query("SELECT COUNT(*) as count FROM billing_history WHERE {$WHERE} ")->row_array()['count'];
	}
	
	
	function GetTransactions($array=false){
			
		$WHERE = array();
		if($array['search'] == true){
			$search_plugin = ($this->input->get('search_plugin') != '') ? $this->input->get('search_plugin') : false;
			$search_type = ($this->input->get('search_type') != '') ? $this->input->get('search_type') : false;
			$search_summa = ($this->input->get('search_summa') != '') ? $this->input->get('search_summa') : false;
			$search_login = ($this->input->get('search_login') != '') ? $this->input->get('search_login') : false;
			$login = ($this->input->get('login') != '') ? $this->input->get('login') : false;
			$user_id = ($array['user_id']) ? $array['user_id'] : false;
			$search_comment = ($this->input->get('search_comment') != '') ? $this->input->get('search_comment') : false;
			$search_date = ($this->input->get('search_date') != '') ? strtotime($this->input->get('search_date')) : false;
			$search_date_to = ($this->input->get('search_date_to') != '') ? strtotime($this->input->get('search_date_to')) : false;
			if($search_plugin){
				$WHERE[] = "plugin='".$search_plugin."'";
			}
			if($search_type){
				if($search_type == 1){
					$WHERE[] = "plus>0";
				}else{
					$WHERE[] = "minus>0";
				}
			}
			if($search_summa){
				if($search_summa[0] == '>' OR $search_summa[0] == '<' OR $search_summa[0] == '='){
					$num = intval(substr($search_summa, 1));
					$cos = $search_summa[0];
					$WHERE[] = "(`minus`{$cos}{$num} OR `plus`{$cos}{$num})";
				}else{
					$num = intval($search_summa);
					$WHERE[] = "(`minus`={$num} OR `plus`={$num})";
				}
			}
			if($login){
				$USER = $this->db->query("SELECT * FROM users WHERE username=?",array($login))->row_array();
				$login = ($USER['id']) ? $USER['id'] : 0;
				$WHERE[] = "user_id = {$login}";
			}
			if($user_id){
				$WHERE[] = "user_id = {$user_id}";
			}
			if($search_login){
				$USERS = $this->db->query("SELECT * FROM users WHERE username LIKE '{$search_login}'")->result_array();
				$IN = array(0);
				foreach($USERS as $k=>$v){
					$IN[] = $v['id'];
				}
				$IN = implode(',',$IN);
				$WHERE[] = "user_id IN (".$IN.")";
			}
			if($search_comment){
				$WHERE[] = "text LIKE '".$search_comment."'";
			}
			if($search_date AND $search_date_to){
				$WHERE[] = "date>{$search_date} AND date<{$search_date_to}";
			}else{
				$_GET['search_date'] = '';
				$_GET['search_date_to'] = '';
			}
		}
		$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		
		$LIMIT = '';
		if(isset($array['offset']) OR isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			
			$LIMIT = "LIMIT {$array['offset']},{$array['limit']}";
		}
		
		return $this->db->query("SELECT * FROM billing_history WHERE {$WHERE} ORDER by id DESC {$LIMIT}")->result_array();
	}
	
	
	function GetInvoicesCount($array = false){
		$WHERE = array();
		if($array['search'] == true){
			$search_summa = ($this->input->get('search_summa') != '') ? $this->input->get('search_summa') : false;
			$search_summa_get = ($this->input->get('search_summa_get') != '') ? $this->input->get('search_summa_get') : false;
			$search_status = ($this->input->get('search_status') != '') ? $this->input->get('search_status') : false;
			$search_login = ($this->input->get('search_login') != '') ? $this->input->get('search_login') : false;
			$login = ($this->input->get('login') != '') ? $this->input->get('login') : false;
			$search_requisites = ($this->input->get('search_requisites') != '') ? $this->input->get('search_requisites') : false;
			$search_paysys = ($this->input->get('search_paysys') != '') ? $this->input->get('search_paysys') : false;
			$search_date = ($this->input->get('search_date') != '') ? strtotime($this->input->get('search_date')) : false;
			$search_date_to = ($this->input->get('search_date_to') != '') ? strtotime($this->input->get('search_date_to')) : false;
			$search_date_pay = ($this->input->get('search_date_pay') != '') ? strtotime($this->input->get('search_date_pay')) : false;
			$search_date_pay_to = ($this->input->get('search_date_pay_to') != '') ? strtotime($this->input->get('search_date_pay_to')) : false;
			if($search_status){
				if($search_status == 1){
					$WHERE[] = "success_time>0";
				}else{
					$WHERE[] = "success_time<0";
				}
			}
			if($search_summa){
				if($search_summa[0] == '>' OR $search_summa[0] == '<' OR $search_summa[0] == '='){
					$num = intval(substr($search_summa, 1));
					$cos = $search_summa[0];
					$WHERE[] = "`total`{$cos}{$num}";
				}else{
					$num = intval($search_summa);
					$WHERE[] = "`total`={$num}";
				}
			}
			if($search_summa_get){
				if($search_summa_get[0] == '>' OR $search_summa_get[0] == '<' OR $search_summa_get[0] == '='){
					$num = intval(substr($search_summa_get, 1));
					$cos = $search_summa_get[0];
					$WHERE[] = "`amount`{$cos}{$num}";
				}else{
					$num = intval($search_summa_get);
					$WHERE[] = "`amount`={$num}";
				}
			}
			if($login){
				$USER = $this->db->query("SELECT * FROM users WHERE username=?",array($login))->row_array();
				$login = ($USER['id']) ? $USER['id'] : 0;
				$WHERE[] = "user_id = {$login}";
			}
			if($search_login){
				$USERS = $this->db->query("SELECT * FROM users WHERE username LIKE '{$search_login}'")->result_array();
				$IN = array(0);
				foreach($USERS as $k=>$v){
					$IN[] = $v['id'];
				}
				$IN = implode(',',$IN);
				$WHERE[] = "user_id IN (".$IN.")";
			}
			if($search_requisites){
				$WHERE[] = "data LIKE '".$search_requisites."'";
			}
			if($search_paysys){
				$WHERE[] = "system='".$search_paysys."'";
			}
			if($search_date AND $search_date_to){
				$WHERE[] = "create_time>{$search_date} AND create_time<{$search_date_to}";
			}else{
				$_GET['search_date'] = '';
				$_GET['search_date_to'] = '';
			}
			if($search_date_pay AND $search_date_pay_to){
				$WHERE[] = "success_time>{$search_date_pay} AND success_time<{$search_date_pay_to}";
			}else{
				$_GET['search_date_pay'] = '';
				$_GET['search_date_pay_to'] = '';
			}
		}
		$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		
		$LIMIT = '';
		if(isset($array['offset']) OR isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			
			$LIMIT = "LIMIT {$array['offset']},{$array['limit']}";
		}
		return $this->db->query("SELECT COUNT(*) as count FROM pay WHERE {$WHERE} ")->row_array()['count'];
	}
	
	
	function GetInvoices($array){
		$WHERE = array();
		if($array['search'] == true){
			$search_summa = ($this->input->get('search_summa') != '') ? $this->input->get('search_summa') : false;
			$search_summa_get = ($this->input->get('search_summa_get') != '') ? $this->input->get('search_summa_get') : false;
			$search_status = ($this->input->get('search_status') != '') ? $this->input->get('search_status') : false;
			$search_login = ($this->input->get('search_login') != '') ? $this->input->get('search_login') : false;
			$login = ($this->input->get('login') != '') ? $this->input->get('login') : false;
			$search_requisites = ($this->input->get('search_requisites') != '') ? $this->input->get('search_requisites') : false;
			$search_paysys = ($this->input->get('search_paysys') != '') ? $this->input->get('search_paysys') : false;
			$search_date = ($this->input->get('search_date') != '') ? strtotime($this->input->get('search_date')) : false;
			$search_date_to = ($this->input->get('search_date_to') != '') ? strtotime($this->input->get('search_date_to')) : false;
			$search_date_pay = ($this->input->get('search_date_pay') != '') ? strtotime($this->input->get('search_date_pay')) : false;
			$search_date_pay_to = ($this->input->get('search_date_pay_to') != '') ? strtotime($this->input->get('search_date_pay_to')) : false;
			if($search_status){
				if($search_status == 1){
					$WHERE[] = "success_time>0";
				}else{
					$WHERE[] = "success_time<0";
				}
			}
			if($search_summa){
				if($search_summa[0] == '>' OR $search_summa[0] == '<' OR $search_summa[0] == '='){
					$num = intval(substr($search_summa, 1));
					$cos = $search_summa[0];
					$WHERE[] = "`total`{$cos}{$num}";
				}else{
					$num = intval($search_summa);
					$WHERE[] = "`total`={$num}";
				}
			}
			if($search_summa_get){
				if($search_summa_get[0] == '>' OR $search_summa_get[0] == '<' OR $search_summa_get[0] == '='){
					$num = intval(substr($search_summa_get, 1));
					$cos = $search_summa_get[0];
					$WHERE[] = "`amount`{$cos}{$num}";
				}else{
					$num = intval($search_summa_get);
					$WHERE[] = "`amount`={$num}";
				}
			}
			if($login){
				$USER = $this->db->query("SELECT * FROM users WHERE username=?",array($login))->row_array();
				$login = ($USER['id']) ? $USER['id'] : 0;
				$WHERE[] = "user_id = {$login}";
			}
			if($search_login){
				$USERS = $this->db->query("SELECT * FROM users WHERE username LIKE '{$search_login}'")->result_array();
				$IN = array(0);
				foreach($USERS as $k=>$v){
					$IN[] = $v['id'];
				}
				$IN = implode(',',$IN);
				$WHERE[] = "user_id IN (".$IN.")";
			}
			if($search_requisites){
				$WHERE[] = "data LIKE '".$search_requisites."'";
			}
			if($search_paysys){
				$WHERE[] = "system='".$search_paysys."'";
			}
			if($search_date AND $search_date_to){
				$WHERE[] = "create_time>{$search_date} AND create_time<{$search_date_to}";
			}else{
				$_GET['search_date'] = '';
				$_GET['search_date_to'] = '';
			}
			if($search_date_pay AND $search_date_pay_to){
				$WHERE[] = "success_time>{$search_date_pay} AND success_time<{$search_date_pay_to}";
			}else{
				$_GET['search_date_pay'] = '';
				$_GET['search_date_pay_to'] = '';
			}
		}
		$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		
		$LIMIT = '';
		if(isset($array['offset']) OR isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			
			$LIMIT = "LIMIT {$array['offset']},{$array['limit']}";
		}
		return $this->db->query("SELECT * FROM pay WHERE {$WHERE} ORDER by id DESC {$LIMIT}")->result_array();
	}

	
	function GetDayPayments($day,$user_id=false){
		$user = ($user_id) ? " AND user_id=".intval($user_id) : '';
		return $this->convert($this->db->query("SELECT SUM(amount) as count FROM pay WHERE success_time>? AND success_time<? {$user}",array(strtotime($day.' 00:00:00'),strtotime($day.' 23:59:59')))->row_array()['count']);
	}
	
	function GetDayUserPayments($day,$user_id=false){
		$user = ($user_id) ? " AND user_id=".intval($user_id) : '';
		return $this->convert($this->db->query("SELECT SUM(minus) as count FROM billing_history WHERE date>? AND date<? {$user}",array(strtotime($day.' 00:00:00'),strtotime($day.' 23:59:59')))->row_array()['count']) ;
	}

	public function GetRefunds($array = false){
		
		$WHERE = array();
		if($array['search'] == true){
			$search_summa = ($this->input->get('search_summa') != '') ? $this->input->get('search_summa') : false;
			$search_requisites = ($this->input->get('search_requisites') != '') ? $this->input->get('search_requisites') : false;
			$search_login = ($this->input->get('search_login') != '') ? $this->input->get('search_login') : false;
			$login = ($this->input->get('login') != '') ? $this->input->get('login') : false;
			$search_status = ($this->input->get('search_status') != '') ? $this->input->get('search_status') : false;
			$search_date = ($this->input->get('search_date') != '') ? strtotime($this->input->get('search_date')) : false;
			$search_date_to = ($this->input->get('search_date_to') != '') ? strtotime($this->input->get('search_date_to')) : false;
			
			
			if($search_summa){
				if($search_summa[0] == '>' OR $search_summa[0] == '<' OR $search_summa[0] == '='){
					$num = intval(substr($search_summa, 1));
					$cos = $search_summa[0];
					$WHERE[] = "(`minus`{$cos}{$num} OR `plus`{$cos}{$num})";
				}else{
					$num = intval($search_summa);
					$WHERE[] = "(`minus`={$num} OR `plus`={$num})";
				}
			}
			if($search_requisites){
				$WHERE[] = "text LIKE '".$search_requisites."'";
			}
			if($search_login){
				$USERS = $this->db->query("SELECT * FROM users WHERE username LIKE '{$search_login}'")->result_array();
				$IN = array(0);
				foreach($USERS as $k=>$v){
					$IN[] = $v['id'];
				}
				$IN = implode(',',$IN);
				$WHERE[] = "user_id IN (".$IN.")";
			}
			if($login){
				$USER = $this->db->query("SELECT * FROM users WHERE username=?",array($login))->row_array();
				$login = ($USER['id']) ? $USER['id'] : 0;
				$WHERE[] = "user_id = {$login}";
			}
			if($search_status){
				if($search_status == 1){
					$WHERE[] = "date_return>0";
				}else{
					$WHERE[] = "date_return<0";
				}
			}
			if($search_date AND $search_date_to){
				$WHERE[] = "date>{$search_date} AND date<{$search_date_to}";
			}else{
				$_GET['search_date'] = '';
				$_GET['search_date_to'] = '';
			}
			
		}		
		$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		
		
		$LIMIT = '';
		if(isset($array['offset']) OR isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			
			$LIMIT = "LIMIT {$array['offset']},{$array['limit']}";
		}	
			return $this->db->query("SELECT * FROM refund WHERE {$WHERE} ORDER by id DESC {$LIMIT}")->result_array();

	}	
	

	public function GetRefundsCount($array = false){
		
		$WHERE = array();
		if($array['search'] == true){
			$search_summa = ($this->input->get('search_summa') != '') ? $this->input->get('search_summa') : false;
			$search_requisites = ($this->input->get('search_requisites') != '') ? $this->input->get('search_requisites') : false;
			$search_login = ($this->input->get('search_login') != '') ? $this->input->get('search_login') : false;
			$login = ($this->input->get('login') != '') ? $this->input->get('login') : false;
			$search_status = ($this->input->get('search_status') != '') ? $this->input->get('search_status') : false;
			$search_date = ($this->input->get('search_date') != '') ? strtotime($this->input->get('search_date')) : false;
			$search_date_to = ($this->input->get('search_date_to') != '') ? strtotime($this->input->get('search_date_to')) : false;
			
			
			if($search_summa){
				if($search_summa[0] == '>' OR $search_summa[0] == '<' OR $search_summa[0] == '='){
					$num = intval(substr($search_summa, 1));
					$cos = $search_summa[0];
					$WHERE[] = "(`minus`{$cos}{$num} OR `plus`{$cos}{$num})";
				}else{
					$num = intval($search_summa);
					$WHERE[] = "(`minus`={$num} OR `plus`={$num})";
				}
			}
			if($search_requisites){
				$WHERE[] = "text LIKE '".$search_requisites."'";
			}
			if($search_login){
				$USERS = $this->db->query("SELECT * FROM users WHERE username LIKE '{$search_login}'")->result_array();
				$IN = array(0);
				foreach($USERS as $k=>$v){
					$IN[] = $v['id'];
				}
				$IN = implode(',',$IN);
				$WHERE[] = "user_id IN (".$IN.")";
			}
			if($login){
				$USER = $this->db->query("SELECT * FROM users WHERE username=?",array($login))->row_array();
				$login = ($USER['id']) ? $USER['id'] : 0;
				$WHERE[] = "user_id = {$login}";
			}
			if($search_status){
				if($search_status == 1){
					$WHERE[] = "date_return>0";
				}else{
					$WHERE[] = "date_return<0";
				}
			}
			if($search_date AND $search_date_to){
				$WHERE[] = "date>{$search_date} AND date<{$search_date_to}";
			}else{
				$_GET['search_date'] = '';
				$_GET['search_date_to'] = '';
			}
			
		}		
		$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		
		
		$LIMIT = '';
		if(isset($array['offset']) OR isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			
			$LIMIT = "LIMIT {$array['offset']},{$array['limit']}";
		}	
			return $this->db->query("SELECT COUNT(*) as count FROM refund WHERE {$WHERE} ORDER by id DESC {$LIMIT}")->row_array()['count'];
	}

	public function GetPrcodes($array = false){
		$ATA = array();
		if(isset($array['offset']) AND isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			return $this->db->query("SELECT * FROM prcodes WHERE 1 ORDER by id DESC LIMIT {$array['offset']},{$array['limit']}",$ATA)->result_array();
		}else{
			return $this->db->query("SELECT * FROM prcodes WHERE 1 ORDER by id DESC ",$ATA)->result_array();
		}
	}	
	

	public function GetPrcodesCount($array = false){
		$ATA = array();
		if(isset($array['offset']) AND isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			return $this->db->query("SELECT COUNT(*) as count FROM prcodes WHERE 1 ORDER by id DESC LIMIT {$array['offset']},{$array['limit']}",$ATA)->row_array()['count'];
		}else{
			return $this->db->query("SELECT COUNT(*) as count FROM prcodes WHERE 1 ORDER by id DESC ",$ATA)->row_array()['count'];
		}
	}	
	
	
	public function CreatePrcode($array){
				$ATA = array(
					null,
					$array['prcode_tag'],
					$array['amount'],
					0,
					0,
					$array['active_before']
				);
				$this->db->query("INSERT INTO `prcodes`(`id`, `prcode_tag`, `amount`, `user_id`, `active_date`, `active_before`) VALUES (?,?,?,?,?,?)",$ATA);
	}

	public function GetReferrals($array = false){
		$ATA = array();
		if(isset($array['offset']) AND isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			return $this->db->query("SELECT * FROM refferals WHERE 1 ORDER by id DESC LIMIT {$array['offset']},{$array['limit']}",$ATA)->result_array();
		}else{
			return $this->db->query("SELECT * FROM refferals WHERE 1 ORDER by id DESC ",$ATA)->result_array();
		}
	}	
	

	public function GetReferralsCount($array = false){
		$ATA = array();
		if(isset($array['offset']) AND isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			return $this->db->query("SELECT COUNT(*) as count FROM refferals WHERE 1 ORDER by id DESC LIMIT {$array['offset']},{$array['limit']}",$ATA)->row_array()['count'];
		}else{
			return $this->db->query("SELECT COUNT(*) as count FROM refferals WHERE 1 ORDER by id DESC ",$ATA)->row_array()['count'];
		}
	}
	

	public function GetReferralsRules($id = false){
		if($id){
			return $this->db->query("SELECT * FROM refferals_rules WHERE id=?",array($id))->row_array();
		}else{
			return $this->db->query("SELECT * FROM refferals_rules WHERE 1")->result_array();
		}
	}
	
	public function CreateReferralsRules($array){
		$ATA = array(
			null,
			$array['plugin'],
			$array['description'],
			$array['type'],
			$array['summ'],
			$array['plus'],
			$array['minus'],
			$array['amount'],
			$array['percent'],
			0
		);
		$this->db->query('INSERT INTO `refferals_rules`(`id`, `plugin`, `description`, `type`, `summ`, `plus`, `minus`, `amount`, `percent`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)',$ATA);
	}
	
	public function CreateReferralsRulesForUser($array){
		foreach($array['plugin'] as $k=>$v){
			$ATA = array(
				null,
				$array['user_id'],
				$v,
				$array['description'][$k],
				$array['type'][$k],
				$array['summ'][$k],
				$array['plus'][$k],
				$array['minus'][$k],
				$array['amount'][$k],
				$array['percent'][$k],
				1
			);
			$this->db->query('INSERT INTO `refferals_rules_users`(`id`, `user_id`, `plugin`, `description`, `type`, `summ`, `plus`, `minus`, `amount`, `percent`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)',$ATA);			
		}

	}
	
	public function DeleteReferralsRulesForUser($id=false,$user_id=false){
		if($id){
			if($user_id){
				return $this->db->query("DELETE FROM refferals_rules_users WHERE id=? AND user_id=?",array($id,$user_id));
			}else{
				return $this->db->query("DELETE FROM refferals_rules_users WHERE id=?",array($id));
			}
		}else{
			if($user_id){
				return $this->db->query("DELETE FROM refferals_rules_users WHERE user_id=?",array($user_id));
			}else{
				return $this->db->query("DELETE FROM refferals_rules_users WHERE 1");
			}
		}
	}
	

	public function GetReferralsRulesForUser($id = false,$user_id=false){
		if($id){
			if($user_id){
				return $this->db->query("SELECT * FROM refferals_rules_users WHERE id=? AND user_id=?",array($id,$user_id))->row_array();
			}else{
				return $this->db->query("SELECT * FROM refferals_rules_users WHERE id=?",array($id))->row_array();
			}
		}else{
			if($user_id){
				return $this->db->query("SELECT * FROM refferals_rules_users WHERE user_id=?",array($user_id))->result_array();
			}else{
				return $this->db->query("SELECT * FROM refferals_rules_users WHERE 1")->result_array();
			}
		}
	}
	
	
	public function GetUsersTop(){
		$search_name = false;
		$search_balance = false;
		if(isset($_GET['search_name']) OR isset($_GET['search_balance'])){
			$search_name = ($this->input->get('search_name')!= '') ? $this->input->get('search_name') : false;
			$search_balance = ($this->input->get('search_balance') != '') ? $this->input->get('search_balance') : false;
		}
		
		if($search_name OR $search_balance){
			$result_count = 100;
			$WHERE = array();
			if($search_name){
				$WHERE[] = '`username` LIKE \'%{$search_name}%\'';
			}
			if($search_balance){
				if($search_balance[0] == '>' OR $search_balance[0] == '<' OR $search_balance[0] == '='){
					$num = intval(substr($search_balance, 1));
					$cos = $search_balance[0];
					$WHERE[] = "`balance`{$cos}{$num}";
				}else{
					$num = intval($search_balance);
					$WHERE[] = "`balance`={$num}";
				}
			}
			$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : '1';
		}else{
			$WHERE = '1';
			$result_count = 10;
		}
		
		
		
		
		$q = $this->db->query("SELECT * FROM users WHERE {$WHERE} ORDER by balance DESC LIMIT 0,{$result_count}")->result_array();
		
		return $q;
	}
	
	function GetRefundsByUserId($user_id){
		return $this->convert($this->db->query("SELECT SUM(amount) as sum FROM refund WHERE user_id=? AND date_return=?",array($user_id,0))->row_array()['sum']);
	}
	
}