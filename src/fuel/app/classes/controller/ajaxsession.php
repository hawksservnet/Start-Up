<?php

//class Controller_Ajax extends Controller_Rest_Base
class Controller_Ajaxsession extends Controller_Rest
{


	public function action_keep(){

        $url = (strpos($_SERVER["HTTP_HOST"],':8081') === false)?"https://startuphub.tokyo":"http://startuphub.tokyo:8081" ;
        header('Access-Control-Allow-Origin: ' . $url, true);
        header('Access-Control-Allow-Credentials: true');
 

        $flag=1;
        if (!Auth::check()){
                  $flag=0;
                session_name('CAKEPHP');
                session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                session_start();
                if(isset($_SESSION['LOGIN']))
                unset($_SESSION['LOGIN']);
                if(isset($_SESSION['MYPAGE']))
                unset($_SESSION['MYPAGE']);
                session_write_close();
                //end
                Auth::logout();
        }
        return $this->response(['source'=>'cake.user','flag'=>$flag]);
	}
	
}
