<?php app\modules\emailcontact\libraries;
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq官方群: 40933125>
 * @Coprighty  http://mincms.com
 */
  
class GetMailSina{ 
	static function get($user,$password){ 
		$mail = new GetMail;
		$url = 'https://login.sina.com.cn/sso/login.php'; 		
		$post = array(
 			"username"=>$user,
			"password"=>$password,
			'entry' => 'freemail',
            'gateway' => 0,
            'encoding' => 'UTF-8',
            'url' => 'http://mail.sina.com.cn/',
            'returntype' => 'META',  
		);
		$opts = array(CURLOPT_FOLLOWLOCATION=>true);
	 	$body = $mail->post($url,$post,$opts);
	  	preg_match("/replace\(\"(.*?)\"\)\;/", $body, $out);
        $url = $out[1];  
		$body = $mail->post($url,$post,$opts);
		//$body = iconv('gb2312','utf-8',$body);  
		$url = "http://mail.sina.com.cn/cgi-bin/login.php";
		$body = $mail->post($url,$post,$opts);
		
		preg_match_all("/sid=(.*)/i",$body,$out); 
		
		$sid = $out[1][0]; 
		$sid = substr($sid,0,32);  
			 
 		//通讯录地址
		$url="http://g1a8.mail.yeah.net/jy3/address/addrlist.jsp?sid=".$sid."&gid=all" ;          
		      
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