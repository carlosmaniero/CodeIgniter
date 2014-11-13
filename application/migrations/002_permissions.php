<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Permissions extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
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


		if($this->dbforge->create_table('ci_permissions'))
		{
			log_message('debug', 'Table ci_permissions created!');

			$seed = array(
				'id' => 1,
				'name' => 'admin'
			);

			if($this->db->insert('ci_permissions', $seed)){
				log_message('debug', 'permission created!');
			}else{
				log_message('error', 'Error on create permission!');
			}

		}
		else
		{
			log_message('error', 'Error on create ci_user table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('ci_permissions'))
		{
			log_message('debug', 'Table ci_permissions droped');
		}
		else
		{
			log_message('error', 'Error on drop ci_permissions table');
		}
	}

}

/* End of file class_name.php */
/* Location: ./application/migrations/class_name.php */