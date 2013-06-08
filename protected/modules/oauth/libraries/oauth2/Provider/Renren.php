<?php namespace app\modules\oauth\libraries\oauth2\Provider; 
use app\modules\oauth\libraries\oauth2\Provider;
use app\modules\oauth\libraries\oauth2\Token\Access;
/**
 *  
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
 

class Renren extends Provider
{
	public function url_authorize()
	{
		return 'https://graph.renren.com/oauth/authorize';
	}

	public function url_access_token()
	{
		return 'https://graph.renren.com/oauth/token';
	}
	public function url_access()
	{
		return 'https://api.renren.com/v2/user';
	}
	
	

	 
}