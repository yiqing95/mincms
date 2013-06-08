<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
use app\modules\oauth\libraries\oauth2\Provider\Taobao;
use app\core\Load;
use app\core\Arr;
/**
 * ## 支付宝 
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class AlipayController extends OauthController
{ 
	public $type = 'alipay'; 
	public $alipay_config;
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
        $files = array(
        	base_path().'modules/oauth/libraries/alipay/alipay_core.function.php',
        	base_path().'modules/oauth/libraries/alipay/alipay_md5.function.php',
        	base_path().'modules/oauth/libraries/alipay/alipay_notify.class.php',
        	base_path().'modules/oauth/libraries/alipay/alipay_submit.class.php',
        );
        Load::file($files);
		$alipay_config['partner']		= $this->app_key; 
		//安全检验码，以数字和字母组成的32位字符
		$alipay_config['key']			= $this->app_secret;   
		$alipay_config['sign_type']    = strtoupper('MD5'); 
		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= strtolower('utf-8'); 
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = base_path().'modules/oauth/libraries/alipay/cacert.pem'; 
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';
		$this->alipay_config = $alipay_config;
	}
 	public function actionIndex()
	{
	 	 //目标服务地址
        $target_service = "user.auth.quick.login";
        //必填
        //必填，页面跳转同步通知页面路径
        $return_url = urlencode($this->url);
        //需http://格式的完整路径，不允许加?id=123这类自定义参数 
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "alipay.auth.authorize",
				"partner" => trim($this->alipay_config['partner']),
				"target_service"	=> $target_service,
				"return_url"	=> $return_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
		);

		//建立请求
		$alipaySubmit = new \AlipaySubmit($this->alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "login");
		echo $html_text;
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
