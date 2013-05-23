<?php
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq¹Ù·½Èº: 40933125>
 * @Coprighty  http://mincms.com
 */
class QqController extends Controller
{
	public $url;
	public $app_key;
	public $app_secret;
	public $oauth_id; 
	public $auth;
	public $type = 'qq';
 
 	/**
 	* load some required files
 	*/
	function init(){
		parent::init(); 
	 	$row = member_get_oauth_type($this->type);
		if(!$row->id){
			exit('access deny');
		} 
		$this->oauth_id = $row->id; 
		$this->app_key = $row->app_key;
		$this->app_secret = $row->app_secret;
		$url = '/'.url('member/'.$this->type.'/return');
		$url = str_replace('//','/',$url);
		$this->url = host().$url;  
        session_start();  
        define('BASEPATH',true); 
        Yii::import('module.member.components.oauth2.Provider',true);
        Yii::import('module.member.components.oauth2.OAuth2',true); 
        Yii::import('module.member.components.oauth2.Exception',true);
        Yii::import('module.member.components.oauth2.Token',true);
        
      
  	 
		
		
	}
 	public function actionIndex()
	{ 
	 	$code_url = "https://graph.qq.com/oauth2.0/authorize?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&response_type=code";
		header("location:$code_url"); 
 		exit;
	}
	function actionReturn(){
		$this->auth = OAuth2::provider($this->type, array(
	    	'id' =>$this->app_key, 
	        'secret' => $this->app_secret, 
		));     
		$params['redirect_uri'] = $this->url;
		$params['grant_type'] = 'authorization_code';
		$o = $this->auth->access($_GET['code'],$params);
		$_GET['access_token'] = $o->access_token;
	 	$this->save_login(); 
	}
	
	protected function save_login(){
		$access_token = $_GET['access_token'];
		if ($_GET['access_token']){
			try
	        {    
	        	$this->auth =  OAuth2::provider($this->type, array(
			    	'id' =>$this->app_key, 
	       			'secret' => $this->app_secret, 
			    )); 	          
	            $info = $this->auth->get_user_info($access_token); 	          
 				$uid = $info['uid']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['nickname']; 
 				$me['email']  = $info['email']; 
 			 
				
				$r = member_get_third_set_user($me,$this->oauth_id,$access_token);   
				
		 	 	flash('success',__('login success'));
				$this->redirect(return_url());
				
			} catch (OAuthException $e) {
				flash('error',__('login error'));
				$this->redirect(return_url());
			}
		}
		exit; 
	}

 
}
