<?php 
/**
 * MinCMS - An open source content manage base on YiiFramework 1.1.x 
 *
 * @author Sun < mincms@outlook.com >
 */
class ShortHelper{

	static function sina($long_url,$apiKey='4125962702'){
		 if($apiKey) $apiKey = 'source='.$apiKey;
		 $apiUrl='http://api.t.sina.com.cn/short_url/shorten.json?'.$apiKey.'&url_long='.$long_url;
		 $curlObj = curl_init();
		 curl_setopt($curlObj, CURLOPT_URL, $apiUrl);
		 curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		 curl_setopt($curlObj, CURLOPT_HEADER, 0);
		 curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		 $response = curl_exec($curlObj);
		 curl_close($curlObj); 
		 $json = json_decode($response);
		 return $json[0]->url_short;
	}

	static function google($long_url,$apiKey=null){
		 //Get API key from : http://code.google.com/apis/console/
		 if($apiKey)
		 	$postData = array('longUrl' => $long_url, 'key' => $apiKey); 
		 else
		 	$postData = array('longUrl' => $long_url);
		 $jsonData = json_encode($postData);
		 $curlObj = curl_init();
		 curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
		 curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		 curl_setopt($curlObj, CURLOPT_HEADER, 0);
		 curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		 curl_setopt($curlObj, CURLOPT_POST, 1);
		 curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
		 $response = curl_exec($curlObj);
		 $http_code = curl_getinfo($curlObj, CURLINFO_HTTP_CODE);
		 if ($http_code >= 400) {
		 	return '400';
		 }
		 curl_close($curlObj);
		 $json = json_decode($response);
		 return $json->id;
	}
	static function google_login($short_url){
		 $curlObj = curl_init();
		 curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?shortUrl='.$short_url);
		 curl_setopt($curlObj, CURLOPT_HEADER, 0);
		 curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		 $response = curl_exec($curlObj);
		 if ($http_code >= 400) {
		 	return '400';
		 }
		 curl_close($curlObj);
		 $json = json_decode($response);
		 return $json->longUrl;
	}

}