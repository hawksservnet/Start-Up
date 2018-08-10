<?php

namespace Fuel\Migrations;

class Modify_birthday_on_users
{
	public function up()
	{
		\DBUtil::modify_fields('users', array(
			'birthday' => array('type' => 'date', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::modify_fields('users', array(
			'birthday' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		));
	}
}
