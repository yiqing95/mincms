<?php if($rows){
foreach($rows as $row){?>
	<a target='_blank' href="<?php echo url('oauth/'.$row['slug'].'/index');?>">
		<?php if(true === $img){?>
			<img title="<?php echo $row['name'];?>" width="16" height="16" src="<?php echo base_url();?>img/<?php echo $row['slug'];?>.png" />
			
		<?php }else {?>
			<?php echo $row['name'];?>
		<?php }?>
	</a> 
<?php }}?>