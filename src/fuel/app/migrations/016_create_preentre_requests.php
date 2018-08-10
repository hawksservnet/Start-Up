<?php

namespace Fuel\Migrations;

class Create_preentre_requests
{
	public function up()
	{
		\DBUtil::create_table('preentre_requests', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			
			'intention' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'business_type' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'business_type_text' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'business_style' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'business_style_text' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'problem01' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem02' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem03' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem04' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem05' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem06' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem07' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem08' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem09' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem10' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem11' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem12' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem13' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem14' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem15' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem16' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem17' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem18' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem19' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem20' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem21' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem22' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem23' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem24' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem25' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem26' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem27' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem28' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem29' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem30' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem31' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem32' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'problem_text' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'wish' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('preentre_requests');
	}
}