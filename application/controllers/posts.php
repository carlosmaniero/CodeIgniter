<?php
class Posts extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Post_model', 'model');
	}

	/**
	 * Lista de Posts
	 */
	public function index()
	{
		$data = new StdClass();
		$data->results = $this->model->get_all();

		if($this->uri->extension == 'json')
		{
			$this->response_json($data->results);
		}else{
			$this->template->load('template/default', 'posts/index', $data);
		}

	}

	/**
	 * Inserre um post
	 */
	public function insert()
	{
		$data = new StdClass();

		// Caso a requisição seja do tipo post
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$post = $this->input->post();

			// Configua as entradas que serão salvas no banco de dados
			$this->config_entries_to_database($post);

			// Resultado da inserção
			$result = $this->model->insert($post);

			if($result)
			{
				// Respostas em caso de Sucesso
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'Post insirido com sucesso');
					redirect('posts/show/' . $result . '.' . $this->uri->extension);
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
					redirect('posts/insert/');
				}
			} 

			return;
		}

		// Renderiza View
		$this->template->load('template/default', 'posts/insert', $data);
	}

	/**
	 * Edita um post
	 */
	public function edit($id)
	{
		$data = new StdClass();

		// Caso a requisição seja do tipo post
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$post = $this->input->post();
			// Configua as entradas que serão salvas no banco de dados
			$this->config_entries_to_database($post);

			// Resultado da atualização			
			$result = $this->model->update($id, $post);

			if($result)
			{
				// Respostas em caso de Sucesso
				if($this->uri->extension == 'json')
				{
					$this->show($result);
				}
				else
				{
					$this->session->set_flashdata('success', 'value');
					redirect('posts/show/' . $result . '.' . $this->uri->extension);
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
					redirect('posts/insert/');
				}
			} 


		}
		$data = new StdClass();
		$data->result = $this->model->get($id);
		$this->template->load('template/default', 'posts/edit', $data);
	}

	/**
	 * Exibe um post
	 */
	public function show($id)
	{

	}

	/**
	 * Configura entradas que serão salvas no Banco de dados
	 */
	private function config_entries_to_database(&$entry)
	{
		$post['visible_in'] = format_datetime($post['visible_in'], '-');
	}

}