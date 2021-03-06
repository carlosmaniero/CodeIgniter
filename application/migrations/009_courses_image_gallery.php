<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Courses_image_gallery extends CI_Migration {

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

			'image' => array(
				'type' => 'varchar',
				'constraint' => '255'
			)));


		$this->dbforge->add_field(array(
			'extra_course_id' => array(
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

					$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (extra_course_id) REFERENCES extra_courses(id)");

		// Add id as primary key
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('courses_image_galleries'))
		{
			log_message('debug', 'Table courses_image_galleries created!');
		}
		else
		{
			log_message('error', 'Error on create courses_image_galleries table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('courses_image_galleries'))
		{
			log_message('debug', 'Table courses_image_galleries droped');
		}
		else
		{
			log_message('error', 'Error on drop courses_image_galleries table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
