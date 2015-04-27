<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

    protected $require_auth = FALSE;

	public function index()
	{
		// Hide Navbar
		$data = new stdClass();

		$data->noNav = TRUE;
		$this->template->load('template/default', 'login/login', $data);
	}

	public function do_login()
	{
		$login = $this->auth->do_login($this->input->post('username'), $this->input->post('password'));
		if(!$login)
		{
			redirect("/login/");
		}
	}

	public function logout()
	{
		$this->auth->logout();
		redirect('/');
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
