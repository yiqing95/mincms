<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab"><?php echo __('modules');?></a></li>
  <li><a href="#sort" data-toggle="tab"><?php echo __('sort');?></a></li>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="home">
    <?php echo $this->render('home',array('data'=>$data,'_core_modules'=>$_core_modules));?> 
  </div>
  <div class="tab-pane" id="sort" style="overflow: hidden;">
  	  <?php echo $this->render('sort',array('models'=>$models));?> 
  </div> 
</div> 