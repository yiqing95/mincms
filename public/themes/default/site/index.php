<?php css(".m{float:left;margin-right:5px;}");?>
<div class="jumbotron">
        <h1>MINCMS on Yii 2</h1>
        <p class="lead">VERY POWERFUL CONTENT MANAGE SYSTEM</p>
        <a class="btn btn-large btn-success" href="#">Developing...</a>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Modules</h4>
          <p>Many modules support <br> 
          <label class='label m' title="用户权限" >auth</label> 
          <label class='label m' title="会员">member</label>
          <label class='label m' title="第三方登录">oauth</label>
          <label class='label m' title="皮肤管理">theme</label>
          <label class='label m' title="多语言">i18n</label>
          <label class='label m' title="购物车">cart</label>
          <label class='label m' title="支付">payment</label>
          <label class='label m' title="自定义内容">content</label> 
         <label class='label m' title="">...</label></p>
	<br style='clear:both;'>
		  <h4>Widget</h4>
          <p>Many usefull widgets such as<br>
          	<label class='label m' title="图表">highcharts</label>
          	<label class='label m' title="文本编辑器">ckeditor</label>
          	<label class='label m' title="文本编辑器">redactor</label>
          	<label class='label m' title="Select效果">select2</label>  	  
          <label class='label m' title="">...</label></p>
 
          </p>
          <h4>Custom Content Module</h4>
          <p>content module can easy create any kinds of node. like Drupal Content Construction Kit (CCK)</p>
        </div>

        <div class="span6">
          <h4>Composer</h4>
          <p>Manage packages use <a href="http://getcomposer.org/" target='_blank'>Composer</a>
           <br>
             when install packages
           <code>php composer.phar install</code> <br>
           when update packages
            <code>php composer.phar update</code> 
           </p>

          <h4>Yii 2</h4>
          <p>We use very good php 5.3 framework <a href="https://github.com/yiisoft/yii2" target="_blank">Yii 2</a> <br>
           
          </p> 
          <h4>BoosTrap</h4>
          <p>Default theme use <a href="http://twitter.github.io/bootstrap/" target="_blank">Twitter BoosTrap</a></p>

          
        </div>
      </div>
     
     
     View default <label class='label label-info ' id="composer" >composer.json</label><br>
     <pre class="prettyprint lang-js composer-show" style="display:none;">
     	 { 
	"require": {
		"php": ">=5.3.0",
		"yiisoft/yii2": "dev-master",
		"yiisoft/yii2-composer": "dev-master",
		"michelf/php-markdown":"1.3.x-dev",
		"swiftmailer/swiftmailer": "5.0.*",
		"imagine/Imagine":"dev-master"
	},
        "autoload": {
	        "classmap": [
	            
	        ],
	    	"files": [
	            "protected/core/helpers.php"
	    	],
	        "psr-0": {
	            "Michelf": "" ,
		    "Imagine": "lib/"
	        }
	 }, 
	"extra": {
		"writable": [
			"runtime",
			"public/assets"
		] 
	}
}
 
	 </pre>
<?php 
 js("
	 $('#composer').click(function(){  
	 	if($('.composer-show').css('display')=='block'){
	 		$('.composer-show').hide();
	 	}else{
	 		$('.composer-show').show();
	 	}
	 });
 ");	
?>	