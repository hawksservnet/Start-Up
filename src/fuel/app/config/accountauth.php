<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * DB connection, leave null to use default
	 */
	'db_connection' => null,

	/**
	 * DB write connection, leave null to use same value as db_connection
	 */
	'db_write_connection' => null,

	/**
	 * DB table name for the user table
	 */
//	'table_name' => 'accounts',
	'table_name' => 'acounts',

	/**
	 * Choose which columns are selected, must include: username, password, email, last_login,
	 * login_hash, group & profile_fields
	 */
	'table_columns' => array('*'),

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => true,

	/**
	 * This will allow the same user to be logged in multiple times.
	 *
	 * Note that this is less secure, as session hijacking countermeasures have to
	 * be disabled for this to work!
	 */
	'multiple_logins' => true, 

	/**
	 * Remember-me functionality
	 */
	'remember_me' => array(
		/**
		 * Whether or not remember me functionality is enabled
		 */
		'enabled' => false,

		/**
		 * Name of the cookie used to record this functionality
		 */
		'cookie_name' => 'rmcookie',

		/**
		 * Remember me expiration (default: 31 days)
		 */
		'expiration' => 86400 * 31,
	),

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */
/*
	'groups' => array(
		 -1   => array('name' => 'Banned', 'roles' => array('banned')),
		 0    => array('name' => 'Guests', 'roles' => array()),
		 1    => array('name' => 'Users', 'roles' => array('user')),
		 50   => array('name' => 'Moderators', 'roles' => array('user', 'moderator', )),
		 100  => array('name' => 'Administrators', 'roles' => array('user', 'moderator', 'admin')), // 管理者
	),
*/
	'groups' => array(
		/**
		 * Examples
		 * ---
		 * 0   => array('name' => 'Administrators', 'roles' => array('admin')),
		 * 1   => array('name' => 'Secretariat', 'roles' => array('user', 'concierge', 'admin')),
		 * 2   => array('name' => 'Organizer', 'roles' => array('user')),
		 * 3   => array('name' => 'Concierge', 'roles' => array('user', 'concierge', )),
		 * 4   => array('name' => 'ConciergeManager', 'roles' => array('user', 'concierge', 'admin')), // 管理者
		 * 9   => array('name' => 'Guests', 'roles' => array()),
		 * 0   => array('name' => 'Administrators', 'roles' => array('admin')),
		 */
		 0   => array('name' => 'Administrators', 'roles' => array('admin')),
		 1   => array('name' => 'Secretariat', 'roles' => array('concierge', 'admin')),
		 2   => array('name' => 'Organizer', 'roles' => array()),
		 3   => array('name' => 'Concierge', 'roles' => array('concierge')),
		 4   => array('name' => 'ConciergeManager', 'roles' => array('concierge', 'admin')), // 管理者
		 9   => array('name' => 'Guests', 'roles' => array()),

	),

	/**
	 * Roles as name => array(location => rights)
	 */
/*
	'roles' => array(
		'user'  => array(
			'userPage' => array('browse')
		),
		'moderator'  => array(
			'modePage' => array('browse')
		),
		'admin'  => array(
			'adminPage' => array('browse')
		),
		'banned' => false,
	),
*/
	'roles' => array(
		'user'  => array(
			'userPage' => array('browse')
		),
		'concierge'  => array(
			'conPage' => array('browse')
		),
		'admin'  => array(
			'adminPage' => array('browse')
		),
		'banned' => false,
		/**
		 * Examples
		 * ---
		 *
		 * Regular example with role "user" given create & read rights on "comments":
		 *   'user'  => array('comments' => array('create', 'read')),
		 * And similar additional rights for moderators:
		 *   'moderator'  => array('comments' => array('update', 'delete')),
		 *
		 * Wildcard # role (auto assigned to all groups):
		 *   '#'  => array('website' => array('read'))
		 *
		 * Global disallow by assigning false to a role:
		 *   'banned' => false,
		 *
		 * Global allow by assigning true to a role (use with care!):
		 *   'super' => true,
		 */
	),

	/**
	 * Salt for the login hash
	 */
	'login_hash_salt' => 'gWZ64kAPxGyDV4NwNq123',

	/**
	 * $_POST key for login username
	 */
	'username_post_key' => 'email',

	/**
	 * $_POST key for login password
	 */
	'password_post_key' => 'password',
);
