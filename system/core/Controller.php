<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, British Columbia Institute of Technology
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
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;
	private $auth_config;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();

		// Load Auth Library if is enable
		$this->config->load('auth');
		if($this->config->item('login_enable'))
		{
			$this->_check_login_on_controller();
		}

		log_message('debug', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Check login
	 *
	 */
	private function _check_login_on_controller()
	{
	
		$check_login = FALSE;

		if(isset($this->require_auth))
		{
			if($this->require_auth === TRUE){
				// Need login in all methods
				$check_login = TRUE;
			}
			elseif(is_array($this->require_auth)) 
			{
				if(in_array($this->router->fetch_method(), $this->require_auth))
				{
					// Need login in especific methods
					$check_login = TRUE;
				}
			}
			elseif($this->router->fetch_method() === $this->require_auth)
			{
				// Need login in especific method
				$check_login = TRUE;
			}

		}

		if($check_login)
		{
			// Check Login
			if(!$this->auth->check_login())
			{
				// Set the Redirect on Auth
				$this->session->set_userdata('auth_redirect', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '.' . $this->uri->extension);

				if($this->uri->extension === 'json')
				{
					show_error('You must be logged in', 403);
				}
				else
				{
					// Message error
					$this->session->set_flashdata('auth_error', 'You must be logged in');
					// Redirect to login form
					redirect($this->config->item('login_controller') . '/' . $this->config->item('login_method') . '.' . $this->uri->extension);
				}
			}
			// Check permission
			elseif(isset($this->permission_auth))
			{
				if(!$this->auth->check_permission($this->permission_auth))
				{
					if($this->uri->extension === 'json')
					{
						show_error('You don`t have permission to do it', 403);
					}
					else
					{
						// Message error
						$this->session->set_flashdata('auth_error', 'You don`t have permission to do it');
						// Redirect to login form
						redirect($this->config->item('login_controller') . '/' . $this->config->item('login_method') . '.' . $this->uri->extension);
					}
				}
			}
		}

	}

	function response_json($data, $status_code = 200)
	{
		set_status_header($status_code);
		header('Content-type: application/json');

		echo json_encode($data);
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
