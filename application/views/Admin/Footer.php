		</div>

		</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

		</div>
		<!--end wrapper-->
		<!-- Bootstrap JS -->
		<!--plugins-->
		<script src="<?= base_url() ?>Admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
		<script src="<?= base_url() ?>Admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
		<script src="<?= base_url() ?>Admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
		<!--app JS-->
		<script src="<?= base_url() ?>Admin/assets/js/app.js"></script>

		<script src="<?= base_url() ?>Admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>Admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
		</body>

		</html>
		<script>
			$('#btnLogout').click(function(e) {
				e.preventDefault();
				Swal.fire({
					title: 'Hendak Logout?',
					text: 'Apakah Anda Yakin?',
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Logout'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: "post",
							url: bu + 'Adminya/logoutProcess',
							data: '',
							dataType: "json",
							success: function(r) {
								Swal.fire(
									'Berhasil',
									r.pesan,
									'success'
								);
								window.location.href = bu + 'Adminya/Login'
							}
						});
					}
				})
			});
		</script>
