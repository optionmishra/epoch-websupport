<?php if (empty($default)): ?>
    <p class="m-3 text-danger" style="font-size: 30px">Coming Soon...</p>
<?php else: ?>
    <?php foreach ($default as $def): ?>
        <tr class="p-0 mt-1 mb-2 col-lg-3">
            <td class="p-0 col-lg-12">
                <div class="col-lg-12">
                    <a href="<?= base_url("analytics/download_websupport/{$def->id}") ?>" class="p-0 m-0 digital-con" target="_blank">
                        <div class="p-0 m-0 row">
                            <div class="p-2 m-0 col-lg-12 top-con">
                                <h5>Click Here! For Download</h5>
                            </div>
                            <div class="p-3 m-0 col-lg-12 middle-con">
                                <img src="<?= empty($def->book_image) ? 'assets/img/3.png' : "assets/bookicon/{$def->book_image}" ?>">
                            </div>
                            <div class="p-2 m-0 col-lg-12 bottom-con">
                                <h4><?= $def->title ?></h4>
                                <h6><?= $this->session->userdata('class_name') ?></h6>
                            </div>
                        </div>
                    </a>
                </div>

                <?php if ($is_test_paper_gen): ?>
                    <div class="p-2 m-auto col-lg-10" style="background: greenyellow; height: 42px; text-align: center; top: 7px; font-size: 14px;">
                        <a href="<?= base_url('query/teacher-question') ?>" target="_blank" style="color: #444;font-weight: 600;">
                            Submit Your Question
                        </a>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
