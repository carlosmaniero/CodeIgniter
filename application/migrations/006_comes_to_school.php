<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Comes_to_school extends CI_Migration {

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

			'mail' => array(
				'type' => 'varchar',
				'constraint' => '255',

			)));


		$this->dbforge->add_field(array(

			'phone' => array(
				'type' => 'varchar',
				'constraint' => '255',

			)));


		$this->dbforge->add_field(array(

			'near_to_school' => array(
				'type' => 'tinyint',

			)));


		$this->dbforge->add_field(array(

			'loking_for' => array(
				'type' => 'varchar',
				'constraint' => '512',

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

		if($this->dbforge->create_table('comes_to_schools'))
		{
			log_message('debug', 'Table comes_to_schools created!');
		}
		else
		{
			log_message('error', 'Error on create comes_to_schools table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('comes_to_schools'))
		{
			log_message('debug', 'Table comes_to_schools droped');
		}
		else
		{
			log_message('error', 'Error on drop comes_to_schools table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
