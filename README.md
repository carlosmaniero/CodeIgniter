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

Voltando para um estado especígico:

	php index.php console migrations 0