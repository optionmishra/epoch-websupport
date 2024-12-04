<?php if ($this->session->flashdata('success')) : ?>

	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
		<strong><?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php $this->session->unset_userdata('success'); ?>

<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>

	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
		<strong><?php echo $this->session->flashdata('error'); ?></strong>
	</div>
	<?php $this->session->unset_userdata('error'); ?>

<?php endif; ?>
<style>
	body {
		padding-bottom: 58px;
	}

	.app-title {
		position: relative;
	}

	.ttl-btn {
		position: absolute;
		right: 18px;
		top: 5px;
		padding: 5px 36px;
		background-color: #79b6f7;
	}
</style>
<main class="app-content d-flex flex-column justify-content-start">
	<div class="app-title">
		<ul class="m-0 app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><?= $this->session->userdata('board_name') ?></li>
			<li class="breadcrumb-item"><?= $this->session->userdata('publication_name') ?></li>
			<li class="breadcrumb-item"><?= $this->session->userdata('class_name') ?></li>
			<li class="breadcrumb-item"><?= $this->session->userdata('category_name') ?></li>
			<input type="text" id="active" value="<?= $this->session->userdata('category') ?>" class="d-none">
		</ul>

		<?php
		$userdata = $this->session->userdata();
		//echo $userdata['user_id'];
		if ($userdata['user_id'] == 222 || $userdata['user_id'] == 246) {
			//print_r($userdata);
			if ($userdata['type'] == 'Teacher') {
		?>
				<a href="web/teacher_panel" class="btn btn-primary ttl-btn">Teacher Section</a>
			<?php } else { ?>
				<a href="web/student_panel" class="btn btn-primary ttl-btn">Student Section &nbsp </a>
		<?php }
		} ?>
	</div>
	<form id="Selform" class="p-3 smooth-submit" name="myformsearch" method="post" action="admin_master/default_product" novalidate>
		<div class="px-1 row justify-content-center">
			<div class="col-lg-1">
				<select id="select_board" class="p-0 m-0 col-lg-12 custom-select selectBoard_change" name="select_board" required="true">
					<?php //foreach ($board as $bo): 
					?>
					<option value="<?= $this->session->userdata('board_name') ?>" selected><?= $this->session->userdata('board_name') ?></option>
					<?php //endforeach; 
					?>
				</select>
			</div>
			<div class="col-lg-2">
				<select id="select_publication" class="p-0 m-0 col-lg-12 custom-select" name="select_publication" required="true">
					<?php foreach ($publication as $pub) : ?>
						<option value="<?= $pub->id ?>" selected><?= $pub->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php if ($this->session->userdata('type') == 'Teacher') { ?>
				<div class="col-lg-2">
					<select id="mainSubject" class="p-0 m-0 col-lg-12 custom-select" name="mainSubject" required="true">
						<!-- <option value="">Select Subject</option> -->
						<?php foreach ($selectable_subjects as $msub) : ?>
							<option value="<?= $msub->id ?>" <?= $msub->id == $this->session->userdata('main_subject') ? ' selected="selected"' : ''; ?>><?= $msub->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php } ?>
			<?php if ($this->session->userdata('type') == 'Student') { ?>
				<div class="col-lg-2">
					<select id="select_classes" class="p-0 m-0 col-lg-12 custom-select" name="select_classes" required="true">

						<?php foreach ($selectable_classes as $class) : ?>
							<?php if ($class->id == $this->session->userdata('classes')) : ?>
								<option value="<?= $class->id ?>" selected="selected"><?= $class->name ?></option>
							<?php endif; ?>
						<?php endforeach; ?>

					</select>
				</div>
			<?php } ?>
			<?php if ($this->session->userdata('type') == 'Teacher') { ?>
				<div class="col-lg-2">
					<select id="select_classes" class="p-0 m-0 col-lg-12 custom-select teacherClasses" name="select_classes" required="true">
						<?php foreach ($selectable_classes as $class) : ?>
							<option value="<?= $class->id ?>" <?= $class->id == $this->session->userdata('classes') ? ' selected="selected"' : ''; ?>><?= $class->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>

			<?php } ?>

			<input type="text" class="d-none" value="<?= $this->session->userdata('msubject') ?>" id="msub_d" required="true" />
			<div class="col-lg-3">
				<?php if ($this->session->userdata('type') == 'Teacher') { ?>
					<select id="select_msubject" class="p-0 m-0 col-lg-12 custom-select teacherMsubject" name="select_msubject" required="true">
						<?php foreach ($selectable_books as $book) : ?>

							<option value="<?= $book->id ?>" <?= $book->id == $this->session->userdata('selected_book') ? ' selected="selected"' : '' ?>><?= $book->name ?></option>

						<?php endforeach; ?>
					</select>
				<?php } ?>
				<?php if ($this->session->userdata('type') == 'Student') { ?>
					<select id="select_msubject" class="p-0 m-0 col-lg-12 custom-select" name="select_msubject" required="true">


						<?php foreach ($msubject as $cl) : ?>

							<option value="<?= $cl->id ?>" selected><?= $cl->name ?></option>

						<?php endforeach; ?>

					</select>
				<?php } ?>
			</div>

			<div class="col-lg-1">
				<input type="submit" name="submit" class="btn btn-success" id="searchBtn" value="Search">
			</div>

		</div>
	</form>
	<div class="m-0 mx-4 row justify-content-center">
		<div class="py-3 row justify-content-center col-md-3 col-sm-12">
			<div class="home-side w-100">
				<div class="wmain_sidebar">
					<?php
					$userdata = $this->session->userdata();

					?>
					<?php if ($userdata['type'] == 'Teacher') : ?>
						<ul class="row justify-content-center userTeacher">
							<?php
							foreach ($selectable_categories as $cat) {


								if ($cat->allow == 'Both' || $cat->allow == $userdata['type']) {
							?>
									<li class="p-2 my-1 card col-5" id="active<?= $cat->id ?>" style="border-radius:0.5rem">
										<a tab_id="<?= $cat->id ?>" class="new-search"><img src="<?= base_url('assets/cat_icons/' . $cat->icon) ?>" alt=""><?= $cat->name ?></a>
									</li>
							<?php
								}
							}
							?>
						</ul>
					<?php endif; ?>
					<?php if ($userdata['type'] == 'Student') : ?>
						<?php
						$userdata = $this->session->userdata();

						?>
						<ul class="row justify-content-center">
							<?php
							foreach ($category as $cat) {


								if ($cat->allow == 'Both' or $cat->allow == $userdata['type']) {
							?>
									<li class="p-2 my-1 card col-5" id="active<?= $cat->id ?>" style="border-radius:0.5rem">
										<a tab_id="<?= $cat->id ?>" class="new-search"><img src="<?= base_url('assets/cat_icons/' . $cat->icon) ?>" alt=""><?= $cat->name ?></a>
									</li>
							<?php
								}
							}
							?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="p-0 m-0 row justify-content-center col-md-9 col-sm-12">
			<div class="p-0 mt-3 col-md-11 justify-content-center">

				<div class="row justify-content-center">
					<table id="srch_tbl" class="table table-striped table-bordered" style="width:100%;float:left;">
						<thead style="display:none;">
							<tr>
								<th>Name</th>
							</tr>
						</thead>
						<tbody class="row" id="webSupportsTable">
							<?php if ($this->session->userdata('category_name') == 'Online TPG'): ?>
								<?php if (empty($online_tpgs)): ?>
									<p class="m-3 text-danger" style="font-size: 30px">Coming Soon...</p>
								<?php else: ?>
									<?php foreach ($online_tpgs as $tpg) : ?>
										<tr class="p-0 mt-1 mb-2 col-lg-3">
											<td class="p-0 col-lg-12">
												<div class="col-lg-12">
													<a href="<?= base_url("tpg/public/" . $tpg->book_id . "/" . $tpg->class_id) ?>" class="p-0 m-0 digital-con" target="_blank">
														<div class="p-0 m-0 row">
															<div class="p-2 m-0 col-lg-12 top-con">
																<h5><?= $tpg->name ?> <br> Online TPG</h5>
															</div>
														</div>
													</a>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>

							<?php else : ?>
								<?php if (empty($default)) { ?>
									<p class="m-3 text-danger" style="font-size: 30px">Coming Soon...</p>
								<?php } else { ?>
									<?php foreach ($default as $def) : ?>
										<tr class="p-0 mt-1 mb-2 col-lg-3">
											<td class="p-0 col-lg-12">
												<div class="col-lg-12">
													<!-- Downloading with analytics -->
													<a href="<?= base_url("analytics/download_websupport/$def->id") ?>" class="p-0 m-0 digital-con" target="_blank">
														<div class="p-0 m-0 row">
															<div class="p-2 m-0 col-lg-12 top-con">
																<h5>Click Here! For Download</h5>
															</div>
															<div class="p-3 m-0 col-lg-12 middle-con">
																<img src="<?= empty($def->book_image) ? 'assets/img/3.png' : "assets/bookicon/$def->book_image" ?>">
															</div>
															<div class="p-2 m-0 col-lg-12 bottom-con">
																<h4><?= $def->title ?></h4>
																<h6><?= $this->session->userdata('class_name') ?></h6>
															</div>

														</div>
													</a>

												</div>
												<?php if ($this->session->userdata('category_name') == 'Test Paper Generator') { ?>
													<div class="p-2 m-auto col-lg-10" style="background: greenyellow; height: 42px; text-align: center; top: 7px; font-size: 14px;">

														<a href="<?php echo base_url(); ?>query/teacher-question" target="_blank" style="color: #444;font-weight: 600;">Submit Your Question</a>

													</div>
											</td>
										</tr>
									<?php } ?>
							<?php endforeach;
								}
							?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>

				<!--<div class="m-0 row">
                <?php if (empty($default)) { ?>
                    <p class="text-danger" style="font-size: 30px"> Coming Soon.....</p>
                <?php
								} else {
									foreach ($default as $def) :
								?>
                        <div class="p-2 m-0 col-lg-3">
                            <a href="assets/files/<?= $def->file_name ?>" class="p-0 m-0 digital-con" target="_blank">
                                <div class="p-0 m-0 row">
                                    <div class="p-2 m-0 col-lg-12 top-con">
                                        <h5>Click Here! For Download</h5>
                                    </div>
                                    <div class="p-3 m-0 col-lg-12 middle-con">
                                        <img src="assets/img/download2.png">
                                    </div>
                                    <div class="p-2 m-0 col-lg-12 bottom-con"> 
                                        <h4><?= $def->title ?></h4> 
                                        <h6>Class <?= $def->classes ?></h6>
                                    </div>
									
                                </div> 
                            </a>
							
                        </div>
						<?php if ($this->session->userdata('category_name') == 'Test Paper Generator') { ?>
						<div class="p-2 m-0 col-lg-2" style="background: greenyellow; height: 42px; text-align: center; top: 7px; font-size: 14px;">
						
						<a href="<?php echo base_url(); ?>query/teacher-question" target="_blank" style="color: #444;font-weight: 600;">Submit Your Question</a>
						
						</div>
						<?php } ?>
                    <?php endforeach;
								}
										?>
            </div>-->
			</div>
		</div>
	</div>
</main>