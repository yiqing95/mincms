<?php namespace app\modules\image\models; 

 
class Image extends \app\core\ActiveRecord 
{
 
 	public $type;
	public static function tableName()
    {
        return 'image';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('slug','description','memo'), 
		 );
	}
	public function rules()
	{ 
		return array(
			array('slug', 'required'),  
		);
	} 
 
	 
	 
}