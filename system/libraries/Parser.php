<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Parser Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Parser
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/parser.html
 */
class CI_Parser {

	/**
	 * Left delimiter character for pseudo vars
	 *
	 * @var string
	 */
	public $l_delim = '{';

	/**
	 * Right delimiter character for pseudo vars
	 *
	 * @var string
	 */
	public $r_delim = '}';
	
	public $DATA = array();
	
	public $LANG = array(
		'calendar',
		'date',
		'db',
		'email',
		'form_validation',
		'ftp',
		'imglib',
		'migration',
		'number',
		'pagination',
		'profiler',
		'unit_test',
		'upload',
		'lang',
		'privilegies',
	);
	/**
	 * Reference to CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->lang->load($this->LANG);
		log_message('info', 'Parser Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a template
	 *
	 * Parses pseudo-variables contained in the specified template view,
	 * replacing them with the data in the second param
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	public function parse($template, $data, $return = FALSE)
	{
		$this->DATA = $data;
		$template = $this->CI->load->view($template, $data, TRUE);

		return $this->_parse($template, $data, $return);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a String
	 *
	 * Parses pseudo-variables contained in the specified string,
	 * replacing them with the data in the second param
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	public function parse_string($template, $data, $return = FALSE)
	{
		return $this->_parse($template, $data, $return);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a template
	 *
	 * Parses pseudo-variables contained in the specified template,
	 * replacing them with the data in the second param
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	protected function _parse($template, $data, $return = FALSE)
	{
		if ($template === '')
		{
			return FALSE;
		}

		$replace = array();
		foreach ($data as $key => $val)
		{
			$replace = array_merge(
				$replace,
				is_array($val)
					? $this->_parse_pair($key, $val, $template)
					: $this->_parse_single($key, (string) $val, $template)
			);
		}

		unset($data);
		$template = strtr($template, $replace);

		if ($return === FALSE)
		{
			$this->CI->output->append_output($this->_reparse($template));
		}

		return $this->_reparse($template);
	}
	
	protected function _reparse($template)
	{
		$router =& load_class('Router');
		$rootclass = $router->fetch_class();
		$rootmethod = $router->fetch_method();

		if (strpos ( $template, "{*" ) !== false) {
			$template = preg_replace("'\\{\\*(.*?)\\*\\}'si", '', $template);
		}
		
		if( strpos( $template, "{lang=") !== false ) {		
			$template = preg_replace_callback( "#\\{lang=(.+?)\\}#i", array( &$this, 'echo_lang'), $template );
		}
		
		if (strpos ( $template, "[group=" ) !== false OR strpos ( $template, "[not-group=" ) !== false ) {
			$template = $this->check_group($template);
		}

		if( strpos( $template, "{form-value=") !== false ) {		
			$template = preg_replace_callback( "#\\{form-value=(.+?)\\}#i", array( &$this, 'form_value'), $template );
		}

		if( strpos( $template, "{form-value-get=") !== false ) {		
			$template = preg_replace_callback( "#\\{form-value-get=(.+?)\\}#i", array( &$this, 'form_value_get'), $template );
		}
		if( strpos( $template, "[not-validation=" ) !== false ) {		
			$template = preg_replace_callback( "#\\[(not-validation)=(.+?)\\](.*?)\\[/not-validation\\]#is", array( &$this, 'notvalidation'), $template );
		}	
		if( strpos( $template, "[validation=" ) !== false ) {		
			$template = preg_replace_callback( "#\\[(validation)=(.+?)\\](.*?)\\[/validation\\]#is", array( &$this, 'validation'), $template );
		}
		if(count($_POST) <= 0){
			$template = preg_replace( "'\\[form_no\\](.*?)\\[/form_no\\]'is", "", $template );
			$template = preg_replace( "'\\[form_yes\\](.*?)\\[/form_yes\\]'is", "", $template );
		}
		if ( strpos( $template, "{csrf_name}" ) !== false ){
			$template = str_replace( "{csrf_name}", $this->CI->security->get_csrf_token_name(), $template );
		}
		if ( strpos( $template, "{csrf_value}" ) !== false ){
			$template = str_replace( "{csrf_value}", $this->CI->security->get_csrf_hash(), $template );
		}
		if ($_POST AND $this->CI->form_validation->run()){
			$template = preg_replace( "'\\[form_no\\](.*?)\\[/form_no\\]'is", "", $template );
			$template = str_ireplace( "[form_yes]", "", $template );
			$template = str_ireplace( "[/form_yes]", "", $template );
		}else{
			$template = preg_replace( "'\\[form_yes\\](.*?)\\[/form_yes\\]'is", "", $template );
			$template = str_ireplace( "[form_no]", "", $template );
			$template = str_ireplace( "[/form_no]", "", $template );
		}

		if( strpos( $template, "{include file=" ) !== false ) {		
			$template = preg_replace_callback( "#\\{include file=['\"](.+?)['\"]\\}#i", array( &$this, 'load_file'), $template );
		}	

		//Зависимость от $this->data['USER']
		if( strpos( $template, "[is_user]") !== false ) {		
			$template = preg_replace_callback( "'\\[is_user\\](.*?)\\[/is_user\\]'is", array( &$this, 'is_user'), $template );
		}	
		
		if( strpos( $template, "[no_user]") !== false ) {		
			$template = preg_replace_callback( "'\\[no_user\\](.*?)\\[/no_user\\]'is", array( &$this, 'no_user'), $template );
		}	
		
		if( strpos( $template, "[ban_user]") !== false ) {		
			$template = preg_replace_callback( "'\\[ban_user\\](.*?)\\[/ban_user\\]'is", array( &$this, 'ban_user'), $template );
		}	
		
		if( strpos( $template, "[is_profile]") !== false ) {		
			$template = preg_replace_callback( "'\\[is_profile\\](.*?)\\[/is_profile\\]'is", array( &$this, 'is_profile'), $template );
		}	
		
		if( strpos( $template, "[no_profile]") !== false ) {		
			$template = preg_replace_callback( "'\\[no_profile\\](.*?)\\[/no_profile\\]'is", array( &$this, 'no_profile'), $template );
		}	
		if( strpos( $template, "{date=") !== false ) {		
			$template = preg_replace_callback( "#\\{date=(.+?)\\}#i", array( &$this, 'echo_date'), $template );
		}			
		
		
		
		if( strpos( $template, "[decline=") !== false ) {		
			$template = preg_replace_callback( "#\\[decline=(.+?)\\]#i", array( &$this, 'decline'), $template );
		}		
		if( strpos( $template, "[declines=") !== false ) {		
			$template = preg_replace_callback( "#\\[declines=(.+?)\\]#i", array( &$this, 'declines'), $template );
		}			
		if( strpos( $template, "{validation=" ) !== false ) {		
			$template = preg_replace_callback( "#\\{validation=(.+?)\\}#i", array( &$this, 'form_errors'), $template );
		}	

		if( strpos( $template, "{form-checkbox-value=") !== false ) {		
			//$template = preg_replace_callback( "#\\{form-checkbox-value=(.+?)\\}#i", array( &$this, 'form_checkbox_value'), $template );
		}	
		
		
	

		if( strpos( $template, "[profile:") !== false ) {		
			$template = preg_replace_callback( "#\\[profile:(.+?)\\]#i", array( &$this, 'userdatas'), $template );
		}
		if( strpos( $template, "[config:") !== false ) {		
			$template = preg_replace_callback( "#\\[config:(.+?)\\]#i", array( &$this, 'config'), $template );
		}

		
		foreach($this->CI->system->GetPRS() as $k=>$v){//access
			if( strpos( $template, "[YES ".$v."]" ) !== false OR strpos( $template, "[NO ".$v."]" ) !== false) {		
				if ($this->CI->system->access($v)){
					$template = preg_replace( "'\\[NOT ".$v."\\](.*?)\\[/NOT ".$v."\\]'is", "", $template );
					$template = str_ireplace( "[YES ".$v."]", "", $template );
					$template = str_ireplace( "[/YES ".$v."]", "", $template );
				}else{
					$template = preg_replace( "'\\[YES ".$v."\\](.*?)\\[/YES ".$v."\\]'is", "", $template );
					$template = str_ireplace( "[NO ".$v."]", "", $template );
					$template = str_ireplace( "[/NO ".$v."]", "", $template );
				}
			}	
		}
		
        if (strpos ( $template, "[if " ) !== false) {  
			$template = preg_replace_callback ( "#\\[if (.+?)\\](.*?)\\[/if\\]#is", array( &$this, "check_else"), $template ); 
        }		

		
		return $template;
	}
    function check_else($condition) 
    { 
	$block = $condition[2];
	$condition = $condition[1];
        global $GLOBALS; 
        extract($GLOBALS, EXTR_SKIP, ""); 
        if(is_array($matches=explode("[else]",$block))) { 
		$matches[1] = (count($matches) == 1)? "" : $matches[1];
            $block=$matches[0]; 
            $else=$matches[1]; 
        } 
        if(eval(("return $condition;"))) return str_replace( '\"', '"', $block ); 
        return str_replace( '\"', '"', $else ); 
    }
	
	protected function echo_date($matches=array()){
		if(stristr($matches[1],'=') === FALSE){
			return date($matches[1]);
		}else{
			$str = explode('=',$matches[1]);
            if($str[0] == '$'){
                return intval(date('n',intval($str[1]))) - 1;
            }else{
                return date($str[0],intval($str[1]));
            }
		}
		
	}
	
	protected function userdatas($matches=array())
	{
		return $_SESSION[$matches[1]];
	}
	
	protected function config($matches=array())
	{
		return $this->CI->CONFIG->get($matches[1]);
	}

	protected function load_file($matches=array())
	{
		//print_r($matches);
		return $this->CI->parser->parse($matches[1], $this->CI->data, TRUE);
	}
	
	protected function plural_form($number, $after) {
		$number = intval($number);
	  $cases = array (2, 0, 1, 1, 1, 2);
	  return $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
	}
	
	protected function is_user($matches=array()){
		return ($this->CI->db->query("SELECT COUNT(*) as count FROM users WHERE id=? AND active=? AND ban=?",array(intval($this->CI->data['USER'][0]['id']),1,0))->row_array()['count'] > 0) ? $matches[1] : '';
	}
	protected function no_user($matches=array()){
		return ($this->CI->db->query("SELECT COUNT(*) as count FROM users WHERE id=?",array(intval($this->CI->data['USER'][0]['id'])))->row_array()['count'] == 0) ? $matches[1] : '';
	}
	protected function ban_user($matches=array()){
		return ($this->CI->db->query("SELECT COUNT(*) as count FROM users WHERE id=? AND ban=?",array(intval($this->CI->data['USER'][0]['id']),1))->row_array()['count'] > 0) ? $matches[1] : '';
	}
	protected function is_profile($matches=array()){
		return ($this->CI->data['USER'][0]['id'] == $_SESSION['id']) ? $matches[1] : '';
	}
	protected function no_profile($matches=array()){
		return ($this->CI->data['USER'][0]['id'] != $_SESSION['id']) ? $matches[1] : '';
	}

	protected function decline($matches=array()){
		$array = explode('|',$matches[1]);
		$num = $array[0];
		if(count($array) != 4){
			return false;
		}
		array_shift($array);
		return $this->plural_form(intval($num),$array);
	}	
	
	protected function plural_form2($number, $after) {
		$number = intval($number);
	  $cases = array (2, 0, 1, 1, 1, 2);
	  return $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
	}
	

	protected function declines($matches=array()){
		$array = explode('|',$matches[1]);
		$num = $array[0];
		if(count($array) != 4){
			return false;
		}
		array_shift($array);
		return $this->plural_form2(intval($num),$array);
	}		
	protected function form_checkbox_value($matches=array())
	{
		$this->CI->load->helper('form');
		return set_checkbox($matches[1],1);
	}
	
	protected function notvalidation($matches)
	{	
		$this->CI->load->helper('form');
		$this->CI->lang->load($this->LANG);
		if(form_error($matches[2])){
			return $matches[3];
		}else{
			return '';
		}

	}	

	protected function form_errors($matches)
	{
		$this->CI->load->helper('form');
		$this->CI->lang->load($this->LANG);
		return form_error($matches[1]);
	}

	protected function validation($matches)
	{	
		$this->CI->load->helper('form');
		$this->CI->lang->load($this->LANG);
		if(form_error($matches[2])){
			return '';
		}else{
			return $matches[3];
		}

	}
	protected function form_value($matches=array())
	{
		$ts = explode('|',$matches[1]);
		$this->CI->load->helper('form');
		$s = set_value($matches[1]);
		if(!$s AND isset($ts[1])){
			return $ts[1];
		}else{
			return $s;
		}
	}
	protected function form_value_get($matches=array())
	{
		$ts = explode('|',$matches[1]);
		$this->CI->load->helper('form');
		$s = set_value_get($matches[1]);
		if(!$s AND isset($ts[1])){
			return $ts[1];
		}else{
			return $s;
		}
	}
	
	function check_group( $matches ) {
		$user_group = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;

		$regex = '/\[(group|not-group)=(.*?)\]((?>(?R)|.)*?)\[\/\1\]/is';

		if (is_array($matches)) {

			$groups = $matches[2];
			$block = $matches[3];
	
			if ($matches[1] == "group") $action = true; else $action = false;
			
			$groups = explode( ',', $groups );
			
			if( $action ) {
				
				if( ! in_array( $user_group, $groups ) ) $matches = ''; else $matches = $block;
			
			} else {
				
				if( in_array( $user_group, $groups ) ) $matches = ''; else $matches = $block;
			
			}
		}
		
		return preg_replace_callback($regex, array( &$this, 'check_group'), $matches);
	
	}	
	
	protected function echo_lang($matches=array())
	{
		$CI =& get_instance();  
		$CI->lang->load($this->LANG);
		//echo get_instance()->lang->line('CODE');
		return($CI->lang->line($matches[1]));
	}

	// --------------------------------------------------------------------

	/**
	 * Set the left/right variable delimiters
	 *
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	public function set_delimiters($l = '{', $r = '}')
	{
		$this->l_delim = $l;
		$this->r_delim = $r;
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a single key/value
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	protected function _parse_single($key, $val, $string)
	{
		return array($this->l_delim.$key.$this->r_delim => (string) $val);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a tag pair
	 *
	 * Parses tag pairs: {some_tag} string... {/some_tag}
	 *
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	protected function _parse_pair($variable, $data, $string)
	{
		$replace = array();
		preg_match_all(
			'#'.preg_quote($this->l_delim.$variable.$this->r_delim).'(.+?)'.preg_quote($this->l_delim.'/'.$variable.$this->r_delim).'#s',
			$string,
			$matches,
			PREG_SET_ORDER
		);

		foreach ($matches as $match)
		{
			$str = '';
			foreach ($data as $row)
			{
				$temp = array();
				foreach ($row as $key => $val)
				{
					if (is_array($val))
					{
						$pair = $this->_parse_pair($key, $val, $match[1]);
						if ( ! empty($pair))
						{
							$temp = array_merge($temp, $pair);
						}

						continue;
					}

					$temp[$this->l_delim.$key.$this->r_delim] = $val;
				}

				$str .= strtr($match[1], $temp);
			}

			$replace[$match[0]] = $str;
		}

		return $replace;
	}

}
