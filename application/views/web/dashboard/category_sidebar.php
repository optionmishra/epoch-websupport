<div class="home-side">
    <div class="wmain_sidebar">
        <ul class="flex flex-wrap gap-4 justify-center <?= $user_type === 'Teacher' ? 'userTeacher' : '' ?>">
            <?php foreach ($categories as $cat) { ?>
                <?php if ($cat->allow === 'Both' || $cat->allow === $user_type) { ?>
                    <li class="<?= $this->session->userdata('category_name') === $cat->name ? 'bg-blue-300' : 'bg-white dark:bg-gray-500' ?> my-1 h-60 rounded-md w-44 cursor-pointer hover:bg-blue-400 hover:scale-105 transition-all duration-300 ease-in-out" id="active<?= $cat->id ?>" onClick="changeProduct(<?= $cat->id ?>)">
                            <div class="flex gap-5 flex-col">
                                <div class="w-3h-36 p-2 h-36">
                                    <img class="rounded-full shadow-lg" src="<?= base_url('assets/cat_icons/'.$cat->icon) ?>" alt="<?= $cat->name ?>">
                                </div>
                                <div class="bg-blue-700 transition-all shadow-sm hover:bg-blue-800 w-full text-white my-5 p-2 text-center font-semibold">
                                    <?= $cat->name ?>
                                </div>
                            </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
