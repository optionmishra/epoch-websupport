<div id="loader" class="hidden justify-center items-center sm:min-h-[30rem]">
  <span class="loading loading-ring w-80 text-accent"></span>
</div>

<div id="coming_soon" class="<?= ! empty($default) ? 'hidden' : 'flex' ?> flex-col gap-5 justify-center items-center sm:min-h-[30rem]">
  <i class="fas fa-exclamation-triangle fa-2x text-accent text-7xl sm:text-9xl"></i>
  <p id="responseMessage" class="text-xl font-bold text-primary sm:text-3xl">Coming Soon</p>
</div>

<div class="w-full">
  <?php if (! empty($default)) { ?>
    <div id="dashboard_content" class="grid grid-cols-3 gap-5 2xl:grid-cols-5 justify-items-center">
      <?php foreach ($default as $def) { ?>
        <div class="w-64 shadow-xl card bg-base-100">
          <figure>
            <img
              src="<?= empty($def->book_image) ? base_url('assets/img/3.png') : base_url("assets/bookicon/$def->book_image") ?>"
              alt="Shoes" />
          </figure>
          <div class="card-body">
            <h2 class="justify-center mb-5 card-title"><?= $def->title.' '.$userdata['class_name'] ?></h2>
            <div class="justify-center w-full card-actions">
              <!-- Downloading with analytics -->
              <button class="w-full text-white transition-colors duration-300 ease-in-out btn bg-primary hover:bg-accent"><a href="<?= base_url("analytics/download_websupport/$def->id") ?>" target="_blank">Download</a></button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

</div>