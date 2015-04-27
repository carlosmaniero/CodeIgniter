<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Banner extends CI_Migration {

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

			'images' => array(
				'type' => 'varchar',
				'constraint' => '255',
				'comments' => 'image',
				
			)));

		
		$this->dbforge->add_field(array(

			'title' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'description' => array(
				'type' => 'text',
				
			)));

		
		$this->dbforge->add_field(array(

			'link' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'order' => array(
				'type' => 'tinyint',
				
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

		if($this->dbforge->create_table('banners'))
		{
			log_message('debug', 'Table banners created!');
		}
		else
		{
			log_message('error', 'Error on create banners table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('banners'))
		{
			log_message('debug', 'Table banners droped');
		}
		else
		{
			log_message('error', 'Error on drop banners table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
