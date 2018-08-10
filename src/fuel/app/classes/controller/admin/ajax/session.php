<?php

//class Controller_Ajax extends Controller_Rest_Base
class Controller_Admin_Ajax_Session extends Controller_Rest
{

	public function action_keep(){
        $url = (strpos($_SERVER["HTTP_HOST"],':8081') === false)?"https://startuphub.tokyo":"http://startuphub.tokyo:8081" ;
        $driver = "Accountauth"; 
        $auth = Auth::instance($driver); 
        header('Access-Control-Allow-Origin: ' . $url, true);
        header('Access-Control-Allow-Credentials: true');
        $Login =  $auth->check();
        $flag=1;
        if (empty($Login)){
                $flag=0;
                session_name('CAKEPHP');
                session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                session_start();
                unset($_SESSION['LOGIN']);
                session_write_close();
        }
        return $this->response(['source'=>'cake.admin','flag'=>$flag]);
	}
	
}
