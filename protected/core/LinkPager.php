<?php
 
namespace app\core; 

class LinkPager extends \yii\widgets\LinkPager
{
 	public function run()
	{	
		
		 if($this->pagination->getPageCount()<=1){
		 	return;
		 }
		 parent::run();
	}

}
 