<?php

namespace Fuel\Migrations;

class Create_onetimes
{
	public function up()
	{
		\DBUtil::create_table('onetimes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name_last' => array('constraint' => 255, 'type' => 'varchar'),
			'name_first' => array('constraint' => 255, 'type' => 'varchar'),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'type' => 'varchar'),
			'tel' => array('constraint' => 255, 'type' => 'varchar'),
			'hash' => array('constraint' => 255, 'type' => 'varchar'),
			'data' => array('constraint' => 20000, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('onetimes');
	}
}