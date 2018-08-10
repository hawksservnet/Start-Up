<?php

namespace Fuel\Migrations;

class Add_wish01_on_preentre_requests
{
	public function up()
	{
		\DBUtil::add_fields('preentre_requests', array(
			'wish01' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish02' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish03' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish04' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish05' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish06' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish07' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish08' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish09' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish10' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish11' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish12' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish13' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish14' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish15' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'wish16' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('preentre_requests', array(
			'wish01',
			'wish02',
			'wish03',
			'wish04',
			'wish05',
			'wish06',
			'wish07',
			'wish08',
			'wish09',
			'wish10',
			'wish11',
			'wish12',
			'wish13',
			'wish14',
			'wish15',
			'wish16',
		));
	}
}