  

	<!-- jQuery  -->
	<script src="<?=base_url('assets')?>/js/jquery.min.js"></script>
	<script src="<?=base_url('assets')?>/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url('assets')?>/js/metismenu.min.js"></script>
	<script src="<?=base_url('assets')?>/js/jquery.slimscroll.js"></script>
	<script src="<?=base_url('assets')?>/js/waves.min.js"></script>

	<!-- App js -->
	<script src="<?=base_url('assets')?>/js/app.js"></script>
	<!-- Custom script for all pages -->
	<script src="<?=base_url('assets')?>/js/jquery.form.js"></script>

	<input type="hidden" id="cstn" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
	<input type="hidden" id="cstv" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<script type="text/javascript">
	$(document).ready(function(){ 
		$.ajaxPrefilter(function(options, originalData, xhr){
			if (options.data) options.data += "&"+$("#cstn").val()+"="+$("#cstv").val()+"";
			});
	 }); 
	</script>

	<script src="<?=base_url('assets')?>/js/jquery.validate.js"></script> 
	<script src="<?=base_url('assets')?>/js/comns.js"></script> 
	<script src="<?=base_url('assets')?>/js/login.js"></script>
	<script src="<?=base_url('assets')?>/js/scripts.js"></script>
        
 </body>

</html>