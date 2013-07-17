<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Auth
{
  protected $CI;
  protected $db;
  private $table = 'ci_users';

	public function __construct()
	{
    $this->CI =& get_instance();
    $this->CI->config->load('auth');

    $this->CI->load->driver('session');
    $this->CI->load->library('session');
    $this->db =& $this->CI->db;
	}

	/**
	 * Check if user are logged
	 */
	public function check_login()
	{
		if($this->CI->session->userdata($this->table . '_id'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Do Logout
	 */
	public function logout(){
		$this->CI->session->unset_userdata($this->table . '_id');
	}

	/**
	 * Check if user have permission
	 */
	public function check_permission($permission, $user_id = NULL)
	{

		if($user_id == NULL) $user_id = $this->CI->session->userdata($this->table . '_id');

		$query = $this->db
									->join('ci_permissions', 'ci_permissions.id = ci_user_permissions.permission_id')
									->get_where('ci_user_permissions',array('user_id' => $user_id));
		$result = $query->result();

		if(is_array($permission))
		{
			foreach ($result as $row) {
				if(in_array($row->name, $permission)) return true;
			}
		}
		else
		{
			foreach ($result as $row) {
				if($row->name == $permission) return true;
			}	
		}

		return false;
	}

	/**
	 * Do Login
	 */
	public function do_login($username, $password, $redirect = TRUE)
	{
		$query = $this->db->get_where($this->table, array('username' => $username));
		$result = $query->result();
		$user = $result[0];
		

		if($user->password === sha1($user->salt . $password))
		{
			$this->CI->session->set_userdata(array($this->table . '_id' => $user->id));

			if($redirect)
			{
				redirect($this->CI->session->userdata('auth_redirect'));
			}
			return TRUE;
		}

		return FALSE;
	}

	public function set_table($value)
	{
		$this->table = $value;
	}

}

/* End of file Auth.php */
/* Location: .//Users/carlos10/Sites/codeigniter/system/libraries/Auth.php */
