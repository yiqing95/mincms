<?php namespace app\modules\comment\widget;  
use app\core\DB;
/**
* 
* @author Sun < taichiquan@outlook.com >
*/
class pagination extends \yii\base\Widget
{ 
 	public $slug;
 	public $formId;
 	public $display = 1;
	function run(){ 
		$this->formId = 'pagination.'.$this->formId;
		$rows = DB::pagination('comment',array(
			'where'=>array('slug_id'=>1,'display'=>$this->display),
			'orderBy'=>'sort desc,id desc'
		),'comment/ajax/index');
		echo $this->render('@app/modules/comment/widget/views/pagination',array(
			'rows'=>$rows,
			'formId'=>$this->formId,
		));
	 
	}
}