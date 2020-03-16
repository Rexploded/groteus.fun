<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for (all) non logged in users
 */
class Flussonic extends CI_Controller {	


	public function index($KEY)
	{
		if($KEY != $this->CONFIG->get('flussonic_key')){
			show_404();
		}
		
		$ATA = array(
			null,
			json_encode($this->input->get())
		);
		$this->db->query("INSERT INTO `test`(`id`, `data`) VALUES (?,?)",$ATA);
		header('X-UserId: 1');
		header('X-Max-Sessions: 2');
	}

	function get($id){
		print_r(json_decode($this->db->query("SELECT * FROM test WHERE id=?",array($id))->row_array()['data'],true));
	}
	
	
	function api2($id){
		$auth = base64_encode("flussonic:flussonic");
		$context = stream_context_create([
			"http" => [
				'method' => 'POST',
				'header' => "Content-Type: text/html\r\nAuthorization: Basic $auth",
				'content' => "3c3674434df3cfa5bdba1314c74051466a1d236b-1584331621640",
			]
		]);
		$homepage = file_get_contents("http://194.67.92.512/flussonic/api/close_sessions", false, $context );
		print_r($http_response_header);
	}
	
	
	function api($id){
		print_r($this->flussonic->GetSessions('flussonic','flussonic','194.67.92.51'));
	}
	
	
	
	
}