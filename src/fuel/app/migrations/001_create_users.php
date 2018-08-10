<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name_last' => array('constraint' => 255, 'type' => 'varchar'),
			'name_first' => array('constraint' => 255, 'type' => 'varchar'),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'type' => 'varchar'),
			
			'hiragana_name_last' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'hiragana_name_first' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'tel' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'birthday' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'sex' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'zip' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'pref' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'city' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'address' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'building' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'organization' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'position' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'job' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'interest' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'preparation' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'mailmagazine' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'mailmagazine_info' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role01' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role02' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role03' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role04' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role05' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role06' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role07' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role08' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role09' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role10' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role11' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'role12' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'event' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'matching' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'entrepreneur_date' => array('type' => 'date', 'null' => true),
			'business_type' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'industry' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}
