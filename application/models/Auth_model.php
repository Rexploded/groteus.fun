<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	private $table = "users";
	private $_data = array();

	public function validate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->db->where("username", $username);
		$query = $this->db->get($this->table);

		if ($query->num_rows()) 
		{
			// found row by username	
			$row = $query->row_array();

			// now check for the password
			if ($row['password'] == crypt($password, '$6$rounds=20000$') AND $row['ban'] == 0 AND $row['active'] == 1) 
			{
				// we not need password to store in session
				unset($row['password']);
				$this->_data = $row;
				return ERR_NONE;
			}else if($row['ban'] == 1){
				return ERR_YOU_BANNED;
			}else if($row['active'] == 0){
				return ERR_YOU_NOT_ACTIVE;print_r($_SERVER);
			}

			// password not match
			return ERR_INVALID_PASSWORD;
		}
		else {
			// not found
			return ERR_INVALID_USERNAME;
		}
	}

	public function get_data()
	{
		return $this->_data;
	}

}