class <?= ucfirst(plural($name)) ?> extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('<?= ucfirst($name) ?>_model', 'model');
	}

	/**
	 * Lista de <?= plural($name) ?>

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
	 * Lista de <?= plural($name) ?>

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
	 * Inserre um <?= $name ?>

	 */
	public function insert()
	{
		$data = array();

		// Caso a requisição seja do tipo <?= $name ?>

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_<?= $name ?> = $this->input->post();

			// Configua as entradas que serão salvas no banco de dados
			$this->_config_entry_to_database($input_<?= $name ?>);

			// Resultado da inserção
			$result = $this->model->insert($input_<?= $name ?>);

			if($result)
			{
				// Respostas em caso de Sucesso
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', '<?= ucfirst($name) ?> inserido com sucesso');
					redirect('<?= plural($name) ?>/show/' . $result . '.' . $this->uri->extension);
				}
			}
			else
			{
				$msg = 'Erro ao salvar registro';
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

			return;
		}

		// Renderiza View
		$this->template->load('template/default', '<?= plural($name) ?>/insert', $data);
	}

	/**
	 * Edita um <?= $name ?>

	 */
	public function edit($id)
	{
		// Caso a requisição seja do tipo <?= $name ?>

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$input_<?= $name ?> = $this->input->post();
			// Configua as entradas que serão salvas no banco de dados
			$this->_config_entry_to_database($input_<?= $name ?>);

			// Resultado da atualização			
			$result = $this->model->update($id, $input_<?= $name ?>);

			if($result)
			{
				// Respostas em caso de Sucesso
				if($this->uri->extension == 'json')
				{
					$this->show($id);
				}
				else
				{
					$this->session->set_flashdata('success', '<?= ucfirst($name) ?> editado com sucesso');
					redirect('<?= plural($name) ?>/show/' . $id . '.' . $this->uri->extension);
				}
			}
			else
			{
				$msg = 'Erro ao salvar registro';
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
	 * Exibe um <?= $name ?>

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
	 * Exclui um <?= $name ?>

	 */
	public function delete($id)
	{
		$data = array();

		if($this->model->delete($id))
		{
			$data['type'] = 'success';
			$data['msg'] = '<?= $name ?> deletado com sucesso';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Erro ao deletar <?= $name ?>';
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
	 * Remove <?= $name ?> definitivamente
	 */ 
	public function delete_permanently($id)
	{
		$data = array();

		if($this->model->delete($id, TRUE))
		{
			$data['type'] = 'success';
			$data['msg'] = '<?= $name ?> deletado definitivamente';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Erro ao deletar <?= $name ?>';
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
	 * Recuperar um <?= $name ?>

	 */
	public function recover($id)
	{
		$data = array();

		if($this->model->recover($id))
		{
			$data['type'] = 'success';
			$data['msg'] = '<?= $name ?> recuperado com sucesso';
		}
		else
		{
			$data['type'] = 'error';
			$data['msg'] = 'Erro ao recuperar <?= $name ?>';
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
	 * Configura entradas que serão salvas no Banco de dados
	 */
	private function _config_entry_to_database(&$data)
	{
		//$data['date'] = format_datetime($data['visible_in'], '-');
	}

	/**
	 * Configura entradas para views 
	 */
	private function _config_entry_to_humans(&$data)
	{
		//$data->date = format_datetime($data->visible_in);
	}

}