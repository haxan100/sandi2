<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modal</title>
</head>

<body>

	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<div id="ModalAwal" class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<img width="310" height="60" src="https://u.moment.my.id/wp-content/uploads/2021/03/Asset-1.png" class="attachment-large size-large" alt="Bukaan" loading="lazy" srcset="https://u.moment.my.id/wp-content/uploads/2021/03/Asset-1.png 310w, https://u.moment.my.id/wp-content/uploads/2021/03/Asset-1-300x58.png 300w" sizes="(max-width: 310px) 100vw, 310px" /> </a>
				</div>
			</div>
		</div>
	</div>
</body>
<style>
	.modal-dialog {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.modal-content {
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>
<script>
	jQuery(document).ready(function($) {
		$('#ModalAwal').modal('show');

	});
</script>

</html>
