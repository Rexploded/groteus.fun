<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	public function GetUsersCount($array = false){
		
		$WHERE[] = '1';
		$ORDER = array();
		$ATA = array();
		if(isset($_GET['table_search']) & $_GET['table_search'] != ''){
			$WHERE[] = "username LIKE ?";
			$ATA[] = "%".$_GET['table_search']."%";
		}
		
		if(isset($_GET['username']) & $_GET['username'] != ''){
			$WHERE[] = "username LIKE ?";
			$ATA[] = "%".$_GET['username']."%";
		}
		
		if(isset($_GET['email']) & $_GET['email'] != ''){
			$WHERE[] = "email LIKE ?";
			$ATA[] = "%".$_GET['email']."%";
		}
		
		if(isset($_GET['phone']) & $_GET['phone'] != ''){
			switch (intval($_GET['phone'])) {
				case 1:
					$WHERE[] = "active=1";
					break;
				case 2:
					$WHERE[] = "active=0";
					break;
				case 3:
					$WHERE[] = "ban=1";
					break;
				case 4:
					$WHERE[] = "ban=0";
					break;
				case 5:
					$WHERE[] = "active=1 AND ban=0";
					break;
				case 6:
					$WHERE[] = "active=1 AND ban=1";
					break;
				case 7:
					$WHERE[] = "active=0 AND ban=1";
					break;
				case 8:
					$WHERE[] = "active=0 AND ban=0";
					break;
			}
		}
		
		if(isset($_GET['user_group']) & $_GET['user_group'] != '---'){
			$WHERE[] = "user_group LIKE ?";
			$ATA[] = "%".$_GET['user_group']."%";
		}
		
		
		if(count($WHERE) == 1){
			$WHERE = $WHERE[0];
		}else{
			unset($WHERE[0]);
			$WHERE = implode(" AND ",$WHERE);
		}
		
		
		if(isset($_GET['username_sort']) AND ($_GET['username_sort'] == 'asc' OR $_GET['username_sort'] == 'desc')){
			$ORDER[] = ' username '.$_GET['username_sort'];
		}
		
		if(isset($_GET['registration_sort']) AND ($_GET['registration_sort'] == 'asc' OR $_GET['registration_sort'] == 'desc')){
			$ORDER[] = ' created_at '.$_GET['registration_sort'];
		}
		
		if(isset($_GET['balance']) AND ($_GET['balance'] == 'asc' OR $_GET['balance'] == 'desc')){
			$ORDER[] = ' balance '.$_GET['balance'];
		}
		
		if(count($ORDER) == 0){
			$ORDER = '';
		}else{
			$ORDER = "ORDER BY ".implode(',',$ORDER);
		}
		
		 
		$this->data['FORMF']['table_search'] = $this->input->get('table_search');
		$this->data['FORMF']['username'] = $this->input->get('username');
		$this->data['FORMF']['email'] = $this->input->get('email');
		$this->data['FORMF']['phone'] = $this->input->get('phone');
		$this->data['FORMF']['user_group'] = $this->input->get('user_group');
		$this->data['FORMF']['username_sort'] = $this->input->get('username_sort');
		$this->data['FORMF']['registration_sort'] = $this->input->get('registration_sort');
		$this->data['FORMF']['balance'] = $this->input->get('balance');
		if(isset($array['offset']) AND isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			return $this->db->query("SELECT COUNT(*) as count FROM users WHERE {$WHERE} {$ORDER} LIMIT {$array['offset']},{$array['limit']}",$ATA)->row_array()['count'];
		}else{
			return $this->db->query("SELECT COUNT(*) as count FROM users WHERE {$WHERE}",$ATA)->row_array()['count'];
		}
	}
	public function GetUsersPage($array = false){
		
		$WHERE[] = '1';
		$ORDER = array();
		$ATA = array();
		if(isset($_GET['table_search']) & $_GET['table_search'] != ''){
			$WHERE[] = "username LIKE ?";
			$ATA[] = "%".$_GET['table_search']."%";
		}
		
		if(isset($_GET['username']) & $_GET['username'] != ''){
			$WHERE[] = "username LIKE ?";
			$ATA[] = "%".$_GET['username']."%";
		}
		
		if(isset($_GET['email']) & $_GET['email'] != ''){
			$WHERE[] = "email LIKE ?";
			$ATA[] = "%".$_GET['email']."%";
		}
		
		if(isset($_GET['phone']) & $_GET['phone'] != ''){
			switch (intval($_GET['phone'])) {
				case 1:
					$WHERE[] = "active=1";
					break;
				case 2:
					$WHERE[] = "active=0";
					break;
				case 3:
					$WHERE[] = "ban=1";
					break;
				case 4:
					$WHERE[] = "ban=0";
					break;
				case 5:
					$WHERE[] = "active=1 AND ban=0";
					break;
				case 6:
					$WHERE[] = "active=1 AND ban=1";
					break;
				case 7:
					$WHERE[] = "active=0 AND ban=1";
					break;
				case 8:
					$WHERE[] = "active=0 AND ban=0";
					break;
			}
		}
		
		
		if(isset($_GET['user_group']) & $_GET['user_group'] != '---'){
			$WHERE[] = "user_group LIKE ?";
			$ATA[] = "%".$_GET['user_group']."%";
		}
		
		
		if(count($WHERE) == 1){
			$WHERE = $WHERE[0];
		}else{
			unset($WHERE[0]);
			$WHERE = implode(" AND ",$WHERE);
		}
		
		
		if(isset($_GET['username_sort']) AND ($_GET['username_sort'] == 'asc' OR $_GET['username_sort'] == 'desc')){
			$ORDER[] = ' username '.$_GET['username_sort'];
		}
		
		if(isset($_GET['registration_sort']) AND ($_GET['registration_sort'] == 'asc' OR $_GET['registration_sort'] == 'desc')){
			$ORDER[] = ' created_at '.$_GET['registration_sort'];
		}
		
		if(isset($_GET['balance']) AND ($_GET['balance'] == 'asc' OR $_GET['balance'] == 'desc')){
			$ORDER[] = ' balance '.$_GET['balance'];
		}
		
		if(count($ORDER) == 0){
			$ORDER = '';
		}else{
			$ORDER = "ORDER BY ".implode(',',$ORDER);
		}
		
		
		$this->data['FORMF']['table_search'] = $_GET['table_search'];
		$this->data['FORMF']['username'] = $_GET['username'];
		$this->data['FORMF']['email'] = $_GET['email'];
		$this->data['FORMF']['phone'] = $_GET['phone'];
		$this->data['FORMF']['user_group'] = $_GET['user_group'];
		$this->data['FORMF']['username_sort'] = $_GET['username_sort'];
		$this->data['FORMF']['registration_sort'] = $_GET['registration_sort'];
		$this->data['FORMF']['balance'] = $_GET['balance'];
		if(isset($array['offset']) AND isset($array['limit'])){
			$array['offset'] = intval($array['offset']);
			$array['limit'] = intval($array['limit']);
			return $this->db->query("SELECT * FROM users WHERE {$WHERE} {$ORDER} LIMIT {$array['offset']},{$array['limit']}",$ATA)->result_array();
		}else{
			return $this->db->query("SELECT * FROM users WHERE {$WHERE}",$ATA)->result_array();
		}
	}
	
	
	function GetUserGroups($id=false){
		return ($id) ? $this->db->query("SELECT * FROM user_groups WHERE id=?",array($id))->row_array() : $this->db->query("SELECT * FROM user_groups WHERE 1")->result_array();
	}
	
	
	function GetCountPack($user_id){
		return $this->db->query("SELECT COUNT(*) as count FROM pack WHERE user_id=?",array($user_id))->row_array()['count'];
	}
	
	
	function GetGroupName($id){
		return $this->db->query("SELECT * FROM user_groups WHERE id=?",array($id))->row_array()['name'];
	}
	
	
	function GetUserById($id){
		return $this->db->query("SELECT * FROM users WHERE id=?",array($id))->row_array();
	}
	
	
	function DELETE($user_id){
		
		if($this->CONFIG->get('user_delete_and_billing_history')){
			$this->db->query("DELETE FROM billing_history WHERE user_id=?",array($user_id));
			$this->db->query("DELETE FROM pay WHERE user_id=?",array($user_id));
			$this->db->query("DELETE FROM prcodes WHERE user_id=?",array($user_id));
			$this->db->query("DELETE FROM refferals WHERE user_id=? OR new_user_id=?",array($user_id,$user_id));
			$this->db->query("DELETE FROM refund WHERE user_id=?",array($user_id));
		}
		$this->db->query("DELETE FROM refferals_rules_users WHERE user_id=?",array($user_id));
		$this->db->query("DELETE FROM ci_sessions WHERE user_id=?",array($user_id));
		$this->db->query("DELETE FROM pack WHERE user_id=?",array($user_id));
		$this->db->query("DELETE FROM users WHERE id=?",array($user_id));
	}
	function GetUserByUsername($username){
		return $this->db->query("SELECT * FROM users WHERE username=?",array($username))->row_array();
	}
	
	function EditGroup($array){
		$ATA = array(
			$array['name'],
			$array['id'],
		);
		$this->db->query("UPDATE user_groups SET name=? WHERE id=?",$ATA);
	}
	
	function GetBanReasonByUsername($username){
		$USER = $this->GetUserByUsername($username);
		$return = $USER['ban_reason'];
		$return = str_replace('{%username%}',$username,$return);
		$return = str_replace('{%hour%}',$USER['ban_long'],$return);
		$return = str_replace('{%day%}',$USER['ban_long']%24,$return);
		return $return;
	} 
	
	public function GetOnlineById($id){
		$user = $this->GetUserById($id);
		return (time()-120 > $user['last_online']) ? false : true;
	}
	
	public function GetOnlineByUsername($username){
		$user = $this->GetUserByUsername($username);
		return (time()-120 > $user['last_online']) ? false : true;
	}
	
}