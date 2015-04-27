<?php class Post_categories extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_category_model', 'model');
	}

	/**
	 * List of post_categories	 */

	public function index()
	{
		$data = array();
		$data['post_categories'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post_categories']);
		}else{
			$this->template->load('template/default', 'post_categories/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['post_categories'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post_categories']);
		}else{
			$this->template->load('template/default', 'post_categories/trash', $data);
		}

	}

	/**
	 * Insert post_category	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_post_category = $this->input->post();

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_post_category);

			// Result of insertion
			$result = $this->model->insert($input_post_category);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post_category successfully inserted');
					redirect('post_categories/show/' . $result . '.' . $this->uri->extension);
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
					redirect('post_categories/insert/');
				}
			}

			return;
		}

		// Render View
		$this->template->load('template/default', 'post_categories/insert', $data);
	}

	/**
	 * post_category Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_post_category = $this->input->post();

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_post_category);

			// Update result
			$result = $this->model->update($id, $input_post_category);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post_category edited successfully');
					redirect('post_categories/show/' . $id . '.' . $this->uri->extension);
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
					redirect('post_categories/insert/');
				}
			}
		}
		$data = array();
		$data['post_category'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['post_category']);

		$this->template->load('template/default', 'post_categories/edit', $data);
	}

	/**
	 * post_category Show
	 */
	public function show($id)
	{
		$data = array();
		$data['post_category'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['post_category']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post_category']);
		}
		else
		{
			$this->template->load('template/default', 'post_categories/show', $data);
		}
	}

	/**
	 * post_category Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post_category deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete post_category';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('post_categories');
		}
	}

	/**
	 * Delete post_category permanently
	 */
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post_category deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete post_category';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('post_categories/trash');
		}
	}

	/**
	 * post_category Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post_category recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover post_category';
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
			redirect('post_categories/trash');
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
