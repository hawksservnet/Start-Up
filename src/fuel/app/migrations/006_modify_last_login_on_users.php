<?php

namespace Fuel\Migrations;

class Modify_last_login_on_users
{
	public function up()
	{
		\DBUtil::modify_fields('users', array(
			'last_login' => array('constraint' => 11, 'type' => 'int', 'null' => true)
		));
	}

	public function down()
	{
		\DBUtil::modify_fields('users', array(
			'last_login' => array('type' => 'datetime', 'null' => true),
		));
	}
}
