<?php 
namespace app\modules\emailcontact\libraries;
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq官方群: 40933125>
 * @Coprighty  http://mincms.com
 */
class GetMail{
	public $cookie;
	public $header;
	public $curl;
	function __construct(){
		$this->cookie = root_path().'assets/cookie.txt'; 
		$this->header = array(		 
			'User-Agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9) Gecko/2008052906 Firefox/3.0',  
		);
		Yii::import('application.vendor.simple_html_dom',true);//加载dom解析类
	}
	function post($url,$post=null,$opts=null){
		//post 传string
		if($post)
			$post = array_to_string($post); 
		$this->curl = Curl::post($url, $post); 
		$options = array(
			CURLOPT_SSL_VERIFYPEER 	=>	false,
			CURLOPT_RETURNTRANSFER	=>	true, 
			CURLOPT_COOKIEFILE		=>  $this->cookie,
		    CURLOPT_COOKIEJAR		=>	$this->cookie, 	
		    CURLOPT_HTTPHEADER		=>	$this->header,
		    CURLOPT_CONNECTTIMEOUT	=>	100, 
		); 
		if($opts){
			$options = array_merge($options,$opts);
		}
		$this->curl->option($options);
		$r = $this->curl->call(); 
		return $r->raw_body;
	}
	 
	function get($url,$get=array()){ 
		$curl = Curl::get($url, $get); 
		$curl->option(array(
			CURLOPT_COOKIESESSION	=>	true,
			CURLOPT_RETURNTRANSFER	=>	true,  
		    CURLOPT_COOKIEJAR		=>	$this->cookie, 	
		    CURLOPT_HTTPHEADER		=>	$this->header,
		    CURLOPT_CONNECTTIMEOUT	=>	100, 
		));
		$r = $curl->call(); 
		return $r->raw_body;
	}
	/**
	* 数据转成字符
	*/
	static function array_to_string($data){
		return  (is_array($data) ? http_build_query($data) : $data);
	}
	/**
	* http://w39.mail.qq.com/cgi-bin/today?autogo=yes&sid=YomBOBSNjYIVFBBA73jT6vN8,9,zFey3iDxu&first=1&mcookie=disabled&bmkey=AU0CllmDF58YsqYQCwmDSVZo
	* url 参数转成数据
	*/
	static function params($url){	 
		 if(false !== strpos($url,'?')){
		 	if(false !== strpos($url,'https://')){
		 		$h = 'https://';
		 		$u = str_replace("https://",'',$url);
		 	}else{
		 		$u = str_replace("http://",'',$url);
		 		$h = 'http://';
		 	}
		 	$out['localhost'] = $h.substr($u,0,strpos($u,'/'));
		 	$url = substr($url,strpos($url,'?')+1); 
		 }
		 $arr = explode('&',$url);
		 foreach($arr as $r){
		 	$rs = explode('=',$r);		  
		 	$out[$rs[0]] = $rs[1];
		 } 
		 return $out;		 
	}
}