<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	public function access($array,$sign='AND'){
		$sign = ($sign == 'AND' OR $sign == 'OR') ? $sign : 'AND';
		if(is_array($array)){
			$count = 0;
			foreach($array as $k=>$v){
				$count = ($this->PR($v,$this->session->userdata('user_group'))) ? $count + 1 : $count;
			}
			if($sign == "OR"){
				return ($count > 0) ? true : false;
			}else{
				return (count($array) == $count) ? true : false;
			}
		}else{
			if($this->PR($array,
			$this->session->userdata('user_group'))){
				return true;
			}else{
				return false;
			}
		}
	}

	public function GetAccess($name){
		$ac = $this->db->query("SELECT * FROM privilegies WHERE name=?",array($name))->row_array();
		$return = array();
		foreach($this->db->query("SELECT * FROM privilegies_group WHERE pr_id=?",array($ac['id']))->result_array() as $k=>$v){
			$return[] = $v['group_id'];
		}
		
		return (count($return) > 0) ? implode(',',$return) : '0';
	}
	
	public function accessRedirect($array,$sign='AND'){
		$sign = ($sign == 'AND' OR $sign == 'OR') ? $sign : 'AND';
		if(is_array($array)){
			$count = 0;
			foreach($array as $k=>$v){
				$count = ($this->PR($v,$this->session->userdata('user_group'))) ? $count + 1 : $count;
			}
			if($sign == "OR"){
				$return = ($count > 0) ? true : false;
			}else{
				$return = (count($array) == $count) ? true : false;
			}
		}else{
			if($this->PR($array,
			$this->session->userdata('user_group'))){
				$return = true;
			}else{
				$return = false;
			}
		}
		
		if(!$return){
			redirect("auth");
		}else{
			return true;
		}
	}
	
	public function accessError($array,$sign='AND'){
		$sign = ($sign == 'AND' OR $sign == 'OR') ? $sign : 'AND';
		if(is_array($array)){
			$count = 0;
			foreach($array as $k=>$v){
				$count = ($this->PR($v,$this->session->userdata('user_group'))) ? $count + 1 : $count;
			}
			if($sign == "OR"){
				$return = ($count > 0) ? true : false;
			}else{
				$return = (count($array) == $count) ? true : false;
			}
		}else{
			if($this->PR($array,
			$this->session->userdata('user_group'))){
				$return = true;
			}else{
				$return = false;
			}
		}
		
		if(!$return){
			show_error('You dont have premission to this action.',403,'Access Denied');exit();
		}else{
			return true;
		}
	}
	
	function GetPRS(){
		if(!$this->cache->file->get('PR')){
			$temp = $this->db->query("SELECT * FROM privilegies WHERE 1")->result_array();
			foreach($temp as $k=>$v){
				$privilegies[$v['id']] = $v['name'];
			}
			$this->cache->file->save('PR', $privilegies, $this->config->item('cache_time'));
		}else{
			$privilegies = $this->cache->file->get('PR');
		}
		return $privilegies;		
	}
	private function GetPRName($id){
		if(!$this->cache->file->get('PR')){
			$temp = $this->db->query("SELECT * FROM privilegies WHERE 1")->result_array();
			foreach($temp as $k=>$v){
				$privilegies[$v['id']] = $v['name'];
			}
			$this->cache->file->save('PR', $privilegies, $this->config->item('cache_time'));
		}else{
			$privilegies = $this->cache->file->get('PR');
		}
		return $privilegies[$id];
	}
	
	public function PR($PR,$user_group){
		if(!$this->cache->file->get('PR_'.$user_group)){
			$privilegies = $this->db->query("SELECT * FROM privilegies_group WHERE group_id=?",array($user_group))->result_array();
			
			
			
			$this->cache->file->save('PR_'.$user_group, $privilegies, $this->config->item('cache_time'));
		}else{
			$privilegies = $this->cache->file->get('PR_'.$user_group);
		}
		$return = false;
		foreach($privilegies as $k=>$v){
			if($PR == $this->GetPRName($v['pr_id'])){
				$return = true;
				break;
			}
		}
		return $return;
	}
	
	public function declines($number, $after) {
		if(!is_array($after)){
			$after = explode('|',$after);
		}
		$number = intval($number);
	  $cases = array (2, 0, 1, 1, 1, 2);
	  return $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
	}
	
	
	public function GetUserSessions($user_id){
		$SESSIONS = $this->db->query("SELECT * FROM ci_sessions WHERE user_id=?",array($user_id))->result_array();
		foreach($SESSIONS as $k=>$v){
			$SESSIONS[$k]['server'] = json_decode($v['server'],true);
		}
		return $SESSIONS;
	}
	
	
	public function DeleteUserSessions($user_id=false,$session_id=false){
		if($session_id){
			$this->db->query("DELETE FROM ci_sessions WHERE id=?",array($session_id));
		}else{
			$this->db->query("DELETE FROM ci_sessions WHERE user_id=?",array($user_id));
		}
	}
	
	public function GetCountryCodeByIp($ip_address) {

	  require APPPATH .'libraries/Geoip/autoload.php';
	  $reader = new GeoIp2\Database\Reader(FCPATH.'application/libraries/Geoip/GeoLite2.mmdb');

	  $record = $reader->country($ip_address);

	  return $record->country->isoCode;
	}		
	
	public function GetCountryNameByIp($ip_address) {

	  require APPPATH .'libraries/Geoip/autoload.php';
	  $reader = new GeoIp2\Database\Reader(FCPATH.'application/libraries/Geoip/GeoLite2.mmdb');

	  $record = $reader->country($ip_address);

	  return $record->country->name;
	}		
	
	public function GetCountryIconByIp($ip_address) {

	  require APPPATH .'libraries/Geoip/autoload.php';
	  $reader = new GeoIp2\Database\Reader(FCPATH.'application/libraries/Geoip/GeoLite2.mmdb');

	  $record = $reader->country($ip_address);
		if(file_exists(FCPATH.'/uploads/country/'.$record->country->isoCode .'.svg')){
			return '/uploads/country/'.$record->country->isoCode .'.svg';
		}else{
			return false;
		}
	  //return $record->country->isoCode;
	}		
	
	function SetGroupPR($PRS,$group_id){
		$this->db->query("DELETE FROM privilegies_group WHERE group_id=?",array($group_id));
		foreach($PRS as $v){
			$this->db->query("INSERT INTO `privilegies_group`(`group_id`, `pr_id`) VALUES (?,?)",array($group_id,$v));
		}
		$this->cache->file->delete('PR');
		$this->cache->file->delete('PR_'.$group_id);
	}

	function GetPrivilegies(){
		$privilegies = $this->db->query("SELECT * FROM privilegies WHERE 1")->result_array();
		return $privilegies;
	}
	
function get_size( $bytes )
 {
	 $bytes = $bytes * 1024;
 if ( $bytes < 1000 * 1024 ) {
  return number_format( $bytes / 1024, 2 ) . " KB";
  }
 elseif ( $bytes < 1000 * 1048576 ) {
  return number_format( $bytes / 1048576, 2 ) . " MB";
  }
 elseif ( $bytes < 1000 * 1073741824 ) {
  return number_format( $bytes / 1073741824, 2 ) . " GB";
  }
 else {
  return number_format( $bytes / 1099511627776, 2 ) . " TB";
  }
 }		


function seconds2times($seconds)
{
	$times = array();
	
	// считать нули в значениях
	$count_zero = false;
	
	// количество секунд в году не учитывает високосный год
	// поэтому функция считает что в году 365 дней
	// секунд в минуте|часе|сутках|году
	$periods = array(60, 3600, 86400, 31536000);
	
	for ($i = 3; $i >= 0; $i--)
	{
		$period = floor($seconds/$periods[$i]);
		if (($period > 0) || ($period == 0 && $count_zero))
		{
			$times[$i+1] = $period;
			$seconds -= $period * $periods[$i];
			
			$count_zero = true;
		}
	}
	
	$times[0] = $seconds;
	foreach($times as $k=>$v){
		$times[$k] = (strlen($times[$k]) == 1) ? '0'.$v : $v;
	}
	return $times;
}


	
	function GetNews($num=false){
		//return ($num) ? $this->db->query("SELECT * FROM news WHERE (langs=? OR langs=?) AND (user_groups=? OR user_groups=?) AND (users=? OR users=?) ORDER by id DESC LIMIT 0,?",array(intval($num))) : $this->db->query("SELECT * FROM news WHERE 1 ORDER by id DESC");
		if($num){
			$return = $this->db->query("SELECT * FROM news WHERE (langs=? OR langs LIKE ?) AND (user_groups=? OR user_groups LIKE ?) AND (users=? OR users LIKE ?) AND not_langs NOT LIKE ? AND user_groups NOT LIKE ? AND users NOT LIKE ? ORDER by id DESC LIMIT 0,?",array('','%|'.$_SESSION['language'].'|%','','%|'.$_SESSION['user_group'].'|%','','%|'.$_SESSION['id'].'|%',   '%|'.$_SESSION['language'].'|%','%|'.$_SESSION['user_group'].'|%','%|'.$_SESSION['id'].'|%',      intval($num)))->result_array();
		}else{
			$return = $this->db->query("SELECT * FROM news WHERE (langs=? OR langs LIKE ?) AND (user_groups=? OR user_groups LIKE ?) AND (users=? OR users LIKE ?) AND not_langs NOT LIKE ? AND user_groups NOT LIKE ? AND users NOT LIKE ? ORDER by id DESC",array('','%|'.$_SESSION['language'].'|%','','%|'.$_SESSION['user_group'].'|%','','%|'.$_SESSION['id'].'|%',   '%|'.$_SESSION['language'].'|%','%|'.$_SESSION['user_group'].'|%','%|'.$_SESSION['id'].'|%'))->result_array();
		}
		return $return;
	}
	
    function get_lang_list()
    {
        $this->load->helper('directory');
        $map = directory_map('./system/language', 2);
		unset($map[0]);
        foreach ($map as $k => $v) {
            foreach ($v as $k2 => $v2) {
                $maps[$k][$v2] = BASEPATH . 'language/' . $k . $v2;
            }
        }
        $map2 = directory_map('./application/language', 2);
		unset($map2[0]);
        foreach ($map2 as $k => $v) {
            foreach ($v as $k2 => $v2) {
                $maps2[$k][$v2] = APPPATH . 'language/' . $k . $v2;
            }
        }
        $MAP = array_merge($maps, $maps2);
        $this->load->helper('file');
        foreach ($MAP as $k => $v) {
            include 'application/language/' . $k . 'lang_lang.php';
            $MAPS[mb_substr($k, 0, -1)]['NAME'] = $lang['NAME'];
            $MAPS[mb_substr($k, 0, -1)]['CODE'] = $lang['CODE'];
            $MAPS[mb_substr($k, 0, -1)]['ICON'] = $lang['ICON'];
            $MAPS[mb_substr($k, 0, -1)]['GEO'] = ($lang['GEO']) ? $lang['GEO'] : false;
            $MAPS[mb_substr($k, 0, -1)]['SYMBOL'] = substr($k, 0, -1);
        }
        return $MAPS;
        //$this->load->helper('file');
        //include 'application/language/ru/root_lang.php';
        //include 'application/language/en/root_lang.php';
        //print_r($lang);
        //$ff = read_file('./application/language/ru/root_lang.php');
        //if($ff == false){
        //	echo 22222222;
        //}
        //print_r($ff);
    }
	
}