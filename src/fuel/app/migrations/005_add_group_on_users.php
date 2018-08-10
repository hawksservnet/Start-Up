<?php

namespace Fuel\Migrations;

class Add_group_on_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'group' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'username' => array('constraint' => 50, 'type' => 'varchar', 'null' => true),
			'last_login' => array('type' => 'datetime', 'null' => true),
			'login_hash' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'profile_fields' => array('type' => 'text', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'group',
			'username',
			'last_login',
			'login_hash',
			'profile_fields'
		));
	}
}