<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Post_category extends CI_Migration {

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
				)));


		$this->dbforge->add_field(array(
			'post_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			)));

		$this->dbforge->add_field(array(
			'category_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			)));

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

		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (post_id) REFERENCES posts(id)");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (category_id) REFERENCES categories(id)");

		// Add id as primary key
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('post_categories'))
		{
			log_message('debug', 'Table post_categories created!');
		}
		else
		{
			log_message('error', 'Error on create post_categories table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('post_categories'))
		{
			log_message('debug', 'Table post_categories droped');
		}
		else
		{
			log_message('error', 'Error on drop post_categories table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
