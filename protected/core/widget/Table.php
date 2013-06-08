<?php namespace app\core\widget;  
/**
*  render tables
* 
* @author Sun < mincms@outlook.com >
*/
class Table extends \yii\base\Widget
{ 
	public $models;
	public $fields;
	public $pages;
	public $update=true;
	public $delete=true;
	public $create=true;
	public $update_url = 'update';
	public $delete_url = 'delete';
	public $content = 'do you want to do this';
	public $title = 'remove?';
	function run(){   
	 	echo $this->render('@app/core/widget/views/table',array(
	 		'models'=>$this->models,
	 		'fields'=>$this->fields,
	 		'pages'=>$this->pages,
	 		'update'=>$this->update,
	 		'delete'=>$this->delete,
	 		'create'=>$this->create,
	 		'update_url'=>$this->update_url,
	 		'delete_url'=>$this->delete_url,
	 		'content'=>__($this->content),
	 		'title'=>__($this->title),
	 	));
	}
}