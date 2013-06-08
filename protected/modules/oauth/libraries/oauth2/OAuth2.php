<?php namespace app\modules\oauth\libraries\oauth2; 
use  app\modules\oauth\libraries\oauth2\Provider;
 

/**
 * OAuth2.0
 *
 * @author Phil Sturgeon < @philsturgeon >
 */
class OAuth2 {

	/**
	 * Create a new provider.
	 *
	 *     // Load the Twitter provider
	 *     $provider = $this->oauth2->provider('twitter');
	 *
	 * @param   string   provider name
	 * @param   array    provider options
	 * @return  OAuth_Provider
	 */
	public static function provider($name, array $options = NULL)
	{
		$name = ucfirst(strtolower($name));
 
		$class = '\app\modules\oauth\libraries\oauth2\Provider\\'.$name;

		return new $class($options);
	}

}