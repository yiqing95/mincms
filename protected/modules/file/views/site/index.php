<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->params['breadcrumbs'][] =  array('label'=>__('file'),'url'=>url('file/site/index')); 
$this->params['breadcrumbs'][] = __('upload');
?>



 








<?php echo widget('plupload');?> 