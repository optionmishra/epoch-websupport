<form id="Selform" name="myformsearch" method="post" action="admin_master/default_product" novalidate>
    <div class="flex flex-wrap my-5 items-center gap-4 text-gray-800 justify-center">
        <div>
            <select id="select_board" class="custom-select selectBoard_change" name="select_board" required>
                <option value="<?= $this->session->userdata('board_name') ?>" selected>
                    <?= $this->session->userdata('board_name') ?>
                </option>
            </select>
        </div>

        <div>
            <select id="select_publication" class="custom-select" name="select_publication" required>
                <?php foreach ($publication as $pub) { ?>
                    <option value="<?= $pub->id ?>" selected><?= $pub->name ?></option>
                <?php } ?>
            </select>
        </div>

        <div>
            <select id="mainSubject" class="custom-select" name="mainSubject" required>
                <?php foreach ($selectable_subjects as $msub) { ?>
                    <option value="<?= $msub->id ?>" <?= $msub->id == $this->session->userdata('main_subject') ? 'selected' : '' ?>>
                        <?= $msub->name ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <select id="select_classes" class="custom-select teacherClasses" name="select_classes" required>
                <?php foreach ($selectable_classes as $class) { ?>
                    <option value="<?= $class->id ?>" <?= $class->id == $this->session->userdata('classes') ? 'selected' : '' ?>>
                        <?= $class->name ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <input type="hidden" value="<?= $this->session->userdata('msubject') ?>" id="msub_d" required />

        <div>
            <select id="select_msubject" class="custom-select teacherMsubject" name="select_msubject" required>
                <?php foreach ($selectable_books as $book) { ?>
                    <option value="<?= $book->id ?>" <?= $book->id == $this->session->userdata('selected_book') ? 'selected' : '' ?>>
                        <?= $book->name ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <input class="px-2 py-1 bg-[#E91D25] rounded-md text-white font-semibold" type="submit" name="submit" id="searchBtn" value="Search">
        </div>
    </div>
</form>
