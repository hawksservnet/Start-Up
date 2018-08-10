<?php

namespace Fuel\Migrations;

class Modify_industry_on_users
{
	public function up()
	{
		\DBUtil::modify_fields('users', array(
			'industry' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'business_type' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::modify_fields('users', array(
			'industry' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'business_type' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		));
	}
}
