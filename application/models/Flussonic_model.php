<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flussonic_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	public function GetChannelSessions($channel){
		$chh = array();
		$channels[] = $channel;
		$servers = array();
		$servers_names = array();
		foreach($this->admin->GetServers() as $k=>$v){
			if($v['username'] != '' AND $v['password'] != ''){
				$servers[$v['id']] = $v;
				$servers_names[$v['id']] = array();
			}
		}
		foreach($channels as $k=>$v){
			$chh[$v['id']] = $v;
			$v['server'] = array_diff(explode('|',$v['server']), array(''));
			foreach($v['server'] as $v2){
				$servers_names[$v2][] = $v['fl'];
			}
			
			
		}

		$CH_DATA = array();
		foreach($servers_names as $k=>$v){
			foreach($this->flussonic->GetSessions($servers[$k]['username'],$servers[$k]['password'],$servers[$k]['ip'],implode(',',$v)) as $k2=>$v2){
				$CH_DATA[$servers[$k]['id']][] = $v2;
			}
		}		
		
		return $CH_DATA;
	}
	
	public function GetChannelsData($channels){
		$chh = array();
		$servers = array();
		$servers_names = array();
		foreach($this->admin->GetServers() as $k=>$v){
			if($v['username'] != '' AND $v['password'] != ''){
				$servers[$v['id']] = $v;
				$servers_names[$v['id']] = array();
			}
		}
		foreach($channels as $k=>$v){
			$chh[$v['id']] = $v;
			$v['server'] = array_diff(explode('|',$v['server']), array(''));
			foreach($v['server'] as $v2){
				$servers_names[$v2][] = $v['fl'];
			}
			
			
		}

		$CH_DATA = array();
		foreach($servers_names as $k1=>$v1){
			//print_r($this->flussonic->GetMedia($servers[$k]['username'],$servers[$k]['password'],$servers[$k]['ip'],implode(',',$v)));
			foreach($this->flussonic->GetMedia($servers[$k1]['username'],$servers[$k1]['password'],$servers[$k1]['ip'],implode(',',$v1)) as $k=>$v){
				$CH_DATA['client_count'][$v['value']['name']] = ($CH_DATA['client_count'][$v['value']['name']]) ? intval($CH_DATA['client_count'][$v['value']['name']]) + $v['value']['stats']['client_count'] : $v['value']['stats']['client_count'];
				$CH_DATA['bitrate'][$k1][$v['value']['name']] = $v['value']['stats']['bitrate'];
			}
		}
		
		return $CH_DATA;
	}

	public function SessionDelete($username,$password,$ip,$session_id,$ssl=false){
		$auth = base64_encode("{$username}:{$password}");
		$context = stream_context_create([
			"http" => [
				'method' => 'POST',
				'header' => "Content-Type: text/html\r\nAuthorization: Basic $auth",
				'content' => "$session_id",
			]
		]);
		$ssl = ($ssl) ? 'https' : 'http';
		$homepage = file_get_contents("{$ssl}://{$ip}/flussonic/api/close_sessions", false, $context );
		return ($http_response_header[0] == 'HTTP/1.0 200 OK') ? true : false;
	}
	

	
	public function GetMedia($username,$password,$ip,$media=false,$ssl=false){
		$auth = base64_encode("{$username}:{$password}");
		$context = stream_context_create([
			"http" => [
				'header' => "Content-Type: application/x-www-form-urlencoded\r\nAuthorization: Basic $auth",
			]
		]);
		$ssl = ($ssl) ? 'https' : 'http';
		if($media){
			$media = (is_array($media)) ? '?name='.implode(',',$media) : '?name='.$media;
		}
		$response = file_get_contents("{$ssl}://{$ip}/flussonic/api/media".$media, false, $context );
		return ($http_response_header[0] == 'HTTP/1.0 200 OK') ? json_decode($response,true) : false;	
	}
	

	
	public function GetSessions($username,$password,$ip,$media=false,$ssl=false){
		$auth = base64_encode("{$username}:{$password}");
		$context = stream_context_create([
			"http" => [
				'header' => "Content-Type: application/x-www-form-urlencoded\r\nAuthorization: Basic $auth",
			]
		]);
		$ssl = ($ssl) ? 'https' : 'http';
		if($media){
			$media = (is_array($media)) ? '?name='.implode(',',$media) : '?name='.$media;
		}
		$response = file_get_contents("{$ssl}://{$ip}/flussonic/api/sessions".$media, false, $context );
		return ($http_response_header[0] == 'HTTP/1.0 200 OK') ? json_decode($response,true)['sessions'] : false;	
	}
	

	
	public function GetInfo($username,$password,$ip,$ssl=false){
		$auth = base64_encode("{$username}:{$password}");
		$context = stream_context_create([
			"http" => [
				'header' => "Content-Type: application/x-www-form-urlencoded\r\nAuthorization: Basic $auth",
			]
		]);
		$ssl = ($ssl) ? 'https' : 'http';
		$response = file_get_contents("{$ssl}://{$ip}/flussonic/api/server", false, $context );
		return ($http_response_header[0] == 'HTTP/1.0 200 OK') ? json_decode($response,true) : false;	
	}
	
	public function GetClasters($username,$password,$ip,$ssl=false){
		$auth = base64_encode("{$username}:{$password}");
		$context = stream_context_create([
			"http" => [
				'header' => "Content-Type: application/x-www-form-urlencoded\r\nAuthorization: Basic $auth",
			]
		]);
		$ssl = ($ssl) ? 'https' : 'http';
		$response = file_get_contents("{$ssl}://{$ip}/flussonic/api/cluster_servers", false, $context );
		return ($http_response_header[0] == 'HTTP/1.0 200 OK') ? json_decode($response,true) : false;	
	}
}