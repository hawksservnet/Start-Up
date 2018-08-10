<?php
use Fuel\Core\Controller;
use Fuel\Core\Log;

class Controller_Auth extends Controller {

	public function action_oauth($provider = 'Facebook')
	{
		// bail out if we don't have an OAuth provider to call
		if ($provider === null)
		{
			Log::error(__('login-no-provider-specified'));
			\Response::redirect_back();
		}

		// load Opauth, it will load the provider strategy and redirect to the provider
		\Auth_Opauth::forge();
	}

	public function action_logout()
	{
		// remove the remember-me cookie, we logged-out on purpose
		\Auth::dont_remember_me();

		// logout
		\Auth::logout();

		// and go back to where you came from (or the application
		// homepage if no previous page can be determined)
		\Response::redirect_back();
	}

	public function action_callback()
	{


		// Opauth can throw all kinds of nasty bits, so be prepared
		try
		{
			// get the Opauth object
			$opauth = \Auth_Opauth::forge(false);

			// and process the callback
			$status = $opauth->login_or_register();

			// fetch the provider name from the opauth response so we can display a message
			$provider = $opauth->get('auth.provider', '?');

			// deal with the result of the callback process
			switch ($status)
			{
				// a local user was logged-in, the provider has been linked to this user
				case 'linked':
					// inform the user the link was succesfully made
					// and set the redirect url for this status
					$url = '/';
					break;

					// the provider was known and linked, the linked account as logged-in
				case 'logged_in':
					// inform the user the login using the provider was succesful
					// and set the redirect url for this status

					$url = '/';
					break;

					// we don't know this provider login, ask the user to create a local account first
				case 'register':
					// inform the user the login using the provider was succesful, but we need a local account to continue
					// and set the redirect url for this status
					$url = 'auth/register';
					break;

					// we didn't know this provider login, but enough info was returned to auto-register the user
				case 'registered':
					// inform the user the login using the provider was succesful, and we created a local account
					// and set the redirect url for this status
					$url = '/';
					break;

				default:
					throw new \FuelException('Auth_Opauth::login_or_register() has come up with a result that we dont know how to handle.');
			}

			// redirect to the url set
			\Response::redirect($url);
		}

		// deal with Opauth exceptions
		catch (\OpauthException $e)
		{
			Log::error($e->getMessage());
			\Response::redirect_back();
		}

		// catch a user cancelling the authentication attempt (some providers allow that)
		catch (\OpauthCancelException $e)
		{
			// you should probably do something a bit more clean here...
			exit('It looks like you canceled your authorisation.'.\Html::anchor('users/oath/'.$provider, 'Click here').' to try again.');
		}

	}

	public function action_register()
	{
		$authentication = \Session::get('auth-strategy.authentication', array());
		$name = \Session::get('auth-strategy.user.name', '');
		$user_provider = \DB::select()->from('users_providers')->where('uid', '=', $authentication['uid'])->where('provider', '=', $authentication['provider'])->execute()->as_array();
		if(!empty($user_provider)){
			// check the credentials.
			if (\Auth::instance()->force_login($user_provider['parent_id']))
			{
				// get the current logged-in user's id
				list(, $userid) = \Auth::instance()->get_user_id();

				// so we can link it to the provider manually
				$this->link_provider($userid);

				// logged in, go back where we came from,
				// or the the user dashboard if we don't know
				\Response::redirect_back('/');
			}
			else
			{
				// login failed, show an error message
				Log::error(__('login.failure'));
			}
		}else{
			try
			{
				// call Auth to create this user
				$username = $name.'_'.time();
				$password = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 12);
				$tmp_mail = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 12);
				$created = Auth::create_user(
						$username,
						$password,
						$tmp_mail.'@tmpmail.com',
						\Config::get('application.user.default_group', 1)
				);

				if ($created){
					$user = Model_User::find($created);
					$user->full_name = $name;
					$user->save();
					\Response::redirect('users/add_account');
				
				}else{
					// oops, creating a new user failed?
					Log::error(__('login.account-creation-failed'));
				}
			}

			// catch exceptions from the create_user() call
			catch (\SimpleUserUpdateException $e)
			{
				// duplicate email address
				if ($e->getCode() == 2)
				{
					Log::error(__('login.email-already-exists'));
				}

				// duplicate username
				elseif ($e->getCode() == 3)
				{
					Log::error(__('login.username-already-exists'));
				}

				// this can't happen, but you'll never know...
				else
				{
					Log::error($e->getMessage());
          var_dump($e);
          die;
				}
			}
		}

		\Response::redirect('login');
	}

	protected function link_provider($userid)
	{
		// do we have an auth strategy to match?
		if ($authentication = \Session::get('auth-strategy.authentication', array()))
		{
			// don't forget to pass false, we need an object instance, not a strategy call
			$opauth = \Auth_Opauth::forge(false);

			// call Opauth to link the provider login with the local user
			$insert_id = $opauth->link_provider(array(
					'parent_id' => $userid,
					'provider' => $authentication['provider'],
					'uid' => $authentication['uid'],
					'access_token' => $authentication['access_token'],
					'secret' => $authentication['secret'],
					'refresh_token' => $authentication['refresh_token'],
					'expires' => $authentication['expires'],
					'created_at' => time(),
			));
		}
	}

}
