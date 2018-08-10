<?php

namespace Fuel\Migrations;

class Create_event_tags
{
	public function up()
	{
		\DBUtil::create_table('event_tags', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'event_id' => array('constraint' => 11, 'type' => 'int'),
			'tag_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('event_tags');
	}
}