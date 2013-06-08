
<?php
js("
$(function(){
	var url = $.url(); 
	var  access_token = url.fparam('access_token'); 
	window.location.href = '".url('oauth/wy/next')."?access_token='+access_token;
});
"); 
js_file(base_url().'js/jquery.url.js');
?>
 