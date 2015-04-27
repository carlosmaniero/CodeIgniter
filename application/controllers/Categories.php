<?php class Categories extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model', 'model');
	}

	/**
	 * List of categories	 */

	public function index()
	{
		$data = array();
		$data['categories'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['categories']);
		}else{
			$this->template->load('template/default', 'categories/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['categories'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['categories']);
		}else{
			$this->template->load('template/default', 'categories/trash', $data);
		}

	}

	/**
	 * Insert category	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_category = $this->input->post();


			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_category);

			// Result of insertion
			$result = $this->model->insert($input_category);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Category successfully inserted');
					redirect('categories/show/' . $result . '.' . $this->uri->extension);
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
					redirect('categories/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'categories/insert', $data);
	}

	/**
	 * category Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_category = $this->input->post();



			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_category);

			// Update result			
			$result = $this->model->update($id, $input_category);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Category edited successfully');
					redirect('categories/show/' . $id . '.' . $this->uri->extension);
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
					redirect('categories/insert/');
				}
			} 
		}
		$data = array();
		$data['category'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['category']);

		$this->template->load('template/default', 'categories/edit', $data);
	}

	/**
	 * category Show
	 */
	public function show($id)
	{
		$data = array();
		$data['category'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['category']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['category']);
		}
		else
		{
			$this->template->load('template/default', 'categories/show', $data);
		}
	}

	/**
	 * category Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'category deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete category';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('categories');
		}
	}

	/**
	 * Delete category permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'category deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete category';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('categories/trash');
		}
	}

	/**
	 * category Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'category recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover category';
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
			redirect('categories/trash');
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