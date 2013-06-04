<?php namespace app\modules\oauth\libraries\oauth2\Provider; 
use app\modules\oauth\libraries\oauth2\Provider;
use app\modules\oauth\libraries\oauth2\Token\Access;
/**
 * Instagram OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class Instagram extends Provider
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
		return 'https://api.instagram.com/oauth/authorize';
	}

	public function url_access_token()
	{
		return 'https://api.instagram.com/oauth/access_token';
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