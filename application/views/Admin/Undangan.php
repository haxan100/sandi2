<!--end breadcrumb-->
<h6 class="mb-0 text-uppercase"> Data Undangan </h6>
<hr />
<button class="btn btn-primary" type="button" id="tambah">Tambah</button>
<button class="btn btn-primary" type="button" id="Import">Import</button>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabelKomentar" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>No HP</th>
						<th>Link</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<div class="modal" id="ModalGanti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Undangan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input class="form-control" type="hidden" name="id_undangan" id="id_undangan">

				<div class="col form-group">
					<label for="nomor_resi">Nama </label>
					<input id="nama_undangan" name="nomor_resi" placeholder="Masukan Nama" required type="text" class="form-control">

					<small></small>
				</div>

				<div class="col form-group">
					<label for="nomor_resi">Nomo HP </label>
					<input id="nomor_hp" name="nomor_hp" placeholder="Mohon Masukan Nomor Depanya 8" required type="number" class="form-control">

					<small></small>
				</div>



			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="BtnSave">Save changes</button>
				<button type="button" class="btn btn-primary" id="BtnTambah">Save</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ImportModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<?= base_url('Import/import_excel'); ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Pilih File Excel</label>
						<input type="file" name="fileExcel">
					</div>
					<div>
						<button class='btn btn-success' type="submit">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							Import
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var datatable3 = $('#tabelKomentar').DataTable({
			'sDom': 'lrtip',
			'lengthMenu': [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, 'All']
			],
			'pageLength': 5,
			"processing": true,
			"serverSide": true,
			"columnDefs": [{
					"targets": 0,
					"className": "dt-body-center dt-head-center",
					"orderable": false
				},
				{
					"targets": 1,
					"className": "dt-body-center dt-head-center"
				},
				{
					"targets": 2,
					"className": "dt-body-center dt-head-center",
					"orderable": false
				},
				{
					"targets": 3,
					"className": "dt-body-center dt-head-center"
				},
			],
			"order": [
				[3, "desc"]
			],
			'ajax': {
				url: '<?= base_url('Adminya/getUndangan'); ?>',
				type: 'POST',
				"data": function(d) {

					return d;
				},
			},
		});
		$('#Import').click(function(e) {
			e.preventDefault();
			$('#ImportModal').modal('show');

		});

		$('body').on('click', '.Ubah', function() {
			var id = $(this).data('id');
			var no_hp = $(this).data('no_hp');
			var nama = $(this).data('nama_undangan');
			$('#id_undangan').val(id);
			$('#nomor_hp').val(no_hp);
			$('#nama_undangan').val(nama);
			$('#ModalGanti').modal('show');
			$('#BtnSave').show();
			$('#BtnTambah').hide();

		});
		$('body').on('click', '.Hapus', function() {
			var id = $(this).data('id');
			var no_hp = $(this).data('no_hp');
			var nama = $(this).data('nama_undangan');
			Swal.fire({
				title: 'Apakah Anda Yakin	?',
				text: ' Akan Menghapus Data Ini',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'success'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: "<?= base_url() ?>/Adminya/HapusUndangan",
						data: {
							id,
							nama
						},
						dataType: "json",
						success: function(r) {
							if (r.status) {
								Swal.fire(
									'Berhasil',
									r.pesan,
									'success'
								)
							} else {
								Swal.fire(
									'Maaf',
									r.pesan,
									'error'
								)
							}
							datatable3.ajax.reload()


						}
					});

				}
			});


		});

		$('body').on('click', '.btnKlikLink', function() {
			var no_wa = $(this).data('no_wa');
			var nama_teman = $(this).data('nama_undangan');
			var link_teman = $(this).data('link_teman');

			var link = bu + 'user';
			var pesan = 'halo ' + nama_teman + ' mohon kehadiranya di pernikahan kami ya , link :  ' + link + '/' + link_teman
			window.open('https://wa.me/62' + no_wa + '?text=' + pesan + '');
		});


		$('#tambah').click(function(e) {
			$('#ModalGanti').modal('show');
			$('#BtnSave').hide();
			$('#BtnTambah').show();
		});
		$('#BtnTambah').click(function(e) {
			e.preventDefault();
			var nama = $('#nama_undangan').val();
			var no_hp = $('#nomor_hp').val();
			$.ajax({
				type: "post",
				url: "<?= base_url() ?>/Adminya/tambahUndangan",
				data: {
					nama,
					no_hp
				},
				dataType: "json",
				success: function(r) {
					if (!r.error) {
						Swal.fire(
							'Berhasil',
							r.pesan,
							'success'
						)
						$('#ModalGanti').modal('hide');

					} else {
						Swal.fire(
							'Maaf',
							r.pesan,
							'error'
						)
						$('#ModalGanti').modal('hide');

					}
					datatable3.ajax.reload()

				}

			});

		});
		$('#BtnSave').click(function(e) {
			e.preventDefault();
			var id = $('#id_undangan').val();
			var nama_undangan = $('#nama_undangan').val();
			var nomor_hp = $('#nomor_hp').val();
			$.ajax({
				type: "post",
				url: u + "Adminya/updateUndangan",
				data: {
					id,
					nama_undangan,
					nomor_hp
				},
				dataType: "json",
				success: function(r) {
					Swal.fire(
						'Berhasil',
						'Berhasil Mengupdate',
						'success'
					)
					$('#ModalGanti').modal('hide');

					datatable3.ajax.reload()
				}
			});
		});


	});
</script>
