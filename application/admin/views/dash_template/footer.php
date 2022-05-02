				<footer class="footer">
					© 2019 - <?= date('Y') ?> <?= COMPANY_NAME ?>
				</footer>

				</div>
				<!-- ============================================================== -->
				<!-- End Right content here -->
				<!-- ============================================================== -->

				</div>
				<!-- END wrapper -->

				<!-- jQuery  -->
				<script src="<?= base_url('assets') ?>/js/jquery.min.js"></script>
				<script src="<?= base_url('assets') ?>/js/bootstrap.bundle.min.js"></script>
				<script src="<?= base_url('assets') ?>/js/metismenu.min.js"></script>
				<script src="<?= base_url('assets') ?>/js/jquery.slimscroll.js"></script>
				<script src="<?= base_url('assets') ?>/js/waves.min.js"></script>

				<!--Morris Chart-->
				<script src="<?= base_url('assets') ?>/plugins/morris/morris.min.js"></script>
				<script src="<?= base_url('assets') ?>/plugins/raphael/raphael.min.js"></script>

				<script src="<?= base_url('assets') ?>/pages/dashboard.init.js"></script>

				<!-- App js -->
				<script src="<?= base_url('assets') ?>/js/app.js"></script>

				<script src="<?= base_url('assets') ?>/js/jquery.form.js"></script>

				<input type="hidden" id="cstn" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
				<input type="hidden" id="cstv" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<script type="text/javascript">
					$(document).ready(function() {
						$.ajaxPrefilter(function(options, originalData, xhr) {
							if (options.data) options.data += "&" + $("#cstn").val() + "=" + $("#cstv").val() + "";
						});
					});
				</script>
				<script src="<?= base_url('assets') ?>/js/jquery.validate.js"></script>
				<script src="<?= base_url('assets') ?>/js/comns.js"></script>
				<script src="<?= base_url('assets') ?>/js/login.js"></script>
				<script src="<?= base_url('assets') ?>/js/scripts.js"></script>

				<!-- Required datatable js -->
				<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
				<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.js"></script>

				<!-- Responsive examples -->
				<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.responsive.min.js"></script>
				<script src="<?= base_url('assets') ?>/plugins/datatables/responsive.bootstrap4.min.js"></script>


				 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

				<script>
					$(document).ready(function() {
						if ($("#data-table").length) {
							var module = $("#data-table").data('module');
							table = $('#data-table').DataTable({
								"processing": true, //Feature control the processing indicator.
								"serverSide": true, //Feature control DataTables' server-side processing mode.
								// Load data for the table's content from an Ajax source
								"ajax": {
									"url": site_url + '/' + module + '/getAll',
									"type": "POST"
								},
								//Set column definition initialisation properties.
								"columnDefs": [{
									"targets": [-1], //last column
									"orderable": false, //set not orderable
								}, ],
							});
						}
						// $('.datatable').dataTable();
					});
				</script>
				<script>
					$('.add').click(function() {
						$('.block:last').before('<div class="block form-group"><input style="display:inline-block" type="text" class="form-control col-sm-3" name="day_codes[]"/><span class="remove" style="margin-left:10px">Remove  </span></div>');
					});
					$('.optionBox').on('click', '.remove', function() {
						$(this).parent().remove();
					});
					 
				</script>

				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
				

				</body>

				</html>