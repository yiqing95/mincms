<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
use app\core\Load;
/**
 * ## 腾讯微博
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class TqController extends OauthController
{
 
 	public $type = 'tq';
 	/**
 	* load some required files
 	*/
	function init(){
		parent::init(); 
	 	$row = $this->member_get_oauth_type($this->type);
		if(!$row->id){
			exit('access deny');
		} 
		$this->oauth_id = $row->id; 
		$this->app_key = $row->key1;
		$this->app_secret = $row->key2;
		$this->url = host().url('oauth/'.$this->type.'/return'); 
        session_start(); 
        Load::file (base_path().'modules/oauth/libraries/qq/Tencent.php');  
		\OAuth::init($this->app_key, $this->app_secret);   
		\Tencent::$debug = false;    
		
	}
 	public function actionIndex()
	{
	 	$code_url = \OAuth::getAuthorizeURL($this->url);   
		header("location:$code_url"); 
 		exit;
	}
	
	function actionReturn(){
		if ($_GET['code']) {//已获得code
	        $code = $_GET['code'];
	        $openid = $_GET['openid'];
	        $openkey = $_GET['openkey'];
	        //获取授权token
	        $url = \OAuth::getAccessToken($code, $this->url);
	        $access_token = $_SESSION['t_access_token']; 
	        
	        $r = \Http::request($url);
	        parse_str($r, $out);
	        //存储授权数据
	        if ($out['access_token']) {
	            $_SESSION['t_access_token'] = $out['access_token'];
	            $_SESSION['t_expire_in'] = $out['expire_in'];
	            $_SESSION['t_code'] = $code;
	            $_SESSION['t_openid'] = $openid;
	            $_SESSION['t_openkey'] = $openkey;
	            //验证授权
	            $ret = \OAuth::checkOAuthValid();  
	            $ret = \Tencent::api('user/info');
				$uid_get = json_decode($ret, true); 
				try {
					$uid = $uid_get['data']['openid']; 
	 				$me['id'] = $uid;
	 				$me['name'] = $uid_get['data']['name']; 
	 				$me['email']  = $uid_get['data']['email'];
	 				$me['nickname'] = $uid_get['data']['nick']; 
			 	 
					$r = $this->member_get_third_set_user($me,$this->oauth_id,$access_token);   
					
			 	 	flash('success',__('login success'));
					$this->redirect(return_url());
					
				} catch (OAuthException $e) {
					flash('error',__('login error'));
					$this->redirect(return_url());
				}
			}
		}
		exit; 
	}

 
}
