<?php namespace app\modules\auth\models; 

 
class Access extends \app\core\ActiveRecord 
{
 
	public $old_pid;
	public static function tableName()
    {
        return 'auth_access';
    } 
    /**
    *
    */
    static function generate($data){
    	foreach($data as $name=>$values){
			$model = static::find(array('name'=>$name,'pid'=>0));
			if(!$model){
				$model = new self;
				$model->name = $name;
				$model->pid = 0;
				$model->save();
			}
			$id = $model->id;
			foreach($values as $v=>$op){
				$model = static::find(array('name'=>$v,'pid'=>$id));
				if(!$model){
					$model = new self;
					$model->name = $v;
					$model->pid = $id;
					$model->save();
				}
			}
		}
    }
	public function rules()
	{ 
		return array(
			array('name, pid', 'required'),	
		);
	}   
	 
}