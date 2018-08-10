<?php

namespace Fuel\Migrations;

class Add_img_url_on_events
{
	public function up()
	{
		\DBUtil::add_fields('events', array(
			'img_url' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
		));
		\DBUtil::modify_fields('events', array(
			'organizer' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'wp_url' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('events', array(
			'img_url'
		));
		\DBUtil::modify_fields('events', array(
			'organizer' => array('constraint' => 255, 'type' => 'varchar'),
			'wp_url' => array('constraint' => 255, 'type' => 'varchar'),
		));
	}
}
