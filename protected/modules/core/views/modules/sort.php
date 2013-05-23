<blockquote> 
	<?php echo __('drag sort');?>
</blockquote>
<div class='drag' style='margin-top:10px;'>
<?php 
$a = array(
		' btn-info','btn-success','btn-warning','btn-danger','btn-inverse',''
	);	
$i=1;foreach($models as $model){?>
	<span class="btn btn-large <?php  //$a[array_rand($a,1)];?>">
		<?php echo $model->ids;?>
	</span>
	<?php if($i++%10==0) echo '<p></p>';?>
<?php }?>
</div>
 