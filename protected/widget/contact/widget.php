<?php namespace app\widget\contact;  
/**
*  
* @author Sun < mincms@outlook.com >
*/
class Widget extends \yii\base\Widget
{  
 	public $tag;
 	public $options;  
  
	function run(){  
	 	$data = array();
		if($_POST){
	    	$email = $_POST['email'];
	    	$password = $_POST['password'];
	    	$at = 163;
	    	//根据输入的URL判断需要调用的类
	    	if(false !== strpos($email,'@')){
	    		list($name, $domain) = explode('@', $email);
	    		$at = substr($domain,0,strrpos($domain,'.'));
	    		$at = ucfirst($at);
	    	  
	    	} 
	     	$c = '\app\modules\emailcontact\libraries\GetMail';
	    	$class = $c.$at;
			$data['users'] = $class::get($email,$password);
			 
		}
		echo $this->render('@app/widget/contact/views/index',$data);
 	 
	}
}