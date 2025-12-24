<style>
	.form-wrapper {
		max-width: 800px;
		min-height: 100vh;
		margin: 40px auto;
	}

	.card {
		padding: 10px 10px 0 10px;
		border-radius: 1.25rem;
		border: none;
	}

	.form-wrapper .card .card-heading {
		padding-top: 20px;
		/* background: #1a1a1a; */
		/* -webkit-border-top-left-radius: 10px;
		-moz-border-radius-topleft: 10px;
		border-top-left-radius: 10px;
		-webkit-border-top-right-radius: 10px;
		-moz-border-radius-topright: 10px;
		border-top-right-radius: 10px; */
	}

	.form-wrapper .title {
		font-size: 24px;
		text-transform: uppercase;
		font-weight: bold;
		text-align: center;
		color: #333;
	}

	.form-wrapper .form-control {
		/* background: #f4f4f4; */
		min-height: 42px;
		font-size: 15px;
		color: #333;
	}

	.form-wrapper select.form-control:not([size]):not([multiple]) {
		min-height: 42px;
	}

	.form-wrapper .card-footer {
		background-color: transparent;
	}

	.form-wrapper .btn--red {
		background: #ff4b5a;
		border-radius: 5px;
		line-height: 50px;
		padding: 0 40px;
		border: none;
		width: 60%;
		/* border-color: #ff4b5a; */
	}

	.card-footer {
		padding-top: 20px;
	}

	.series-select {
		border-bottom: none;
		border-radius: 5px 5px 0 0;
		background: #f4f4f4;
	}

	.series-classes-container {
		border: 1px solid #ced4da;
		border-top: none;
		border-radius: 0 0 5px 5px;
		color: #495057;
		background: #f4f4f4;
		font-size: 15px;
		min-height: 42px;
	}

	.series-select:disabled {
		appearance: none;
	}

	/* .series-classes-container-new {
		background-color: #FFFFFF;
		border: 2px solid #ced4da;
		border-top: none;
		border-radius: 0 0 5px 5px;
		color: #495057;
		font-size: 15px;
		min-height: 42px;
	}

	.series-classes-container {
		border: 2px solid #ced4da;
		border-top: none;
		border-radius: 0 0 5px 5px;
		color: #495057;
		background: #E9ECEF;
		font-size: 15px;
		min-height: 42px;
	} */
</style>
<div class="form-wrapper">
	<div class="card">
		<div class="card-heading">
			<h2 class="title">Teacher Registration</h2>
		</div>
		<div class="card-body">
			<form method="post" action="<?php echo base_url(); ?>admin_master/simpleTeacherRegistration">

				<div class="form-body">
					<div class="py-2 m-0 row">
						<div class="py-2 col-lg-6">
							<div class="form-group">
								<label for="teacher_name">Full Name *</label>
								<input type="text" class="form-control" id="teacher_name" name="name" required="true" placeholder="Enter full Name">
							</div>
						</div>
						<div class="py-2 col-lg-6">
							<div class="form-group">
								<label for="teacher_mobile">Mobile *</label>
								<input type="tel" class="form-control" id="teacher_mobile" name="mobile" pattern="[1-9]{1}[0-9]{9}" title="10 digit Mobile number" required="true" placeholder="Enter Mobile Number">
							</div>
						</div>
						<div class="py-2 col-lg-6">
							<div class="form-group">
								<label for="teacher_email">Email(School) *</label>
								<input type="email" class="form-control" id="teacher_email" name="email" required="true" placeholder="Enter Email(School)">
								<div id="getemail_descc"></div>
							</div>
						</div>
						<div class="py-2 col-lg-6">
							<div class="form-group">
								<label for="teacher_password">Password *</label>
								<input type="password" class="form-control" id="teacher_password" name="password" pattern=".{8,}" title="Must contain at least 8 or more characters" required="true" placeholder="Enter Password">
								<div id="getemail_desc"></div>
							</div>
						</div>
					</div>

				<!-- Captcha Section -->
				<div class="py-2 m-0 row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="captcha">Security Check *</label>
							<div class="d-flex align-items-center gap-2" style="gap: 10px;">
								<div id="captcha-image" style="border: 1px solid #ced4da; border-radius: 5px; padding: 5px; background: #fff;">
									<?= $captcha_image ?>
								</div>
								<button type="button" class="btn btn-outline-secondary btn-sm" onclick="refreshCaptcha()" title="Get new captcha">
									&#x21bb; Refresh
								</button>
							</div>
							<input type="text" class="form-control mt-2" id="captcha" name="captcha" required="true" placeholder="Enter the characters shown above *" style="max-width: 200px;">
						</div>
					</div>
				</div>

					<div class="card-footer d-flex justify-content-center">
						<button class="btn btn-primary btn--red">Register</button>
					</div>
			</form>
		</div>
	</div>
</div>
</div>

<script>
function refreshCaptcha() {
	fetch('<?= base_url("web/refreshCaptcha") ?>')
		.then(res => res.json())
		.then(data => {
			if (data.success) {
				document.getElementById('captcha-image').innerHTML = data.image;
			}
		})
		.catch(err => console.error('Failed to refresh captcha:', err));
}
</script>
