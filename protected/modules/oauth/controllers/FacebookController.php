<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
/**
 * ## Facebook 
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class FacebookController extends OauthController
{
 
	public $type = 'facebook';
 
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
		
	}
 	public function actionIndex()
	{
		$code_url = "https://www.facebook.com/dialog/oauth?client_id=".$this->app_key." &redirect_uri=".urlencode($this->url)."   &response_type=token";
		header("location:$code_url"); 
	}
	
	function actionReturn(){     
        echo $this->render('index');
	}
	function actionNext(){
		if ($access_token = $_GET['access_token']){
			try
	        {    
	        	$this->auth =  OAuth2::provider($this->type, array(
			    	'id' =>$this->app_key, 
	       			'secret' => $this->app_secret, 
			    )); 	          
			    $token = Token::factory('access', array('access_token'=>$access_token)); 
	            $info = $this->auth->get_user_info($token); 	          
 				$uid = $info['uid']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['name']; 
 				$me['email']  = $info['email']; 
 				$me['nickname'] = $info['nickname']; 
 				$me['options'] = $info['urls']; 
 		 	 
				$r = $this->member_get_third_set_user($me,$this->oauth_id,$access_token);   
				
		 	 	flash('success',__('login success'));
				$this->redirect(return_url());
				
			} catch (OAuthException $e) {
				flash('error',__('login error'));
				$this->redirect(return_url());
			}
		}
	}
	
 

 
}
