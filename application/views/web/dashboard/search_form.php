<form id="Selform" class="p-3" name="myformsearch" method="post" action="admin_master/default_product" novalidate>
    <div class="px-1 row justify-content-center">
        <div class="col-lg-1">
            <select id="select_board" class="p-0 m-0 col-lg-12 custom-select selectBoard_change" name="select_board" required>
                <option value="<?= $this->session->userdata('board_name') ?>" selected>
                    <?= $this->session->userdata('board_name') ?>
                </option>
            </select>
        </div>

        <div class="col-lg-2">
            <select id="select_publication" class="p-0 m-0 col-lg-12 custom-select" name="select_publication" required>
                <?php foreach ($publication as $pub): ?>
                    <option value="<?= $pub->id ?>" selected><?= $pub->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-2">
            <select id="mainSubject" class="p-0 m-0 col-lg-12 custom-select" name="mainSubject" required>
                <?php foreach ($selectable_subjects as $msub): ?>
                    <option value="<?= $msub->id ?>" <?= $msub->id == $this->session->userdata('main_subject') ? 'selected' : '' ?>>
                        <?= $msub->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-2">
            <select id="select_classes" class="p-0 m-0 col-lg-12 custom-select teacherClasses" name="select_classes" required>
                <?php foreach ($selectable_classes as $class): ?>
                    <option value="<?= $class->id ?>" <?= $class->id == $this->session->userdata('classes') ? 'selected' : '' ?>>
                        <?= $class->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="text" class="d-none" value="<?= $this->session->userdata('msubject') ?>" id="msub_d" required />

        <div class="col-lg-3">
            <select id="select_msubject" class="p-0 m-0 col-lg-12 custom-select teacherMsubject" name="select_msubject" required>
                <?php foreach ($selectable_books as $book): ?>
                    <option value="<?= $book->id ?>" <?= $book->id == $this->session->userdata('selected_book') ? 'selected' : '' ?>>
                        <?= $book->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-1">
            <input type="submit" name="submit" class="btn btn-success" id="searchBtn" value="Search">
        </div>
    </div>
</form>
