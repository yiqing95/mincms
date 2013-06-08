<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
use app\modules\oauth\libraries\oauth2\Provider\Wy;
use app\core\Load;
use app\core\Arr;
/**
 * ## 网易
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class WyController extends OauthController
{ 
	public $type = 'wy'; 
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
	 	$code_url = Wy::url_authorize()."?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&response_type=token";
 		header("location:$code_url"); 
 		exit;
	}
	function actionReturn(){ 
		echo $this->render('index'); 
	}
	
	function actionNext(){
	 	$access_token = $_GET['access_token'];
		$url = "https://api.t.163.com/users/show.json?oauth_token=".$access_token;
	 	$data = json_decode(file_get_contents($url)); 
	 	
		try
        {        
			$me['id'] = $data->status->id;
			$me['name'] = $data->name; 
			$me['email']  = $data->email;   
			$r = $this->member_get_third_set_user($me,$this->oauth_id,$access_token);   
			
	 	 	flash('success',__('login success'));
			$this->redirect(return_url());
			
		} catch (OAuthException $e) {
			flash('error',__('login error'));
			$this->redirect(return_url());
		}
	 
	 
	}
	 

 
}
