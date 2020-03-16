<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	function create($array){
		$array['sort'] = $this->db->query("SELECT COUNT(*) as count FROM category WHERE 1")->row_array()['count'] + 1;
		$ATA = array(
			null,
			$array['name'],
			$array['adult'],
			$array['pincode'],
			$array['sort']
		);
		$this->db->query("INSERT INTO `category`(`id`, `name`, `adult`, `pincode`, `sort`) VALUES (?,?,?,?,?)",$ATA);
		$cat_id = $this->db->insert_id();
		foreach($array['channels'] as $k=>$v){
			$this->db->query("UPDATE `channels` SET category=? WHERE id=?",array($cat_id,$v));
		}
		return true;
	}
	
	function edit($array){
		
		$ATA = array(
			$array['name'],
			$array['adult'],
			$array['pincode'],
			$array['id']
		);
		$this->db->query("UPDATE `category` SET name=?,adult=?,pincode=? WHERE id=?",$ATA);
		$this->db->query("UPDATE `channels` SET category=? WHERE category=?",array(0,$array['id']));
		foreach($array['channels'] as $k=>$v){
			$this->db->query("UPDATE `channels` SET category=? WHERE id=?",array($array['id'],$v));
		}
		return true;
	}
	
	
	function GetCategory($id=false){
		if($id){
			return $this->db->query("SELECT * FROM category WHERE id=?",array($id))->row_array();
		}else{
			return $this->db->query("SELECT * FROM category WHERE 1")->result_array();
		}
	}
	
	
	function GetCategoryPage($array){
		$array['offset'] = intval($array['offset']);
		$array['limit'] = intval($array['limit']);
		return $this->db->query("SELECT * FROM category WHERE 1 LIMIT {$array['offset']},{$array['limit']}")->result_array();
	}
	
	
	function GetCategoryCount(){
		return $this->db->query("SELECT COUNT(*) as count FROM category WHERE 1")->row_array()['count'];
	}
	
	function CountInCat($id){
		return $this->db->query("SELECT COUNT(*) as count FROM channels WHERE category=?",array($id))->row_array()['count'];
	}
	
}