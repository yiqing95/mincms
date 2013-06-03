<?php 
namespace app\modules\emailcontact\libraries;
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq官方群: 40933125>
 * @Coprighty  http://mincms.com
 */
  
class GetMail163{ 
	static function get($user,$password){ 
		$mail = new GetMail;
		$url = 'http://reg.163.com/logins.jsp'; 		
		$post = array(
 			"username"=>$user,
			"password"=>$password, 
			'verifycookie'=>1, 
			'style'=>-1, 
			'product'=> 'mail163', 
			'selType'=>-1, 
			'secure'=>'on' 
		);
	 	$body = $mail->post($url,$post);
	 
		$url = "https://ssl.mail.163.com/entry/coremail/fcg/ntesdoor2?df=webmail163&from=web&funcid=loginone&iframe=1&language=-1&net=t&passtype=1&product=mail163&race=178_37_247_gz&style=-1&uid=".$user."@163.com";
		$body = $mail->post($url,$post);
		preg_match_all("/sid=(.*)/i",$body,$out); 
		$sid = $out[1][0]; 
		$sid = substr($sid,0,32); 
	
 		//通讯录地址
		$url="http://g4a30.mail.163.com/jy3/address/addrlist.jsp?sid=".$sid."&gid=all" ;          
		      
		$body = $mail->post($url,array());
		$body = iconv('gb2312','utf-8',$body); 
		
		$html = str_get_html($body);  
		$table = $html->find('table[class=Ibx_gTable Ibx_gTable_Con] tr'); 
		foreach($table as $tr){
			$name = $tr->find('td[class=Ibx_Td_addrName]',0)->plaintext;
			$email = $tr->find('td[class=Ibx_Td_addrEmail]',0)->plaintext;
			$output[$name] = $email; 
		}
		return $output;
		
	} 
		
	 
 
	
	
}