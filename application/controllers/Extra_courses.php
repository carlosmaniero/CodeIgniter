<?php class Extra_courses extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Extra_course_model', 'model');
	}

	/**
	 * List of extra_courses	 */

	public function index()
	{
		$data = array();
		$data['extra_courses'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['extra_courses']);
		}else{
			$this->template->load('template/default', 'extra_courses/index', $data);
		}

	}

	/**
	 * Trash list
	 */
	public function trash()
	{
		$data = array();
		$data['extra_courses'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['extra_courses']);
		}else{
			$this->template->load('template/default', 'extra_courses/trash', $data);
		}

	}

	/**
	 * Insert extra_course	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_extra_course = $this->input->post();

			//Config upload
			$path = UPLOAD_PATH . 'extra_courses/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					//redirect('extra_courses/show/');
				}else{
					$file = $this->upload->data();
					$input_extra_course['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_extra_course);

			// Result of insertion
			$result = $this->model->insert($input_extra_course);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Extra_course successfully inserted');
					redirect('extra_courses/show/' . $result . '.' . $this->uri->extension);
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
					redirect('extra_courses/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', 'extra_courses/insert', $data);
	}

	/**
	 * extra_course Editing
	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_extra_course = $this->input->post();


			//Config upload
			$path = UPLOAD_PATH . 'extra_courses/image/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			if(isset($_FILES['input-image']) && !empty($_FILES['input-image']['name'])){

				if ( !$this->upload->do_upload('input-image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('extra_courses/show/'.$id);
				}else{
					$file = $this->upload->data();
					$input_extra_course['image'] = $file['file_name'];
					if($file['image_width'] > 1024)
						$this->resize_image($file['file_name'], $path);
					$this->make_thumb($file['file_name'], $path);
				}
			}

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_extra_course);

			// Update result			
			$result = $this->model->update($id, $input_extra_course);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Extra_course edited successfully');
					redirect('extra_courses/show/' . $id . '.' . $this->uri->extension);
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
					redirect('extra_courses/insert/');
				}
			} 
		}
		$data = array();
		$data['extra_course'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['extra_course']);

		$this->template->load('template/default', 'extra_courses/edit', $data);
	}

	/**
	 * extra_course Show
	 */
	public function show($id)
	{
		$data = array();
		$data['extra_course'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['extra_course']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['extra_course']);
		}
		else
		{
			$this->template->load('template/default', 'extra_courses/show', $data);
		}
	}

	/**
	 * extra_course Delete
	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'extra_course deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete extra_course';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('extra_courses');
		}
	}

	/**
	 * Delete extra_course permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = 'extra_course deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete extra_course';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('extra_courses/trash');
		}
	}

	/**
	 * extra_course Recover
	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = 'extra_course recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover extra_course';
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
			redirect('extra_courses/trash');
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