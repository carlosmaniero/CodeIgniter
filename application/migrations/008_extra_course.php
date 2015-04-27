<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Extra_course extends CI_Migration {

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

			'title' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'image' => array(
				'type' => 'varchar',
				'constraint' => '255',
				'comments' => 'image',
				
			)));

		
		$this->dbforge->add_field(array(

			'content' => array(
				'type' => 'text',
				
			)));

		
		$this->dbforge->add_field(array(

			'payment_information' => array(
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

		if($this->dbforge->create_table('extra_courses'))
		{
			log_message('debug', 'Table extra_courses created!');
		}
		else
		{
			log_message('error', 'Error on create extra_courses table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('extra_courses'))
		{
			log_message('debug', 'Table extra_courses droped');
		}
		else
		{
			log_message('error', 'Error on drop extra_courses table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
