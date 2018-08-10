<?php

namespace Fuel\Migrations;

class Create_event_requests
{
	public function up()
	{
		\DBUtil::create_table('event_requests', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			
			'user_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'event_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'status' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'waiting_order' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'option' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'note' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('event_requests');
	}
}
