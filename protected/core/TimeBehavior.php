<?php
namespace app\core;
/**
 * ~~~
 * public function behaviors()
 * {
 *     return array(
 *         'timestamp' => array(
 *             'class' => 'app\core\TimeBehavior',
 *         ),
 *     );
 * }
 * ~~~
*/
class TimeBehavior extends \yii\base\Behavior{
	public $createAttribute = 'created';
	public $updateAttribute = 'updated';
	public function events()
	{
		return array(
			ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
		);
	} 
	public function beforeInsert($event) {
		if ($this->createAttribute !== null) {
			$this->owner->{$this->createAttribute} = time(); 
		} 
	}
	public function beforeUpdate()
	{
		if ($this->updateAttribute !== null) {
			$this->owner->{$this->updateAttribute} = time(); 
		}
	}
	
}