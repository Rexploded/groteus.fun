<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tariffs_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	function create($array){
		
		$array['sort'] = $this->db->query("SELECT COUNT(*) as count FROM tariffs WHERE 1")->row_array()['count'] + 1;
		$ATA = array(
			null,
			$array['name'],
			$array['desc'],
			$array['connects'],
			$array['portals'],
			$array['active'],
			$array['archive'],
			$array['type'],
			$array['external_id'],
			$array['sort'],
		);
		$this->db->query("INSERT INTO `tariffs`(`id`, `name`, `description`, `connects`, `portals`, `active`, `archive`, `type`, `external_id`, `sort`) VALUES (?,?,?,?,?,?,?,?,?,?)",$ATA);
		$TID = $this->db->insert_id();
		
		$i = 1;
		foreach($array['ch'] as $k=>$v){
			$ATA = array(
				null,
				$k,
				$TID,
				$i,
			);
			$this->db->query("INSERT INTO `tariffs_channel`(`id`, `ch_id`, `tariff_id`, `sort`) VALUES (?,?,?,?)",$ATA);
			$i++;
		}
		
		foreach($array['period'] as $k=>$v){
			$ATA = array(
				null,
				$array['text'][$k],
				$array['cost'][$k],intval($array['long'][$k] * $v),
				$v,
				$TID,
				$k+1,
			);
			$this->db->query("INSERT INTO `tariffs_cost`(`id`, `name`, `amount`, `longs`, `mn`, `tariff_id`, `sort`) VALUES (?,?,?,?,?,?,?)",$ATA);
		}		
		
		return $TID;
		//return ($this->db->query("INSERT INTO `channels`(`id`, `name`, `nameott`, `fl`, `server`, `epg`, `epgsiptv`, `icon`, `category`, `archive`, `block`, `block_fl`, `block_pl`, `active`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$ATA)) ? true : false;
	}
	
	function edit($array){
		
		$array['sort'] = $this->db->query("SELECT COUNT(*) as count FROM tariffs WHERE 1")->row_array()['count'] + 1;
		if($array['type'] == 2){
			$array['external_id'] = '';
		}
		$ATA = array(
			$array['name'],
			$array['desc'],
			$array['connects'],
			$array['portals'],
			$array['active'],
			$array['archive'],
			$array['type'],
			$array['external_id'],
			$array['sort'],
			$array['id']
		);
		$this->db->query("UPDATE `tariffs` SET `name`=?, `description`=?, `connects`=?, `portals`=?, `active`=?, `archive`=?, `type`=?, `external_id`=?, `sort`=? WHERE id=?",$ATA);
		$TID = $array['id'];
		
		
		$this->db->query("DELETE FROM `tariffs_channel` WHERE tariff_id=?",array($TID));
		$i = 1;
		foreach($array['ch'] as $k=>$v){
			$ATA = array(
				null,
				$k,
				$TID,
				$i,
			);
			if($array['type'] == 1 OR $array['type'] == 2){
				$this->db->query("INSERT INTO `tariffs_channel`(`id`, `ch_id`, `tariff_id`, `sort`) VALUES (?,?,?,?)",$ATA);
			}
			$i++;
		}
		
		
		$this->db->query("DELETE FROM `tariffs_cost` WHERE tariff_id=?",array($TID));
		
		foreach($array['period'] as $k=>$v){
			$ATA = array(
				null,
				$array['text'][$k],
				$array['cost'][$k],intval($array['long'][$k] * $v),
				$v,
				$TID,
				$k+1,
			);
			$this->db->query("INSERT INTO `tariffs_cost`(`id`, `name`, `amount`, `longs`, `mn`, `tariff_id`, `sort`) VALUES (?,?,?,?,?,?,?)",$ATA);
		}		
		
		return $TID;
		//return ($this->db->query("INSERT INTO `channels`(`id`, `name`, `nameott`, `fl`, `server`, `epg`, `epgsiptv`, `icon`, `category`, `archive`, `block`, `block_fl`, `block_pl`, `active`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$ATA)) ? true : false;
	}

	
	
	function GetTariffsPage($array){
		$array['offset'] = intval($array['offset']);
		$array['limit'] = intval($array['limit']);
		return $this->db->query("SELECT * FROM tariffs WHERE 1 LIMIT {$array['offset']},{$array['limit']}")->result_array();
	}
	
	
	function GetTariffsCount($active = false){
		if($active){
			return $this->db->query("SELECT COUNT(*) as count FROM tariffs WHERE active=1")->row_array()['count'];
		}else{
			return $this->db->query("SELECT COUNT(*) as count FROM tariffs WHERE 1")->row_array()['count'];
		}
	}
	
	
	function GetCountInTariff($id){
		return $this->db->query("SELECT COUNT(*) as count FROM tariffs_channel WHERE tariff_id=?",array($id))->row_array()['count'];
	}
	
	
	function GetUsersInTariff($id){
		return $this->db->query("SELECT COUNT(*) as count FROM pack WHERE tariff_id=?",array($id))->row_array()['count'];
	}
	
	
	function GetTariff($id){
		$tariff = $this->db->query("SELECT * FROM tariffs WHERE id=?",array($id))->row_array();
		$tariff['cost'] = $this->db->query("SELECT * FROM tariffs_cost WHERE tariff_id=? ORDER by sort",array($tariff['id']))->result_array();
		$tariff['channels'] = $this->db->query("SELECT * FROM tariffs_channel WHERE tariff_id=? ORDER by sort",array($tariff['id']))->result_array();
		
		
		return $tariff;
	}
	
	
	function GetTariffs(){
		$tariffs = $this->db->query("SELECT * FROM tariffs WHERE 11",array($id))->result_array();
		foreach($tariffs as $k=>$v){
			$tariffs[$k]['cost'] = $this->db->query("SELECT * FROM tariffs_cost WHERE tariff_id=? ORDER by sort",array($tariff['id']))->result_array();
			$tariffs[$k]['channels'] = $this->db->query("SELECT * FROM tariffs_channel WHERE tariff_id=? ORDER by sort",array($tariff['id']))->result_array();
		}
		
		
		return $tariffs;
	}
	
}