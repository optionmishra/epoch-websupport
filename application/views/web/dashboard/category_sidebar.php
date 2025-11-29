<div class="home-side">
    <div class="wmain_sidebar">
        <ul class="flex flex-wrap gap-4 justify-center <?= $user_type === 'Teacher' ? 'userTeacher' : '' ?>">
            <?php foreach ($categories as $cat) { ?>
                <?php if ($cat->allow === 'Both' || $cat->allow === $user_type) { ?>
                    <li class="my-1 h-60 rounded-md w-44 cursor-pointer hover:bg-[#2F2F91cc] hover:scale-105 transition-all duration-300 ease-in-out" id="active<?= $cat->id ?>" onClick="changeProduct(<?= $cat->id ?>)">
                            <div class="flex gap-5 flex-col">
                                <div class="p-2 h-36">
                                    <img class="rounded-full shadow-[#2F2F91] <?= $this->session->userdata('category_name') === $cat->name ? 'shadow-2xl border-2 border-[#2F2F91]' : 'shadow-lg' ?>" src="<?= base_url('assets/cat_icons/'.$cat->icon) ?>" alt="<?= $cat->name ?>">
                                </div>
                                <div class="bg-[#2F2F91] transition-all rounded-2xl shadow-sm hover:bg-[#2F2F91] w-full text-white my-5 p-2 text-center font-semibold">
                                    <?= $cat->name ?>
                                </div>
                            </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
