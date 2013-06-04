<?php namespace app\modules\oauth\libraries\oauth2\Provider; 
use app\modules\oauth\libraries\oauth2\Provider;
use app\modules\oauth\libraries\oauth2\Token\Access;
/**
 * GitHub OAuth2 Provider
 *
 * @package    FuelPHP/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

 

class Qq extends Provider
{
	public function url_authorize()
	{
		return 'https://graph.qq.com/oauth2.0/authorize';
	}

	public function url_access_token()
	{
		return 'https://graph.qq.com/oauth2.0/token';
	}
	
	

	public function get_user_info($access_token)
	{
		$url = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token;  
		$sContent = file_get_contents($url);
		preg_match('/callback\(\s+(.*?)\s+\)/i', $sContent,$aTemp);	
		$aResult = json_decode($aTemp[1],true);
		$openid =  $aResult["openid"];
		$url = "https://graph.qq.com/user/get_user_info?";
		$url .="access_token=".$access_token;
		$url .="&oauth_consumer_key=".$this->client_id;
		$url .="&openid=".$openid;
		$url .="&format=json";  
		$sContent = file_get_contents($url); 
		if($sContent!==FALSE){
			$aResult = json_decode($sContent,true); 
			if($aResult["ret"]==0){
				$users = $aResult;
				$users['uid'] = $openid;
				return $users;
 				exit;
			}else{
				exit('login error');
				exit;
			}
		}else{
			echo "<script>alert('获取用户信息失败。');location.href='../index.php';</script>";
			exit;
		}
		
		 
		
	}
}