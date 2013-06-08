<?php namespace app\modules\comment\widget;  
use app\core\DB;
use app\modules\comment\Classes;
/**
* 
* @author Sun < mincms@outlook.com >
*/
class pagination extends \yii\base\Widget
{ 
 	public $slug;
 	public $formId;
 	public $display = 1;
	function run(){ 
		$this->formId = 'pagination.'.$this->formId;
		$rows = DB::pagination('comment',array(
			'where'=>array('slug_id'=>Classes::one($this->slug),'display'=>$this->display),
			'orderBy'=>'sort desc,id desc'
		),'comment/ajax/index');
		echo $this->render('@app/modules/comment/widget/views/pagination',array(
			'rows'=>$rows,
			'formId'=>$this->formId,
		));
	 
	}
}