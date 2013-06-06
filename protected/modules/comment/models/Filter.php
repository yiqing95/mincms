<?php namespace app\modules\comment\models; 

 
class Filter extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'comment_filter';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('name','replace'),
		   
		 );
	}
	public function rules()
	{ 
		return array( 
			array('name','unique')
		);
	} 
	 
	 
	 
}