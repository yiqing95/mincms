<blockquote>
	<h3>
		<?php echo $this->title; ?> 
	</h3>
</blockquote>
<?php use app\modules\content\models\FormBuilder;
$form = new FormBuilder('post');
$form->run();
?>

