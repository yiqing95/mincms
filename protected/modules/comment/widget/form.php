<?php namespace app\modules\comment\widget;  
use app\core\DB;
use app\modules\comment\Classes;
/**
* 
* @author Sun < taichiquan@outlook.com >
*/
class Form extends \yii\base\Widget
{ 
 	public $slug;
 	public $display = 1; //是否默认显示，1为显示
 	public $top = false;//是否在顶端显示分页
	function run(){ 
		if(!$this->slug) {
			return __('render commnet form failed,slug should be set');
		} 
		$formId = 'comment'.md5(uniqid(microtime()));
		$infoMessage = "info".md5($formId);
		if(is_ajax()){
			$body = trim($_POST['Comment']['body']);
			$messge = Classes::comment($this->slug,$body,$this->display);
		 	echo "##ajax-form-alert##:".$messge;
			exit;
		} 	 
		echo $this->render('@app/modules/comment/widget/views/form',array(
			'top'=>$this->top,
			'slug'=>$this->slug,
			'infoMessage'=>$infoMessage,
			'formId'=>$formId
		));
	 
	}
}