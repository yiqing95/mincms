<?php
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq¹Ù·½Èº: 40933125>
 * @Coprighty  http://mincms.com
 */
class GoogleController extends Controller
{
	public $url;
	public $app_key;
	public $app_secret;
	public $oauth_id; 
	public $auth;
	public $type = 'google';
 
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
		$this->url = host().url('member/'.$this->type.'/return');  
        define('BASEPATH',true); 
        Yii::import('module.member.components.oauth2.Provider',true);
        Yii::import('module.member.components.oauth2.OAuth2',true); 
        Yii::import('module.member.components.oauth2.Exception',true);
        Yii::import('module.member.components.oauth2.Token',true);
        
      
  	 
		
		
	}
 	public function actionIndex()
	{
		$rt = urlencode($this->url); 
		$code_url = "https://accounts.google.com/o/oauth2/auth?scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&state=".$rt."&redirect_uri=".urlencode($this->url)."&response_type=token&client_id=".$this->app_key;
		header("location:$code_url"); 
	}
	
	function actionReturn(){    
        $this->render('index');
	}
	function actionNext(){
		if ($access_token = $_GET['access_token']){
			try
	        {    
	        	$this->auth =  OAuth2::provider($this->type, array(
			    	'id' =>$this->app_key, 
	       			'secret' => $this->app_secret, 
			    )); 	          
			    $token = OAuth2_Token::factory('access', array('access_token'=>$access_token)); 
	            $info = $this->auth->get_user_info($token); 	          
 				$uid = $info['uid']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['name']; 
 				$me['email']  = $info['email']; 
 				$me['nickname'] = $info['nickname']; 
 		 
				$r = member_get_third_set_user($me,$this->oauth_id,$access_token);   
				
		 	 	flash('success',__('login success'));
				$this->redirect(return_url());
				
			} catch (OAuthException $e) {
				flash('error',__('login error'));
				$this->redirect(return_url());
			}
		}
	}
	
 

 
}
