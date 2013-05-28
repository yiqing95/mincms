<?php namespace app\core;  
/** 
*  controller public $theme; change theme
'view' => array(
    'class' => 'app\core\View',
    'theme' => array(
    	'class' => 'app\core\Theme',  
        'baseUrl' => '@www/themes/'.$theme,
    ),
    'renderers' => array( 
        'twig' => array(
            'class' => 'yii\renderers\TwigViewRenderer',
            'cachePath' => '@wwwroot/assets/runtime/Twig/cache',
        ), 
    ),
),
* @author Sun < taichiquan@outlook.com >
*/
class View extends \yii\base\View
{ 
	public function renderFile($viewFile, $params = array(), $context = null)
	{
		$viewFile = \Yii::getAlias($viewFile);
		if ($this->theme !== null) {
			$viewFile = $this->theme->applyTo($viewFile);
		}
		if (is_file($viewFile)) {  
			$viewFile = \yii\helpers\FileHelper::localize($viewFile);
		} else {
			throw new \yii\base\InvalidParamException("The view file does not exist: $viewFile");
		}
	 

		$oldContext = $this->context;
		if ($context !== null) {
			$this->context = $context;
		}

		$output = '';
		if ($this->beforeRender($viewFile)) {
			$ext = pathinfo($viewFile, PATHINFO_EXTENSION);
			if (isset($this->renderers[$ext])) {
				if (is_array($this->renderers[$ext])) {
					$this->renderers[$ext] = Yii::createObject($this->renderers[$ext]);
				}
				/** @var ViewRenderer $renderer */
				$renderer = $this->renderers[$ext];
				$output = $renderer->render($this, $viewFile, $params);
			} else {
				$output = $this->renderPhpFile($viewFile, $params);
			}
			$this->afterRender($viewFile, $output);
		}

		$this->context = $oldContext;

		return $output;
	}

}