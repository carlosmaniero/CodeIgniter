<?php class Post_image_galleries extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_image_gallery_model', 'model');
	}

	/**
	 * List of post_image_galleries	 */

	public function index()
	{
		$data = array();
		$data['post_image_galleries'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post_image_galleries']);
		}else{
			$this->template->load('template/default', 'post_image_galleries/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['post_image_galleries'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post_image_galleries']);
		}else{
			$this->template->load('template/default', 'post_image_galleries/trash', $data);
		}

	}

	/**
	 * Insert post_image_gallery	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_post_image_gallery = $this->input->post();

			//Config upload
			$path = UPLOAD_PATH . 'post_image_galleries/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					//redirect('post_image_galleries/show/');
				}else{
					$file = $this->upload->data();
					$input_post_image_gallery['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_post_image_gallery);

			// Result of insertion
			$result = $this->model->insert($input_post_image_gallery);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post_image_gallery successfully inserted');
					redirect('post_image_galleries/show/' . $result . '.' . $this->uri->extension);
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
					redirect('post_image_galleries/insert/');
				}
			}

			return;
		}

		// Render View
		$this->template->load('template/default', 'post_image_galleries/insert', $data);
	}

	/**
	 * post_image_gallery Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_post_image_gallery = $this->input->post();


			//Config upload
			$path = UPLOAD_PATH . 'post_image_galleries/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('post_image_galleries/show/'.$id);
				}else{
					$file = $this->upload->data();
					$input_post_image_gallery['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_post_image_gallery);

			// Update result
			$result = $this->model->update($id, $input_post_image_gallery);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post_image_gallery edited successfully');
					redirect('post_image_galleries/show/' . $id . '.' . $this->uri->extension);
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
					redirect('post_image_galleries/insert/');
				}
			}
		}
		$data = array();
		$data['post_image_gallery'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['post_image_gallery']);

		$this->template->load('template/default', 'post_image_galleries/edit', $data);
	}

	/**
	 * post_image_gallery Show
	 */
	public function show($id)
	{
		$data = array();
		$data['post_image_gallery'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['post_image_gallery']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['post_image_gallery']);
		}
		else
		{
			$this->template->load('template/default', 'post_image_galleries/show', $data);
		}
	}

	/**
	 * post_image_gallery Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post_image_gallery deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete post_image_gallery';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('post_image_galleries');
		}
	}

	/**
	 * Delete post_image_gallery permanently
	 */
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post_image_gallery deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete post_image_gallery';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('post_image_galleries/trash');
		}
	}

	/**
	 * post_image_gallery Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'post_image_gallery recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover post_image_gallery';
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
			redirect('post_image_galleries/trash');
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
