<?php
core_script('jquery');
script(base_url().'misc/jquery/jquery.url.js');
?>
<script>
	$(function(){
		var url = $.url(); 
		var  access_token = url.fparam('access_token');
		window.location.href = "<?php echo url('member/google/next');?>?access_token="+access_token;
	});
</script>