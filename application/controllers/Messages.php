<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for Admin group only
 */
class Messages extends MY_Controller {

	protected $access = "1,2,3";

	
    function __construct() 
    {
        parent::__construct();
	}
	
	
	function sendmessage(){
		echo 123;
	}
	
	public function send_text_message(){
		$post = $this->input->post();
		$messageTxt='';
		$attachment_name='';
		$file_ext='';
		$mime_type='';
		$post['receiver_id'] = intval($post['receiver_id']);
		if($post['receiver_id']==0){
			die();
		}
		if(isset($post['type'])=='Attachment'){
		 	$AttachmentData = $this->ChatAttachmentUpload();
			//print_r($AttachmentData);
			$attachment_name = $AttachmentData['file_name'];
			$client_name = $AttachmentData['client_name'];
			$file_ext = $AttachmentData['file_ext'];
			$mime_type = $AttachmentData['file_type'];
			$file_size = $this->system->get_size($AttachmentData['file_size']);
			 
		}else{
			$messageTxt = reduce_multiples(htmlspecialchars($post['messageTxt']),' ');
			if($messageTxt == ''){
				die();
			}
		}	
		 
				$data=[
 					'sender_id' => $this->session->userdata('id'),
					'receiver_id' => $post['receiver_id'],
					'message' =>   $messageTxt,
					'attachment_real_name' => $attachment_name,
					'attachment_name' => $client_name,
					'file_ext' => $file_ext,
					'mime_type' => $mime_type,
					'file_size' => $file_size,
					'message_date_time' => time(), //23 Jan 2:05 pm
					'ip_address' => $this->input->ip_address(),
				];
		  
 				$query = $this->SendTxtMessage($this->security->xss_clean($data));
 				$response='';
				if($query){
					$datas = $this->db->query("SELECT * FROM chat WHERE id=?",array($query))->row_array();
					$response = ['status' => 1 ,'message' => '','id'=>$query,'data'=>$datas,'date'=>date('H:i') ];
				}else{
					$response = ['status' => 0 ,'message' => 'sorry we re having some technical problems. please try again !' 						];
				}
             
 		   echo json_encode($response);
	}


	public function ChatAttachmentUpload(){
		 
		
		$file_data='';
		if(isset($_FILES['attachmentfile']['name']) && !empty($_FILES['attachmentfile']['name']) AND $this->CONFIG->get('sys_messages_allow_files_upload')){	
				$config['upload_path']          = './uploads/attachments/';
				$config['allowed_types']        = $this->CONFIG->get('messages_allow_files_upload');
				$config['file_ext_tolower']        = true;
				$config['encrypt_name']        = true;
				//$config['file_name']        = md5(uniqid());
				if($this->CONFIG->get('messages_files_upload_max_size') != 0){
					$config['max_size']             = $this->CONFIG->get('messages_files_upload_max_size');
				}
				//$config['max_width']            = 1024;
				//$config['max_height']           = 768;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('attachmentfile'))
				{
					echo json_encode(['status' => 0,
					'message' => '<span style="color:#900;">'.$this->upload->display_errors(). '<span>' ]); die;
				}
				else
				{
					$file_data = $this->upload->data();
					//$filePath = $file_data['file_name'];
					return $file_data;
				}
		    }
 		 
	}	

	public function SendTxtMessage($data){
  		$res = $this->db->insert('chat', $data ); 
 		if($res == 1){
		$ID = $this->db->insert_id();
 			return $ID;
 		}else{
 			return false;
		}
	}
	
	
	public function get_chat_history_by_vendor($receiver_id){
		
$last = (intval($this->input->get('last')) > 0) ? intval($this->input->get('last')) : false;

				echo json_encode($this->GetReciverChatHistory($receiver_id,$last));
				
 		
	}
	
	
	
	
	function state(){
		$return = array();
		$users = $this->input->POST('users');
		foreach($users as $k=>$v){
			$return[$v] = array(
			'online'=>$this->users->GetOnlineById($v),
			'unread'=>$this->messages->GetUnredMessageCount($v)
			);
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($return));
	}
	
	
	
	
	
	

	
	
	
	
	
	public function GetReciverChatHistory($receiver_id,$last=false){
		
		$sender_id = $this->session->userdata('id');
		$this->db->query("UPDATE chat SET read_date_time=? WHERE receiver_id=? AND sender_id=?",array(time(),$sender_id,$receiver_id));
		if($last){
			$ansver = $this->db->query("SELECT * FROM chat WHERE ((sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)) AND id > ?",array($sender_id,$receiver_id,$receiver_id,$sender_id,$last))->result_array();
		}else{
			$ansver = $this->db->query("SELECT * FROM chat WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)",array($sender_id,$receiver_id,$receiver_id,$sender_id))->result_array();
		}
			foreach($ansver as $k=>$v){
				$ansver[$k]['date'] = (date('d.m.Y') == date('d.m.Y',$v['message_date_time'])) ? date('H:i',$v['message_date_time']) : date('d.m.Y H:i',$v['message_date_time']);
			}		
		return $ansver;
	}	
	
	
	
}