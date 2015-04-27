<?php class Secretariats extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Secretariat_model', 'model');
	}

	/**
	 * List of secretariats	 */

	public function index()
	{
		$data = array();
		$data['secretariats'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['secretariats']);
		}else{
			$this->template->load('template/default', 'secretariats/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['secretariats'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['secretariats']);
		}else{
			$this->template->load('template/default', 'secretariats/trash', $data);
		}

	}

	/**
	 * Insert secretariat	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_secretariat = $this->input->post();


			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_secretariat);

			// Result of insertion
			$result = $this->model->insert($input_secretariat);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Secretariat successfully inserted');
					redirect('secretariats/show/' . $result . '.' . $this->uri->extension);
				}
			}
			else
			{
				$msg = 'Error on save register';
				// JSON error response
				if($this->uri->extension == 'json')
				{
					$this->response_json(array('error'=> $msg), 500);
				}
				else
				{
					$this->session->set_flashdata('error', $msg);
					redirect('secretariats/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'secretariats/insert', $data);
	}

	/**
	 * secretariat Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_secretariat = $this->input->post();



			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_secretariat);

			// Update result			
			$result = $this->model->update($id, $input_secretariat);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Secretariat edited successfully');
					redirect('secretariats/show/' . $id . '.' . $this->uri->extension);
				}
			}
			else
			{
				$msg = 'Error on update register';
				// Respostas em caso de erro
				if($this->uri->extension == 'json')
				{
					$this->response_json(array('error'=> $msg), 500);
				}
				else
				{
					$this->session->set_flashdata('error', $msg);
					redirect('secretariats/insert/');
				}
			} 
		}
		$data = array();
		$data['secretariat'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['secretariat']);

		$this->template->load('template/default', 'secretariats/edit', $data);
	}

	/**
	 * secretariat Show
	 */
	public function show($id)
	{
		$data = array();
		$data['secretariat'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['secretariat']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['secretariat']);
		}
		else
		{
			$this->template->load('template/default', 'secretariats/show', $data);
		}
	}

	/**
	 * secretariat Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'secretariat deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete secretariat';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('secretariats');
		}
	}

	/**
	 * Delete secretariat permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'secretariat deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete secretariat';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('secretariats/trash');
		}
	}

	/**
	 * secretariat Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'secretariat recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover secretariat';
		}

		if($this->uri->extension == 'json')
		{
			if($data['type'] == 'success')
			{
				$this->show($id);
			}
			else
			{
				$this->response_json(array($data['type'] => $data['msg']));
			}
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('secretariats/trash');
		}
	}

	/**
	 * Configures entries that are saved in database
	 */
	private function _config_entry_to_database(&$data)
	{
		//$data['date'] = format_datetime($data['visible_in'], '-');
	}

	/**
	 * Configures entries for views 
	 */
	private function _config_entry_to_humans(&$data)
	{
		//$data->date = format_datetime($data->visible_in);
	}

}