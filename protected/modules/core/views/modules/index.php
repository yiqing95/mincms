<blockquote>
	<h3>
		<?php echo __('modules');?>  
		 
	</h3>
</blockquote>
<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td><?php echo __('name'); ?></td> 
	<td><?php echo __('install'); ?></td> 
  </tr>
  <?php  
  foreach($data as $post){  
  ?>
  <tr>
	<td><blockquote><?php echo $post['name']; ?>  [<?php echo $post['info']['memo']; ?>]
	  <small><?php echo $post['path']; ?></small>
	  </blockquote></td>
  
	<td  class="<?php echo 'show_'.$post['name'];?>"> 
		<?php if($post['default']==true || in_array($post['name'],$_core_modules)){?>
			<span class='label label-info'><?php echo __('core module');?></span>
		<?php }else{?>
			<?php if($post['active'] == 1){?>  
				<span class="label label-success">
					<a class='ajax_add'  url="<?php echo url('core/modules/install',array(
					'id'=>$post['name'].'.uninstall'));?>" rel=1 id="<?php echo $post['name'];?>"><i class="icon-trash icon-white"></i></a> </span>
			<?php }else{?>
			<a class='ajax_add' id="<?php echo $post['name'];?>" url="<?php echo url('core/modules/install',array('id'=>$post['name'].'.install'));?>"><i class="icon-plus"></i></a>
			<?php }?>
		<?php }?>
	</td>
   
  </tr>
   
  
  <?php } ?>
</table> 


<div class='ajax_ok top_fixed hide'>
	<img src="<?php echo base_url().'img/ajax-loader.gif';?>" />
</div>
<div class="ajax_error alert alert-error top_fixed animate hide">
	<?php echo __('error happend');?>
</div>
<?php 
//core_script('jquery-ui');
js(" 
	$('.ajax_add').click(function(){
		var obj = this;
		var id = $(this).attr('id');
		var r = $(this).attr('rel');
		var url = $(this).attr('url');
		var j = '.show_'+id;
		$('.ajax_ok').fadeIn();
		var html = '<i class=\"icon-remove\"></i>';
		if(r==1){
			html = '<a class=\"ajax_add\" id=\"+id+\"><i class=\"icon-plus\"></i></a>';
		}
		$.post('".url('core/modules/add')."', { id: id ,YII_CSRF_TOKEN:'".Yii::$app->request->csrfToken."'},
		function(data) { 
			 if(data==1){
			 	$(j).html(html);
			 	$('.ajax_ok').fadeOut();  
			 	$.get('".url('core/modules/index')."',
				function(data){ 
				 	$('body').html(data);  
				 	$('body').animate({scrollTop: $('body').offset().top}, 1000);
				});  
			 	if(url){ 
			 		$.get(url,function(data){
			 			 
			 		});
			 	}
			 	
			 }
			 else{ 
			   $('.ajax_error').fadeIn();
			   $('.ajax_ok').fadeOut();
			   $('.ajax_error').fadeOut();
			 }
  		 });
  		 $('.ajax_ok').fadeOut();
		return false;
	});
	
");	
?>
