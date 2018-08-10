<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace MyAuth;

/**
 * SimpleAuth basic login driver
 *
 * @package     Fuel
 * @subpackage  Auth
 */
class Auth_Login_Simpleauth extends \Auth\Auth_Login_Simpleauth
{
	/**
	 * Create new user
	 *
	 * @param   string
	 * @param   string
	 * @param   string  must contain valid email address
	 * @param   int     group id
	 * @param   Array
	 * @return  bool
	 */
	public function create_user($username, $password, $email, $group = 1, Array $profile_fields = array())
	{
		$is_posted_email = false;
		$password = trim($password);
		if (empty($email)){
			$email = '';
		}else{
			$is_posted_email = true;
			$email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
		}

		if (empty($username) or empty($password))
		{
			throw new \SimpleUserUpdateException('Username or password is not given', 1);
		}

		if ($is_posted_email && empty($email))
		{
			throw new \SimpleUserUpdateException('email address is invalid', 1);
		}


		$same_users = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
			->where('username', '=', $username);

		if ($is_posted_email)
		{
			$same_users = $same_users->or_where('email', '=', $email);
		}

			$same_users = $same_users
			->from(\Config::get('simpleauth.table_name'))
			->execute(\Config::get('simpleauth.db_connection'));

		if ($same_users->count() > 0)
		{
			if ($is_posted_email && in_array(strtolower($email), array_map('strtolower', $same_users->current())))
			{
				throw new \SimpleUserUpdateException('Email address already exists', 2);
			}
			else
			{
				throw new \SimpleUserUpdateException('Username already exists', 3);
			}
		}

		$user = array(
			'username'        => (string) $username,
			'password'        => $this->hash_password((string) $password),
			'email'           => $email,
			'group'           => (int) $group,
			'profile_fields'  => serialize($profile_fields),
			'last_login'      => 0,
			'login_hash'      => '',
			'created_at'      => \Date::forge()->get_timestamp()
		);
		$result = \DB::insert(\Config::get('simpleauth.table_name'))
			->set($user)
			->execute(\Config::get('simpleauth.db_connection'));

		return ($result[1] > 0) ? $result[0] : false;
	}
}

// end of file simpleauth.php
