<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Create the user Table
 */
class Migration_Users extends CI_Migration
{

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up()
	{

		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => 'false',
			),
			'salt' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => 'false',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => 'false',
			),
			'last_login' => array(
				'type' => 'DATETIME',
			),
			'status' => array(
				'type' => 'TINYINT',
				'default' => 0,
				'null' => 'false',
			)
		));

		$this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");

		$this->dbforge->add_field(array(
			'updated_at' => array(
				'type' => 'DATETIME'
		)));

		$this->dbforge->add_field(array(
			'deleted' => array(
				'type' => 'TINYINT',
				'unsigned' => TRUE,
				'default' => 0
		)));

		$this->dbforge->add_field(array(
			'deleted_at' => array(
				'type' => 'DATETIME'
		)));

		// Add id as primary key
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('ci_users'))
		{
			log_message('debug', 'Table ci_users created!');

			$salt = 23456789;

			$seed = array(
				'id' => 1,
				'username' => 'admin',
				'salt' => $salt,
				'password' => sha1($salt . 'admin'),
				'status' => 1,
			);

			if($this->db->insert('ci_users', $seed)){
				log_message('debug', 'User admin created!');
			}else{
				log_message('error', 'Error on create user admin!');
			}

		}
		else
		{
			log_message('error', 'Error on create ci_user table');
		}

	}

	public function down()
	{

		if($this->dbforge->drop_table('ci_users'))
		{
			log_message('debug', 'Table ci_user droped');
		}
		else
		{
			log_message('error', 'Error on drop ci_user table');
		}

	}

}

/* End of file user.php */
/* Location: ./application/migrations/user.php */
