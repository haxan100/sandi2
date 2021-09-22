<?php $this->load->view('Admin/Header');
?>
<!-- <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"> -->
<div class="container-fluid">
	<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
		<div class="col mx-auto">
			<div class="mb-4 text-center">
				<img src="assets/images/logo-img.png" width="180" alt="" />
			</div>
			<div class="card">
				<div class="card-body">
					<div class="border p-4 rounded">
						<div class="text-center">
							<h3 class="">Sign in</h3>
							</p>
						</div>
						<div class="login-separater text-center mb-4">
							<hr />
						</div>
						<div class="form-body">
							<form class="row g-3">
								<div class="col-12">
									<label for="inputEmailAddress" class="form-label">Username</label>
									<input type="text" class="form-control" id="u" placeholder="Username">
								</div>
								<div class="col-12">
									<label for="inputChoosePassword" class="form-label">Enter Password</label>
									<div class="input-group" id="show_hide_password">
										<input type="password" class="form-control border-end-0" id="p" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"></a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
										<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
									</div>
								</div>
								<div class="col-md-6 text-end">
								</div>
								<div class="col-12">
									<div class="d-grid">
										<button id="btnLogin" type="submit" class="btn btn-light"><i class="bx bxs-lock-open"></i>Sign in</button>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end row-->
</div>
</div>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
	<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
	</div>
	<div class="switcher-body">
		<div class="d-flex align-items-center">
			<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
			<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
		</div>
		<hr />
		<p class="mb-0">Gaussian Texture</p>
		<hr>
		<ul class="switcher">
			<li id="theme1"></li>
			<li id="theme2"></li>
			<li id="theme3"></li>
			<li id="theme4"></li>
			<li id="theme5"></li>
			<li id="theme6"></li>
		</ul>
		<hr>
		<p class="mb-0">Gradient Background</p>
		<hr>
		<ul class="switcher">
			<li id="theme7"></li>
			<li id="theme8"></li>
			<li id="theme9"></li>
			<li id="theme10"></li>
			<li id="theme11"></li>
			<li id="theme12"></li>
			<li id="theme13"></li>
			<li id="theme14"></li>
			<li id="theme15"></li>
		</ul>
	</div>
</div>
<!--end switcher-->


<script>
	$(".switcher-btn").on("click", function() {
			$(".switcher-wrapper").toggleClass("switcher-toggled")
		}), $(".close-switcher").on("click", function() {
			$(".switcher-wrapper").removeClass("switcher-toggled")
		}),

		$('#btnLogin').click(function(e) {
			e.preventDefault();
			var u = $('#u').val();
			var p = $('#p').val();
			$.ajax({
				type: "post",
				url: bu + 'Adminya/LoginProcess',
				data: {
					u,
					p
				},
				dataType: "json",
				success: function(r) {
					if (r.error) {
						Swal.fire(
							'Maaf,',
							r.pesan,
							'error'
						)
					} else {
						Swal.fire(
							'Berhasil',
							r.pesan,
							'success'
						)
						window.location.href = bu+"Adminya/Undangan"
					}
				}
			});
		});


	$('#theme1').click(theme1);
	$('#theme2').click(theme2);
	$('#theme3').click(theme3);
	$('#theme4').click(theme4);
	$('#theme5').click(theme5);
	$('#theme6').click(theme6);
	$('#theme7').click(theme7);
	$('#theme8').click(theme8);
	$('#theme9').click(theme9);
	$('#theme10').click(theme10);
	$('#theme11').click(theme11);
	$('#theme12').click(theme12);
	$('#theme13').click(theme13);
	$('#theme14').click(theme14);
	$('#theme15').click(theme15);


	function theme1() {
		$('body').attr('class', 'bg-theme bg-theme1');
	}

	function theme2() {
		$('body').attr('class', 'bg-theme bg-theme2');
	}

	function theme3() {
		$('body').attr('class', 'bg-theme bg-theme3');
	}

	function theme4() {
		$('body').attr('class', 'bg-theme bg-theme4');
	}

	function theme5() {
		$('body').attr('class', 'bg-theme bg-theme5');
	}

	function theme6() {
		$('body').attr('class', 'bg-theme bg-theme6');
	}

	function theme7() {
		$('body').attr('class', 'bg-theme bg-theme7');
	}

	function theme8() {
		$('body').attr('class', 'bg-theme bg-theme8');
	}

	function theme9() {
		$('body').attr('class', 'bg-theme bg-theme9');
	}

	function theme10() {
		$('body').attr('class', 'bg-theme bg-theme10');
	}

	function theme11() {
		$('body').attr('class', 'bg-theme bg-theme11');
	}

	function theme12() {
		$('body').attr('class', 'bg-theme bg-theme12');
	}

	function theme13() {
		$('body').attr('class', 'bg-theme bg-theme13');
	}

	function theme14() {
		$('body').attr('class', 'bg-theme bg-theme14');
	}

	function theme15() {
		$('body').attr('class', 'bg-theme bg-theme15');
	}
</script>
</body>

</html>
