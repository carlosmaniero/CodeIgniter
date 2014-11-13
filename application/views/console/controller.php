class <?= ucfirst(plural($name)) ?> extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('<?= ucfirst($name) ?>_model', 'model');
	}

	/**
	 * List of <?= plural($name) ?>

	 */

	public function index()
	{
		$data = array();
		$data['<?= plural($name) ?>'] = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['<?= plural($name) ?>']);
		}else{
			$this->template->load('template/default', '<?= plural($name) ?>/index', $data);
		}

	}

	/**
	 * Trash list

	 */
	public function trash()
	{
		$data = array();
		$data['<?= plural($name) ?>'] = $this->model->get_deleted();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['<?= plural($name) ?>']);
		}else{
			$this->template->load('template/default', '<?= plural($name) ?>/trash', $data);
		}

	}

	/**
	 * Insert <?= $name ?>

	 */
	public function insert()
	{
		$data = array();

		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_<?= $name ?> = $this->input->post();

			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_<?= $name ?>);

			// Result of insertion
			$result = $this->model->insert($input_<?= $name ?>);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', '<?= ucfirst($name) ?> successfully inserted');
					redirect('<?= plural($name) ?>/show/' . $result . '.' . $this->uri->extension);
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
					redirect('<?= plural($name) ?>/insert/');
				}
			} 

			return;
		}

		// Render View
		$this->template->load('template/default', '<?= plural($name) ?>/insert', $data);
	}

	/**
	 * <?= $name ?> Editing

	 */
	public function edit($id)
	{
		// If the request is of type POST

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_<?= $name ?> = $this->input->post();
			// Configures the entries that are saved in the database
			$this->_config_entry_to_database($input_<?= $name ?>);

			// Update result			
			$result = $this->model->update($id, $input_<?= $name ?>);

			if($result)
			{
				// JSON success response
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', '<?= ucfirst($name) ?> edited successfully');
					redirect('<?= plural($name) ?>/show/' . $id . '.' . $this->uri->extension);
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
					redirect('<?= plural($name) ?>/insert/');
				}
			} 
		}
		$data = array();
		$data['<?= $name ?>'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['<?= $name ?>']);

		$this->template->load('template/default', '<?= plural($name) ?>/edit', $data);
	}

	/**
	 * <?= $name ?> Show

	 */
	public function show($id)
	{
		$data = array();
		$data['<?= $name ?>'] = $this->model->get($id);

		$this->_config_entry_to_humans($data['<?= $name ?>']);

		if($this->uri->extension == 'json')
		{
			$this->response_json($data['<?= $name ?>']);
		}
		else
		{
			$this->template->load('template/default', '<?= plural($name) ?>/show', $data);
		}
	}

	/**
	 * <?= $name ?> Delete

	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = '<?= $name ?> deleted successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete <?= $name ?>';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('<?= plural($name) ?>');
		}
	}

	/**
	 * Delete <?= $name ?> permanently
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = '<?= $name ?> deleted permanently';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on delete <?= $name ?>';
		}

		if($this->uri->extension == 'json')
		{
			$this->response_json(array($data['type'] => $data['msg']));
		}
		else
		{
			$this->session->set_flashdata($data['type'], $data['msg']);
			redirect('<?= plural($name) ?>/trash');
		}
	}

	/**
	 * <?= $name ?> Recover

	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = '<?= $name ?> recovered successfully';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Error on recover <?= $name ?>';
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
			redirect('<?= plural($name) ?>/trash');
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