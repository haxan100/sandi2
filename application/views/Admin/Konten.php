<!--end breadcrumb-->
<h6 class="mb-0 text-uppercase"> Data Komentar </h6>
<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabelKomentar" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Ucapan</th>
						<th>Konfirmasi</th>
						<th>Created_At</th>
						<th>Status</th>
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
				<h5 class="modal-title">Tampilkan /Semnbunyikan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input class="form-control" type="hiiden" name="id_ucapan" id="id_ucapan">

				<select name="status" id="status" class="form-control" required="required">
					<option value="0">Sembunyikan</option>
					<option value="1">Tampilkan</option>
				</select>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="BtnSave">Save changes</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
				url: '<?= base_url('Adminya/getKomentar'); ?>',
				type: 'POST',
				"data": function(d) {

					return d;
				},
			},
		});

		$('body').on('click', '.Ubah', function() {
			var id = $(this).data('id');
			var status = $(this).data('status');
			$('#id_ucapan').val(id);
			$('#status').val(status);
			$('#ModalGanti').modal('show');

		});
		$('#BtnSave').click(function(e) {
			e.preventDefault();
			var id = $('#id_ucapan').val();
			var status = $('#status').val();
			$.ajax({
				type: "post",
				url: u + "Adminya/GantiStatusKomentar",
				data: {
					id,
					status
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
