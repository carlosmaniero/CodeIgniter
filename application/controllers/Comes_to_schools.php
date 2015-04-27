<?php class Comes_to_schools extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Comes_to_school_model', 'model');
	}

	/**
	 * List of comes_to_schools	 */

	public function index()
	{
		$data = array();
		$data['comes_to_schools'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['comes_to_schools']);
		}else{
			$this->template->load('template/default', 'comes_to_schools/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['comes_to_schools'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['comes_to_schools']);
		}else{
			$this->template->load('template/default', 'comes_to_schools/trash', $data);
		}

	}

	/**
	 * Insert comes_to_school	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_comes_to_school = $this->input->post();


			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_comes_to_school);

			// Result of insertion
			$result = $this->model->insert($input_comes_to_school);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Comes_to_school successfully inserted');
					redirect('comes_to_schools/show/' . $result . '.' . $this->uri->extension);
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
					redirect('comes_to_schools/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'comes_to_schools/insert', $data);
	}

	/**
	 * comes_to_school Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_comes_to_school = $this->input->post();



			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_comes_to_school);

			// Update result			
			$result = $this->model->update($id, $input_comes_to_school);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Comes_to_school edited successfully');
					redirect('comes_to_schools/show/' . $id . '.' . $this->uri->extension);
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
					redirect('comes_to_schools/insert/');
				}
			} 
		}
		$data = array();
		$data['comes_to_school'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['comes_to_school']);

		$this->template->load('template/default', 'comes_to_schools/edit', $data);
	}

	/**
	 * comes_to_school Show
	 */
	public function show($id)
	{
		$data = array();
		$data['comes_to_school'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['comes_to_school']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['comes_to_school']);
		}
		else
		{
			$this->template->load('template/default', 'comes_to_schools/show', $data);
		}
	}

	/**
	 * comes_to_school Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'comes_to_school deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete comes_to_school';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('comes_to_schools');
		}
	}

	/**
	 * Delete comes_to_school permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'comes_to_school deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete comes_to_school';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('comes_to_schools/trash');
		}
	}

	/**
	 * comes_to_school Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'comes_to_school recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover comes_to_school';
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
			redirect('comes_to_schools/trash');
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