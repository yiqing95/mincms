<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
use app\modules\oauth\libraries\oauth2\Provider\Douban;
/**
 * ## 豆瓣 
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class DoubanController extends OauthController
{ 
	public $type = 'douban'; 
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
	 	$url = Douban::url_authorize()."?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&response_type=code&shuo_basic_r,shuo_basic_w,douban_basic_common"; 
 		header("location:$url"); 
 		exit;
	}
	function actionReturn(){ 
		$code = $_GET['code']; 
 		$postdata = http_build_query(
		    array(
		        'grant_type' => 'authorization_code',
		        'client_id' =>$this->app_key,
		        'client_secret'=>$this->app_secret,
		        'redirect_uri'=>urlencode($this->url),
		        'code'=>$code
		        
		    )
		); 
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		); 
		$context  = stream_context_create($opts); 
		$data = file_get_contents(Douban::url_access_token(), false, $context);
		$data = json_decode($data); 
	 	$access_token = $data->access_token;  
		if ($access_token){
			try
	        {    	
	         	$this->auth =  OAuth2::provider($this->type, array(
			    	'id' =>$this->app_key, 
	       			'secret' => $this->app_secret, 
			    ));  
			    $token = Token::factory('access', array('access_token'=>$access_token)); 
			    $info = $this->auth->get_user_info($token); 
			    if(!$info){
			    	flash('error',__('login error'));
					$this->redirect(return_url());
					exit;
			    } 
				$r = $this->member_get_third_set_user($info,$this->oauth_id,$access_token);    
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
