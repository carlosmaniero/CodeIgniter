if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_<?= ucfirst($name) ?> extends CI_Migration {

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

		<? foreach ($attrs as $attr): if($attr['name'] != 'belong_to'): ?>

		$this->dbforge->add_field(array(

			'<?= $attr['name'] ?>' => array(
				<? foreach ($attr['properties'] as $key => $value):  ?>'<?= $key ?>' => '<?= $value ?>',
				<? endforeach; ?>

			)));

		<? else: ?>

		$this->dbforge->add_field(array(
			'<?= $attr['properties'] ?>_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			)));

		<? endif; endforeach; ?>

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

		<? foreach ($attrs as $attr): if($attr['name'] == 'belong_to'): ?>
			$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (<?= $attr['properties'] ?>_id) REFERENCES <?= $attr['properties'] ?>(id)");
		<? endif; endforeach; ?>

		// Add id as primary key
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('<?= $name ?>'))
		{
			log_message('debug', 'Table <?= $name ?> created!');
		}
		else
		{
			log_message('error', 'Error on create <?= $name ?> table');
		}
	}

	public function down() {
		if($this->dbforge->drop_table('<?= $name ?>'))
		{
			log_message('debug', 'Table <?= $name ?> droped');
		}
		else
		{
			log_message('error', 'Error on drop <?= $name ?> table');
		}
	}

}

/* End of file migration.php */
/* Location: ./application/views/console/migration.php */
