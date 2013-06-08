<?php namespace app\widget\translate;  
/**
* 
* @author Sun < mincms@outlook.com >
*/
class Widget extends \yii\base\Widget
{  
 	public $words;
 	public $type = 'youdao';
 	public $key;
 	public $key2;
	function run(){  
		 return $this->$type();
	}
	function youdao(){
		$content = $this->words;
		$keyfrom = $params['key']?:'wjqtaichi';
		$key= $params['key2']?:'338075910'
		$content = urlencode(trim($content));	 
		$url = "http://fanyi.youdao.com/openapi.do?keyfrom=$keyfrom&key=$key&type=data&doctype=json&version=1.1&q=$content"; 
 		$response = json_decode(file_get_contents($url));
 		return $response->translation[0];
	}
}