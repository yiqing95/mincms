<form method='get' id='i18nForm' action="<?php echo \Yii::$app->request->getUrl();?>">	 
				<?php 
				unset($_GET['language']);
				if($_GET){ 
					foreach($_GET as $k=>$v){
						echo "<input type='hidden' name='".$k."' value='".$v."' >";
					}
				}
				?>
				<select id='i18n' name='language' class="pull-right " style='width:100px;'>
		      	  <?php $i18n = array(
		      		'zh_cn'=>'简体中文',
		      	  	'en_US'=>'US',
		      		
		      		);
		      		foreach($i18n as $k=>$v){
		      		?>
		      	   <option value="<?php echo $k;?>" <?php if(language() == $k ){?> selected <?php }?>> <?php echo __($v);?></option>
		      	  <?php }?>
		      </select>
	      	
       
  </form>