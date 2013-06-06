<?php
use app\modules\comment\Classes;
use app\modules\member\Auth;	
?>
<div class="<?php echo $formId;?>">
	<?php foreach($rows->models as $model){?>
		 
		<p><?php echo Classes::get_body($model['body_id']);?></p>
    	<div>
    		<span class="label">
    		<?php $o = Auth::get_member($model['mid']);
    			echo $o->name;
    		?>
    		</span>
        
        	<div class="pull-right"> 
		         <span class="badge badge-success"><?php echo __('commented');?>: <?php echo date('Y-m-d H:i',$model['created']);?></span>
		        	
		      </div>
		 </div> 
    <hr>
    		
	<?php }?>
	
	<div class='pagination'>
		<?php  echo \app\core\LinkPager::widget(array(
	      'pagination' => $rows->pages
	  ));?>
	</div>
</div> 