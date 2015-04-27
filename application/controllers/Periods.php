<?php class Periods extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Period_model', 'model');
	}

	/**
	 * List of periods	 */

	public function index()
	{
		$data = array();
		$data['periods'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['periods']);
		}else{
			$this->template->load('template/default', 'periods/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['periods'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['periods']);
		}else{
			$this->template->load('template/default', 'periods/trash', $data);
		}

	}

	/**
	 * Insert period	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_period = $this->input->post();

			//Config upload
			$path = UPLOAD_PATH . 'periods/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					//redirect('periods/show/');
				}else{
					$file = $this->upload->data();
					$input_period['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_period);

			// Result of insertion
			$result = $this->model->insert($input_period);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Period successfully inserted');
					redirect('periods/show/' . $result . '.' . $this->uri->extension);
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
					redirect('periods/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'periods/insert', $data);
	}

	/**
	 * period Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_period = $this->input->post();


			//Config upload
			$path = UPLOAD_PATH . 'periods/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('periods/show/'.$id);
				}else{
					$file = $this->upload->data();
					$input_period['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_period);

			// Update result			
			$result = $this->model->update($id, $input_period);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Period edited successfully');
					redirect('periods/show/' . $id . '.' . $this->uri->extension);
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
					redirect('periods/insert/');
				}
			} 
		}
		$data = array();
		$data['period'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['period']);

		$this->template->load('template/default', 'periods/edit', $data);
	}

	/**
	 * period Show
	 */
	public function show($id)
	{
		$data = array();
		$data['period'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['period']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['period']);
		}
		else
		{
			$this->template->load('template/default', 'periods/show', $data);
		}
	}

	/**
	 * period Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'period deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete period';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('periods');
		}
	}

	/**
	 * Delete period permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'period deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete period';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('periods/trash');
		}
	}

	/**
	 * period Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'period recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover period';
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
			redirect('periods/trash');
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