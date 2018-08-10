<?php
namespace Fuel\Migrations;

class Add_type_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'type' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'nationality' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'type',
			'nationality',
		));
	}
}
