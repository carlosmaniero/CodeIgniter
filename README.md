# Codeigniter

Fork do Codeigniter com alguns recursos adicionais

## Command-line

*Principais recursos do Command-line:*

Criação de Models:

	php index.php console generate_model funcinarios nome:type=varchar,constrint=100 email:type=varchar,constrint=100

Criação de Models com Chave estrangeira:

	php index.php console generate_model filhos_do_funcinarios nome:type=varchar,constrint=100 belong_to:funcionario

Rodando Migrations:

	php index.php console migrations

Voltando para um estado específico:

	php index.php console migrations 0

## Autenticação Nativa

```php
	class Welcome extends CI_Controller {

	// Array com métodos que exigem autenticação TRUE para todos.
	protected $require_auth = array('login_required'); 
	// Array com as permissões necessárias, não defina o campo caso qualquer usuário autenticado possa acessar
	protected $permission_auth = array('admin'); 

	public function login_required()
	{
		if($this->uri->extension == 'json'){
			$this->responde_json(array('message'=>'Only loggged user!'));
		}else{
			$this->load->view('welcome_message');
		}
	}


	public function index()
	{

		if($this->uri->extension == 'json'){
			$this->responde_json(array('message'=>'Welcome to CodeIgniter!'));
		}else{
			$this->load->view('welcome_message');
		}
	}
}
```

## Extensões

Você pode usar extensões em suas URL, por exemplo: http://localhost/index.php/controller/method.json

```php
	public function method()
	{
		if($this->uri->extension == 'json'){
			$this->responde_json(array('message'=>'This is a json'));
		}else{
			$this->load->view('view');
		}
	}
```