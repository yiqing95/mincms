<?php app\modules\emailcontact\libraries;
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq官方群: 40933125>
 * @Coprighty  http://mincms.com
 */
class GetMailQq{
	
	static function get($user,$password){	 
		$mail = new GetMail;
		$url = 'http://w39.mail.qq.com/cgi-bin/login'; 		
		$post = array(
			'f' => 'xhtmlmp',
            'tfcont' => '',
            'uin' => $user,
            'aliastype' => '@qq.com',
            'pwd' => $password,
            'mss' => '1'
       	);
	 	$body = $mail->post($url,$post);
		preg_match("/url=(http:\/\/.*?)\"/", $body, $out);
		$url = $out[1];
		//解决URL
		$arr = GetMail::params($url);
		$sid = $arr['sid'];
		$host = $arr['localhost'];
		$url = $host."/cgi-bin/addr_listall?sid=".$sid."&flag=star&s=search&folderid=all&pagesize=10&from=today&fun=slock&page=0&topmails=0&t=addr_listall&loc=today,,,158'";
 		$body = $mail->get($url);
		$html = str_get_html($body); 
		foreach($html->find("a") as $v){  
            $o = $v->innertext;
            if(false === strpos($o,'返回')){
            	echo $o; exit;
            }
        }
	 
	 
	}
}