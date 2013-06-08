<?php namespace app\modules\oauth\libraries\oauth2\Provider; 
use app\modules\oauth\libraries\oauth2\Provider;
use app\modules\oauth\libraries\oauth2\Token\Access;
/**
 * Эјвз
 *  
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
 

class Wy extends Provider
{
	/**
	 * @var  string  scope separator, most use "," but some like Google are spaces
	 */
	public $scope_seperator = '+';

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';

	public function url_authorize()
	{
		return 'https://api.t.163.com/oauth2/authorize';
	}

	public function url_access_token()
	{
		return 'https://api.t.163.com/oauth2/access_token';
	}

	public function get_user_info(Access $token)
	{
		$user = $token->user;
	
		return array(
			'uid' => $user->id,
			'nickname' => $user->username,
			'name' => $user->full_name,
			'image' => $user->profile_picture,
			'urls' => array(
			  'website' => $user->website,
			),
		);
	}
}