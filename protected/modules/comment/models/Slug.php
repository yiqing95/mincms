<?php namespace app\modules\comment\models; 
use yii\helpers\Html;
 
class Slug extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'comment_slug';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('name'),
		   
		 );
	}
	public function rules()
	{ 
		return array( 
			array('name','required'),
			array('name','unique')
		);
	} 
	function getComment_Form(){
		return Html::a($this->name,url('comment/site/index',array('form'=>$this->id)));
	}
	 
	 
}