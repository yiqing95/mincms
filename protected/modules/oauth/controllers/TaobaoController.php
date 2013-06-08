<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
use app\modules\oauth\libraries\oauth2\Provider\Taobao;
use app\core\Load;
use app\core\Arr;
/**
 * ## 淘宝 
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class TaobaoController extends OauthController
{ 
	public $type = 'taobao'; 
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
		
	}
 	public function actionIndex()
	{
	 	$code_url = Taobao::url_authorize()."?response_type=code&client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&scope=user,repo,gist"; 
 		header("location:$code_url"); 
 		exit;
	}
	function actionReturn($code){  
		 
		$postdata = array(
			'client_id'=>$this->app_key,
			'redirect_uri'=>urlencode($this->url),
			'client_secret'=>$this->app_secret,
			'code'=>$_GET['code'],
			'grant_type'=>'authorization_code'
		);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => Arr::query($postdata)
		    )
		);   
		$data = json_decode(Load::url(Taobao::url_access_token(),$opts));
		
		$access_token = $data->access_token; 
		if ($access_token){
			try
	        {           
 				$me['id'] = $data->taobao_user_id;
 				$me['name'] = $data->taobao_user_nick;  
				$r = $this->member_get_third_set_user($me,$this->oauth_id,$access_token);   
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
