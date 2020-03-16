<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channels_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	function create($array){
		
		$ATA = array(
			null,
			$array['name'],
			$array['nameott'],
			$array['fl'],
			$array['server'],
			$array['epg'],
			$array['epgsiptv'],
			$array['icon'],
			0,
			$array['archive'],
			$array['block'],
			$array['block_fl'],
			$array['block_pl'],
			$array['active'],
		);
		return ($this->db->query("INSERT INTO `channels`(`id`, `name`, `nameott`, `fl`, `server`, `epg`, `epgsiptv`, `icon`, `category`, `archive`, `block`, `block_fl`, `block_pl`, `active`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$ATA)) ? true : false;
	}
	
	function edit($array){
		
		$ATA = array(
			$array['name'],
			$array['nameott'],
			$array['fl'],
			$array['server'],
			$array['epg'],
			$array['epgsiptv'],
			$array['icon'],
			0,
			$array['archive'],
			$array['block'],
			$array['block_fl'],
			$array['block_pl'],
			$array['active'],
			$array['id'],
		);
		return ($this->db->query("UPDATE `channels` SET `name`=?, `nameott`=?, `fl`=?, `server`=?, `epg`=?, `epgsiptv`=?, `icon`=?, `category`=?, `archive`=?, `block`=?, `block_fl`=?, `block_pl`=?, `active`=? WHERE id=?",$ATA)) ? true : false;
	}
	
	
	function GetChannel($id){
		return $this->db->query("SELECT * FROM channels WHERE id=?",array($id))->row_array();
	}
	
	
	function GetChannels($active = false){
		if($active){
			return $this->db->query("SELECT * FROM channels WHERE active=1")->result_array();
		}else{
			return $this->db->query("SELECT * FROM channels WHERE 1")->result_array();
		}
	}
	
	
	function GetChannelsPage($array){
		$array['offset'] = intval($array['offset']);
		$array['limit'] = intval($array['limit']);
		return $this->db->query("SELECT * FROM channels WHERE 1 LIMIT {$array['offset']},{$array['limit']}")->result_array();
	}
	
	
	function GetChannelsCount($active = false){
		if($active){
			return $this->db->query("SELECT COUNT(*) as count FROM channels WHERE active=1")->row_array()['count'];
		}else{
			return $this->db->query("SELECT COUNT(*) as count FROM channels WHERE 1")->row_array()['count'];
		}
	}
	
	
	function GetName($id){
		return $this->db->query("SELECT * FROM channels WHERE id=?",array($id))->row_array()['name'];
	}
	
	
	function GetFl($id){
		return $this->db->query("SELECT * FROM channels WHERE id=?",array($id))->row_array()['fl'];
	}
	
}