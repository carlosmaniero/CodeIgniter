<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_User_Permissions extends CI_Migration {

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
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'permission_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
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

		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES ci_users(id)");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (permission_id) REFERENCES ci_permissions(id)");

		if($this->dbforge->create_table('ci_user_permissions'))
		{
			log_message('debug', 'Table ci_user_permissions created!');

			$seed = array(
				'id' => 1,
				'user_id' => 1,
				'permission_id' => 1
			);

			if($this->db->insert('ci_user_permissions', $seed)){
				log_message('debug', 'User permission created!');
			}else{
				log_message('error', 'Error on create user permission!');
			}

		}
		else
		{
			log_message('error', 'Error on create ci_user_permissions table!');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('ci_user_permissions'))
		{
			log_message('debug', 'Table ci_user_permissions droped');
		}
		else
		{
			log_message('error', 'Error on drop ci_user_permissions table');
		}
	}

}

/* End of file 002_user_permission.php */
/* Location: ./application/migrations/002_user_permission.php */