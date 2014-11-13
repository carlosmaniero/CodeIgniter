<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if($this->uri->extension == 'json')
		{
			echo '{message:"Você deve estar logado"}';
		}else{
			echo form_open('login/do_login');

				echo form_label('Usuário:', 'username');
				echo form_input('username','','id="username"');

				echo form_label('Senha:', 'password');
				echo form_password('password','', 'id="password"');

				echo form_submit('button', 'Entrar');

			echo form_close();
		}
	}

	public function do_login()
	{
		$login = $this->auth->do_login($this->input->post('username'), $this->input->post('password'));
		var_dump($login);
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */