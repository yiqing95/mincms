<?php 
use app\core\ActiveForm;
?>
<a href="<?php echo url('payment/admin/index');?>">通联支付测试</a>
<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
	<h5>取得邮件通讯录</h5>
	目前仅支持 163 126  Yeah Hotmail
	<hr>
	<br>
	<input name='email' type='text' placeholder='请输入email地址'>
	<br>
	<input name='password' type='password' placeholder="请输入密码，我们不会保存密码">
 
	<div style="clear:both;"></div>
 
	<button class="btn btn-info" type="submit" name="yt0"> <?php  echo $model->isNewRecord ? __('Create') : __('Save');?> </button>		  

<?php ActiveForm::end(); ?>

<?php if($users){?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody class="ui-sortable">
			<?php $i=0;foreach($users as $k=>$v){?>
				<tr class="<?php if($i++%2==0){ echo 'even';}else{ echo 'odd';}?>">
					<td><?php echo $k;?></td>
					<td><?php echo $v;?></td>
				</tr>
			<?php }?>
		</tbody>
	</table> 

<?php } ?>
	
	
