<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title); ?></h1>
<?php foreach($models as $model) {?>
 
<p>
	<?php echo $model->username;?>
</p>
<?php }?> 
<div class='pagination'>
<?php $this->widget('app\core\LinkPager', array(
      'pages' => $pages,
  ));?>
</div>
