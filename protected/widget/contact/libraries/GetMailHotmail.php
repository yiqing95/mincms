<?php app\modules\emailcontact\libraries;
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq官方群: 40933125>
 * @Coprighty  http://mincms.com
 */
  
class GetMailHotmail{ 
	static function get($user,$password){ 
		include dirname(__FILE__).'/Msn_Contact_Grab.php';
		$msn = new msn;
		$emails = $msn->qGrab($user, $password);
		if(!$emails) return; 
		foreach($emails as $v){
			$output[$v[0]] = $v[1];
		} 
		return $output;
		
	} 
		
	 
 
	
	
}