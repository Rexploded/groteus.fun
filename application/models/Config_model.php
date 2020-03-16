<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	function get($key){
		if(!$this->cache->file->get('CONFIG')){
			//$val = $this->db->query("SELECT value FROM settings WHERE name=?",array($key))->row_array();
			$CONFIG = array();
			$LIST = $this->db->query("SELECT * FROM settings WHERE 1")->result_array();
			foreach($LIST as $k=>$v){
				$CONFIG[$v['name']] = $v['value'];
			}
			$this->cache->file->save('CONFIG', $CONFIG, $this->config->item('cache_time'));
		}else{
			$CONFIG = $this->cache->file->get('CONFIG');
		}
		return ($CONFIG[$key]) ? $CONFIG[$key] : '';
	}
	
	function set($key,$val){
		$val = ($val == NULL) ? '' : $val;
		$this->cache->file->delete('CONFIG');
		if($this->db->query("SELECT COUNT(*) as count FROM settings WHERE name=?",array($key))->row_array()['count'] == 0){
			return ($this->db->query("INSERT INTO `settings` (`id`, `name`, `value`) VALUES (?,?,?)",array(null,$key,$val))) ? true : false;
		}else{
			return ($this->db->query("UPDATE settings SET value=? WHERE name=?",array($val,$key))) ? true : false;
		}
		
	}


}