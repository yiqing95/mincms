<?php app\modules\emailcontact\libraries;
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq官方群: 40933125>
 * @Coprighty  http://mincms.com
 */
  
class GetMailYeah{ 
	static function get($user,$password){ 
		$mail = new GetMail;
		$url = 'https://reg.163.com/logins.jsp?type=1&product=mailyeah&url=http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1'; 		
		$post = array(
 			"username"=>$user,
			"password"=>$password,  
		);
	 	$body = $mail->post($url,$post);
	  
		$url = "https://ssl.mail.yeah.net/entry/cgi/ntesdoor?funcid=loginone&language=-1&passtype=1&iframe=1&product=mailyeah&from=web&df=emailyeah&race=149_46_37_bj&module=&uid=$usert&style=-1&net=t&skinid=null";
		$body = $mail->post($url,$post);
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