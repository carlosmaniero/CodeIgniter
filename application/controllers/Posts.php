<?php class Posts extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model', 'model');
	}

	/**
	 * List of posts	 */

	public function index()
	{
		$data = array();
		$data['posts'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['posts']);
		}else{
			$this->template->load('template/default', 'posts/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['posts'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['posts']);
		}else{
			$this->template->load('template/default', 'posts/trash', $data);
		}

	}

	/**
	 * Insert post	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_post = $this->input->post();

			//Config upload
			$path = UPLOAD_PATH . 'posts/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					//redirect('posts/show/');
				}else{
					$file = $this->upload->data();
					$input_post['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_post);

			// Result of insertion
			$result = $this->model->insert($input_post);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post successfully inserted');
					redirect('posts/show/' . $result . '.' . $this->uri->extension);
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
					redirect('posts/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'posts/insert', $data);
	}

	/**
	 * post Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_post = $this->input->post();


			//Config upload
			$path = UPLOAD_PATH . 'posts/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('posts/show/'.$id);
				}else{
					$file = $this->upload->data();
					$input_post['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_post);

			// Update result			
			$result = $this->model->update($id, $input_post);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post edited successfully');
					redirect('posts/show/' . $id . '.' . $this->uri->extension);
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
					redirect('posts/insert/');
				}
			} 
		}
		$data = array();
		$data['post'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['post']);

		$this->template->load('template/default', 'posts/edit', $data);
	}

	/**
	 * post Show
	 */
	public function show($id)
	{
		$data = array();
		$data['post'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['post']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post']);
		}
		else
		{
			$this->template->load('template/default', 'posts/show', $data);
		}
	}

	/**
	 * post Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete post';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('posts');
		}
	}

	/**
	 * Delete post permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete post';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('posts/trash');
		}
	}

	/**
	 * post Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover post';
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
			redirect('posts/trash');
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