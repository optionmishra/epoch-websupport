<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $siteName ?></title>
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
		rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('assets/revamp/fontawesome/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/revamp/css/style.css') ?>" />
	<script src="<?= base_url('assets/revamp/js/script.js') ?>" defer></script>
</head>

<body data-theme="light" class="font-inter">
	<div class="min-h-screen bg-background">
		<main>
			<div
				class="container flex items-center justify-center min-h-screen px-1 mx-auto">
				<div class="flex flex-col w-full h-full sm:flex-row">
					<div
						class="flex flex-col items-center w-full bg-white rounded-lg sm:w-1/2 sm:rounded-r-none 2xl:py-16">
						<div
							class="flex justify-center p-2 my-5 mb-10 bg-white rounded-md w-80 sm:w-96">
							<img src="<?= base_url('assets/img/'.$logo['file_name']) ?>" alt="logo" />
						</div>
						<div class="text-center">
							<h1 class="text-2xl font-semibold text-primary">
								Welcome to <?= $siteName ?>
							</h1>
							<small class="font-semibold text-accent">
							    Enter the World of AI
							</small>
						</div>
						<div class="w-2/3 my-10 2xl:w-1/2">
							<form action="<?= base_url('web/process') ?>" method="post">
								<div class="flex flex-col gap-1 mb-5">
									<label
										class="font-semibold text-secondary"
										for="email">Email
										<span class="text-sm text-accent">
											*
										</span>
									</label>
									<input
										class="px-4 py-2 border border-gray-300 rounded-md focus:border-accent outline-accent"
										id="email"
										type="email"
										name="username"
										placeholder="Enter your email address"
										required />
								</div>
								<div class="flex flex-col gap-1 mb-5">
									<label
										class="font-semibold text-secondary"
										for="password">
										Password
										<span class="text-sm text-accent">
											*
										</span>
									</label>
									<input
										class="px-4 py-2 border border-gray-300 rounded-md focus:border-accent outline-accent"
										id="password"
										type="password"
										name="password"
										placeholder="Enter your password"
										required />
								</div>

								<div
									class="flex flex-col justify-between mb-5 sm:flex-row gap-y-2">
									<div
										class="flex items-center justify-center gap-1">
										<input
											class="w-4 h-4 cursor-pointer accent-accent"
											type="checkbox"
											id="showPassword" />
										<label
											class="cursor-pointer"
											for="showPassword">Show Password</label>
									</div>
									<div
										class="flex items-center justify-center">
										<button onclick="forgotPasswordModal.showModal()" type="button" class="font-semibold text-secondary hover:text-accent">Forgot your Password?</button>
									</div>
								</div>

								<?php if ($this->session->flashdata('error')) { ?>
									<div class="flex justify-center py-2 mb-5 ">
										<strong class="text-red-600"><?= $this->session->flashdata('error'); ?></strong>
									</div>
									<?php $this->session->unset_userdata('error'); ?>
								<?php } ?>

								<div class="flex flex-col gap-3 mb-5">
									<button type="submit" class="text-white bg-[#491820] hover:bg-accent focus:ring-4 focus:ring-accent font-semibold rounded-md py-2 px-4 focus:outline-none transition-colors duration-300 ease-in-out">Log In</button>
								</div>
							</form>
						</div>
						<div class="my-5 text-center">
							<p class="text-secondary">
								Don't have an account?
							</p>
							<div class="flex gap-5 my-5">
								<button
									class="px-4 py-2 font-semibold text-white transition-colors duration-300 ease-in-out rounded-md hover:bg-accent bg-secondary">
									<a href="<?= base_url('teacher-registration') ?>">I'm a Teacher</a>
								</button>
								<button
									class="px-4 py-2 font-semibold text-white transition-colors duration-300 ease-in-out rounded-md hover:bg-accent bg-secondary">
									<a href="<?= base_url('student-registration') ?>">I'm a Student</a>
								</button>
							</div>
						</div>
						<!-- /container -->
					</div>

					<div
						class="hidden bg-[url('../img/right-bg.png')] w-full bg-center bg-no-repeat bg-cover rounded-r-lg sm:block sm:w-1/2 right-bg"></div>
				</div>
			</div>
		</main>
	</div>

	<!-- Forgot Password Modal -->
	<dialog id="forgotPasswordModal" class="modal">
		<div class="modal-box">
			<h3 class="text-lg font-bold text-primary">Forgot your Password?</h3>
			<form method="dialog">
				<button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
			</form>
			<form class="my-5" id="forgotPasswordForm" action="<?= base_url('admin_master/check_forgot') ?>" method="post">
				<div class="flex flex-col gap-1 mb-5">
					<label
						class="font-semibold text-secondary"
						for="recoveryEmail">Email
						<span class="text-sm text-accent">
							*
						</span>
					</label>
					<input
						class="px-4 py-2 border border-gray-300 rounded-md focus:border-accent outline-accent"
						id="recoveryEmail"
						type="email"
						name="email"
						placeholder="Enter your email address"
						required />
				</div>
				<div class="my-5">
					<p id="responseMessage"></p>
				</div>
				<div class="modal-action">
					<button type="submit" class="text-white transition-colors duration-300 ease-in-out btn bg-primary hover:bg-accent">Submit</button>
				</div>
			</form>
		</div>
	</dialog>
</body>

</html>
