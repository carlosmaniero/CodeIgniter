<?php class Banners extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Banner_model', 'model');
	}

	/**
	 * List of banners	 */

	public function index()
	{
		$data = array();
		$data['banners'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['banners']);
		}else{
			$this->template->load('template/default', 'banners/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['banners'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['banners']);
		}else{
			$this->template->load('template/default', 'banners/trash', $data);
		}

	}

	/**
	 * Insert banner	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_banner = $this->input->post();

			//Config upload
			$path = UPLOAD_PATH . 'banners/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-images']) && !empty($_FILES['input-images']['name'])){

				if ( !$this->upload->do_upload('input-images')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					//redirect('banners/show/');
				}else{
					$file = $this->upload->data();
					$input_banner['images'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_banner);

			// Result of insertion
			$result = $this->model->insert($input_banner);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Banner successfully inserted');
					redirect('banners/show/' . $result . '.' . $this->uri->extension);
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
					redirect('banners/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'banners/insert', $data);
	}

	/**
	 * banner Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_banner = $this->input->post();


			//Config upload
			$path = UPLOAD_PATH . 'banners/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-images']) && !empty($_FILES['input-images']['name'])){

				if ( !$this->upload->do_upload('input-images')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('banners/show/'.$id);
				}else{
					$file = $this->upload->data();
					$input_banner['images'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_banner);

			// Update result			
			$result = $this->model->update($id, $input_banner);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Banner edited successfully');
					redirect('banners/show/' . $id . '.' . $this->uri->extension);
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
					redirect('banners/insert/');
				}
			} 
		}
		$data = array();
		$data['banner'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['banner']);

		$this->template->load('template/default', 'banners/edit', $data);
	}

	/**
	 * banner Show
	 */
	public function show($id)
	{
		$data = array();
		$data['banner'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['banner']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['banner']);
		}
		else
		{
			$this->template->load('template/default', 'banners/show', $data);
		}
	}

	/**
	 * banner Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'banner deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete banner';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('banners');
		}
	}

	/**
	 * Delete banner permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'banner deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete banner';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('banners/trash');
		}
	}

	/**
	 * banner Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'banner recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover banner';
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
			redirect('banners/trash');
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