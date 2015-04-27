<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Period extends CI_Migration {

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

			'name' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'description' => array(
				'type' => 'text',
				
			)));

		
		$this->dbforge->add_field(array(

			'image' => array(
				'type' => 'varchar',
				'constraint' => '255',
				'comments' => 'image',
				
			)));

		
		$this->dbforge->add_field(array(

			'video' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'link_products' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'link_services' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'link_documents' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'link_calendar' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'link_materials' => array(
				'type' => 'varchar',
				'constraint' => '255',
				
			)));

		
		$this->dbforge->add_field(array(

			'link_bookstores' => array(
				
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

		if($this->dbforge->create_table('periods'))
		{
			log_message('debug', 'Table periods created!');
		}
		else
		{
			log_message('error', 'Error on create periods table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('periods'))
		{
			log_message('debug', 'Table periods droped');
		}
		else
		{
			log_message('error', 'Error on drop periods table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
