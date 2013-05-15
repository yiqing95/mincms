<?php namespace app\core;  
use yii\base\Theme;
/**
*  default controller
* 
* @author Sun < taichiquan@outlook.com >
*/
class Controller extends \yii\web\Controller
{ 
	  
	 function init(){
	 	parent::init();  
	 	language(); 
	 	 
	 }
}