<div class="w-full sm:w-1/5 bg-white py-5 sm:py-10 px-2 sm:px-5 sm:min-h-[calc(100vh-4rem)]">
  <div class="flex flex-col items-center gap-5">


    <label class="form-control w-full max-w-xs">
      <div class="label">
        <span class="label-text text-xs">Board</span>
      </div>
      <select id="select_board" class="select select-primary w-full max-w-xs" name="select_board" required="true">
        <option value="<?= $userdata['board_name'] ?>" selected><?= $userdata['board_name'] ?></option>
      </select>
    </label>

    <label class="form-control w-full max-w-xs">
      <div class="label">
        <span class="label-text text-xs">Publication</span>
      </div>
      <select id="select_publication" class="select select-primary w-full max-w-xs" name="select_publication" required="true">
        <?php foreach ($publication as $pub) : ?>
          <option value="<?= $pub->id ?>" selected><?= $pub->name ?></option>
        <?php endforeach; ?>
      </select>
    </label>


    <?php if ($userdata['type'] == 'Teacher') : ?>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text text-xs">Subject</span>
        </div>
        <select id="select_subject" class="select select-primary w-full max-w-xs" name="select_subject" required="true">
          <?php foreach ($selectable_subjects as $msub) : ?>
            <option value="<?= $msub->id ?>" <?= $msub->id == $userdata['main_subject'] ? ' selected="selected"' : ''; ?>><?= $msub->name ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text text-xs">Class</span>
        </div>
        <select id="select_classes" class="select select-primary w-full max-w-xs teacherClasses" name="select_classes" required="true">
          <?php foreach ($selectable_classes as $class) : ?>
            <option value="<?= $class->id ?>" <?= $class->id == $userdata['classes'] ? ' selected="selected"' : ''; ?>><?= $class->name ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text text-xs">Book</span>
        </div>
        <select id="select_book" class="select select-primary w-full max-w-xs teacherMsubject" name="select_book" required="true">
          <?php foreach ($selectable_books as $book) : ?>
            <option value="<?= $book->id ?>" <?= $book->id == $userdata['selected_book'] ? ' selected="selected"' : '' ?>><?= $book->name ?></option>
          <?php endforeach; ?>
        </select>
      </label>

    <?php endif; ?>


    <?php if ($userdata['type'] == 'Student') : ?>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text text-xs">Subject</span>
        </div>
        <select id="select_msubject" class="select select-primary w-full max-w-xs" name="select_msubject" required="true">
          <?php foreach ($msubject as $cl) : ?>
            <option value="<?= $cl->id ?>" selected><?= $cl->name ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text text-xs">Class</span>
        </div>
        <select id="select_classes" class="select select-primary w-full max-w-xs" name="select_classes" required="true">
          <?php foreach ($selectable_classes as $class) : ?>
            <?php if ($class->id == $userdata['classes']) : ?>
              <option value="<?= $class->id ?>" selected="selected"><?= $class->name ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </label>

    <?php endif; ?>

  </div>
</div>