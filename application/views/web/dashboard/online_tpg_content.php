<?php if (empty($online_tpgs)) { ?>
    <p class="m-3 text-danger" style="font-size: 30px">Coming Soon...</p>
<?php } else { ?>
    <?php foreach ($online_tpgs as $tpg) { ?>
        <tr class="p-0 mt-1 mb-2 col-lg-3">
            <td class="p-0 col-lg-12">
                <div class="col-lg-12">
                    <a href="<?= base_url("tpg/public/{$tpg->book_id}/{$tpg->class_id}") ?>" class="p-0 m-0 digital-con" target="_blank">
                        <div class="p-0 m-0 row">
                            <div class="p-2 m-0 col-lg-12 top-con">
                                <h5><?= $tpg->name ?><br>Online TPG</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
