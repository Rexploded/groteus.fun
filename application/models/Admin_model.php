<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	
	public function GetServers($id=false){
		return ($id) ? $this->db->query("SELECT * FROM servers WHERE id=?",array($id))->row_array() : $this->db->query("SELECT * FROM servers WHERE 1")->result_array();
	}
	
	
	public function DeleteServer($id=false){
			$this->db->query("DELETE FROM servers WHERE id=?",array($id))->row_array();
			$this->db->query("UPDATE users SET server=? WHERE server=?",array(0,$id));
			$this->db->query("UPDATE channels SET server=? WHERE server=?",array(0,$id));
	}
	
	public function EditServer($array){
		$ATA = array(
			$array['name'],
			$array['desc'],
			$array['ip'],
			$array['username'],
			$array['password'],
			$array['domain'],
			$array['port'],
			$array['secure'],
			$array['id'],
		);
		$this->db->query("UPDATE `servers` SET `name`=?, `description`=?, `ip`=?, `username`=?, `password`=?, `domain`=?, `port`=?, `secure`=? WHERE id=?",$ATA);
	}
	
	public function CreateServer($array){
		$ATA = array(
			null,
			$array['name'],
			$array['desc'],
			$array['ip'],
			$array['username'],
			$array['password'],
			$array['domain'],
			$array['port'],
			$array['secure'],
			0,
		);
		$this->db->query("INSERT INTO `servers`(`id`, `name`, `description`, `ip`, `username`, `password`, `domain`, `port`, `secure`, `sort`) VALUES (?,?,?,?,?,?,?,?,?,?)",$ATA);
	}
	
	public function GetServer($id){
		return $this->db->query("SELECT * FROM servers WHERE id=?",array($id))->row_array();
	}
	
	
	
	
	function GetNewsPage(){
		$LIMIT = (isset($array['offset']) AND isset($array['limit'])) ? "LIMIT {$array['offset']},{$array['limit']}" : '';
		return $this->db->query("SELECT * FROM news WHERE 1 {$LIMIT} ORDER by id DESC")->result_array();
	}
	
	
	function GetNewsCount(){
			return $this->db->query("SELECT COUNT(*) as count FROM news WHERE 1")->row_array()['count'];
	}	
	
	
	function GetNews($id){
		$return = $this->db->query("SELECT * FROM news WHERE id=?",array($id))->row_array();
		
		$lang_list = array();
		foreach(array_diff(explode('|',$return['langs']), array('')) as $k=>$v){
			if($this->system->get_lang_list()[$v]){
				$lang_list[] = $this->system->get_lang_list()[$v]['SYMBOL'];
			}
		}
		$return['langs'] = $lang_list;
		
		$not_langs_list = array();
		foreach(array_diff(explode('|',$return['not_langs']), array('')) as $k=>$v){
			if($this->system->get_lang_list()[$v]){
				$not_langs_list[] = $this->system->get_lang_list()[$v]['SYMBOL'];
			}
		}
		$return['not_langs'] = $not_langs_list;
		
		
		
		
		$group_list = array();
		foreach(array_diff(explode('|',$return['user_groups']), array('')) as $k=>$v){
			if($this->users->GetGroupName($v)){
				$group_list[] = $v;
			}
		}
		$return['user_groups'] = $group_list;
		
		$not_group_list = array();
		foreach(array_diff(explode('|',$return['not_user_groups']), array('')) as $k=>$v){
			if($this->users->GetGroupName($v)){
				$not_group_list[] = $v;
			}
		}
		$return['not_user_groups'] = $not_group_list;
		
		
		
		
		$users_list = array();
		foreach(array_diff(explode('|',$return['users']), array('')) as $k=>$v){
			if($this->users->GetUserById($v)['username']){
				$users_list[] = $this->users->GetUserById($v)['username'];
			}
		}
		$return['users'] = implode(',',$users_list);
		
		$not_users = array();
		foreach(array_diff(explode('|',$return['not_users']), array('')) as $k=>$v){
			if($this->users->GetUserById($v)['username']){
				$not_users[] = $this->users->GetUserById($v)['username'];
			}
		}
		$return['not_users'] = implode(',',$not_users);
		
		
		//print_r($return);
		
		return $return;
	}
	
	function EditNews($array){
		$user_groups = '';
		foreach($array['user_groups'] as $k=>$v){
			$user_groups .= "|{$v}|";
		}
		$array['user_groups'] = $user_groups;
		
		
		
		
		$langs = '';
		foreach($array['langs'] as $k=>$v){
			$langs .= "|{$v}|";
		}
		$array['langs'] = $langs;
		
		
		$not_user_groups = '';
		foreach($array['not_user_groups'] as $k=>$v){
			$not_user_groups .= "|{$v}|";
		}
		$array['not_user_groups'] = $not_user_groups;
		
		
		
		
		$not_langs = '';
		foreach($array['not_langs'] as $k=>$v){
			$not_langs .= "|{$v}|";
		}
		$array['not_langs'] = $not_langs;
		
		
		
		$ATA = array(
			$array['user_groups'],
			$array['users'],
			$array['langs'],
			$array['not_user_groups'],
			$array['not_users'],
			$array['not_langs'],
			$array['title'],
			$array['text'],
			$array['id'],
		);
		$this->db->query("UPDATE `news` SET `user_groups`=?,`users`=?,`langs`=?,`not_user_groups`=?,`not_users`=?,`not_langs`=?,`title`=?,`text`=? WHERE id=?",$ATA);
	}
	
	
	
	function CreateNews($array){
		$ATA = array(
			null,
			$array['user_groups'],
			$array['users'],
			$array['langs'],
			$array['not_user_groups'],
			$array['not_users'],
			$array['not_langs'],
			$array['title'],
			$array['text'],			
			$array['date'],			
		);
		
		$this->db->query("INSERT INTO `news`(`id`, `user_groups`, `users`, `langs`, `not_user_groups`, `not_users`, `not_langs`, `title`, `text`, `date`) VALUES (?,?,?,?,?,?,?,?,?,?)",$ATA);
	}
	
	/* 
	public function EditChannel($param){
		return ($this->db->query("UPDATE `channels` SET `name`=?,`fl`=?,`epg`=?,`icon`=?,`category`=[value-6],`archive`=[value-7],`block`=[value-8],`block_fl`=[value-9],`block_pl`=[value-10] WHERE 1")) ? $this->db->insert_id() : false;
	} */
	
}