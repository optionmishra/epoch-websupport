<div class="home-side w-100">
    <div class="wmain_sidebar">
        <ul class="row justify-content-center <?= $user_type === 'Teacher' ? 'userTeacher' : '' ?>">
            <?php foreach ($categories as $cat) { ?>
                <?php if ($cat->allow === 'Both' || $cat->allow === $user_type) { ?>
                    <li class="p-2 my-1 card col-5" id="active<?= $cat->id ?>" style="border-radius:0.5rem">
                        <a tab_id="<?= $cat->id ?>" class="new-search">
                            <img src="<?= base_url('assets/cat_icons/'.$cat->icon) ?>" alt="">
                            <?= $cat->name ?>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
            <li class="p-2 my-1 card col-5"" style="border-radius:0.5rem">
              <a style="color: #fff;" href="https://ai.curiopublishing.in/skip-auth" target="_blank">AI Tools</a>
            </li>
        </ul>
    </div>
</div>
