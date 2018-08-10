<?php
/**
 * The production database.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'		 => 'mysql:host=localhost;dbname=mem_test',

			'username'	 => 'suhtokyo',
			'password'	 => 'tokyo_startup',
		),
		 'profiling'  => true,
		 
	),
);
