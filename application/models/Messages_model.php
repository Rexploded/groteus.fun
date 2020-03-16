<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_model extends CI_Model {
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	function GetUserList($id){
		$LIST = array();
		$LAST = $this->db->query("SELECT * FROM chat WHERE receiver_id=? OR sender_id=? GROUP by receiver_id,sender_id ORDER by message_date_time DESC",array($id,$id))->result_array();
		foreach($LAST as $k=>$v){
			$LIST[$v['sender_id']] = '';
			$LIST[$v['receiver_id']] = '';
		}
		unset($LIST[$id]);
		foreach($LIST as $k=>$v){
			$LIST[$k] = $this->users->GetUserById($k);
			$LIST[$k]['last'] = $this->db->query("SELECT * FROM chat WHERE sender_id=? ORDER by message_date_time DESC",array($k))->row_array();
		}
/* 		foreach($LAST as $k=>$v){
			$USER = ($v['sender_id'] == $id) ? $this->users->GetUserById($v['receiver_id']) : $this->users->GetUserById($v['sender_id']);
			$USER['last'] = $v;
			$LIST[] = $USER;
		} */
		$LIST = array_values( $LIST ) ;
		return $LIST;
	}
	
	public function GetChatHistory($receiver_id){
		
		$sender_id = $this->session->userdata('id');
		$this->db->query("UPDATE chat SET read_date_time=? WHERE receiver_id=? AND sender_id=?",array(time(),$sender_id,$receiver_id));
		$condition= " `sender_id`= '$sender_id' AND `receiver_id` = '$receiver_id' OR `sender_id`= '$receiver_id' AND `receiver_id` = '$sender_id'";
		
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where($condition);
   		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
	}	

	
	public function GetUnredMessageCount($sender_id){
		$receiver_id = $this->session->userdata('id');
		return $this->db->query("SELECT COUNT(*) as count FROM chat WHERE read_date_time=? AND receiver_id=? AND sender_id=?",array(0,$receiver_id,$sender_id))->row_array()['count'];
	}	
}