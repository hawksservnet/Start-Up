<?php
namespace Fuel\Migrations;

class Add_cardid_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'cardid' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'cardid',
		));
	}
}
