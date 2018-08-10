<?php

namespace Fuel\Migrations;

class Create_events
{
	public function up()
	{
		\DBUtil::create_table('events', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			
			'user_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'organizer' => array('constraint' => 255, 'type' => 'varchar'),
			'wp_url' => array('constraint' => 255, 'type' => 'varchar'),
			'capacity' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'start_date' => array('type' => 'date', 'null' => true),
			'end_date' => array('type' => 'date', 'null' => true),
			'start_time' => array('type' => 'datetime', 'null' => true),
			'end_time' => array('type' => 'datetime', 'null' => true),
			'reception_open' => array('type' => 'datetime', 'null' => true),
			'reception_close' => array('type' => 'datetime', 'null' => true),
			'charge' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'status' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('events');
	}
}
