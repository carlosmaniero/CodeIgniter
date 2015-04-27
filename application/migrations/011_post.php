<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Post extends CI_Migration {

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

			'user_id' => array(
				'int' => '',

			)));


		$this->dbforge->add_field(array(

			'pub_date' => array(
				'type' => 'datetime',

			)));


		$this->dbforge->add_field(array(

			'image' => array(
				'type' => 'varchar',
				'constraint' => '255'				
			)));


		$this->dbforge->add_field(array(

			'title' => array(
				'type' => 'varchar',
				'constraint' => '255',

			)));


		$this->dbforge->add_field(array(

			'content' => array(
				'type' => 'text',

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


		// Add id as primary key
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('posts'))
		{
			log_message('debug', 'Table posts created!');
		}
		else
		{
			log_message('error', 'Error on create posts table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('posts'))
		{
			log_message('debug', 'Table posts droped');
		}
		else
		{
			log_message('error', 'Error on drop posts table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
