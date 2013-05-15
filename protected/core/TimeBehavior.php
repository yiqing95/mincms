<?php
namespace app\components;
class TimeBehavior extends \yii\base\Behavior{
	public $createAttribute = 'created';
	public $updateAttribute = 'updated';
	public function events()
	{
		return array(
			'beforeSave'=>'setTime',
		);
	}

	public function setTime($event) {
		echo 1;exit;
		if ($this->owner->isNewRecord() && ($this->createAttribute !== null)) {
			$this->owner->{$this->createAttribute} = time();
		} 
		$this->owner->{$this->updateAttribute} = time(); 
	}
	
}