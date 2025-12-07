<div class="home-side">
    <div class="flex flex-col items-center wmain_sidebar">
        <div class="bg-[#6D3332] transition-all rounded-2xl shadow-sm text-white my-5 p-2 text-center font-semibold uppercase">
            For Teachers & Students
        </div>
        <ul class="flex flex-wrap gap-4 justify-center <?= $user_type === 'Teacher' ? 'userTeacher' : '' ?>">
            <?php foreach ($categories as $cat) { ?>
                <?php if ($cat->allow === 'Both' || $cat->allow === 'Student') { ?>
                  <li class="<?= $cat->allow !== $user_type && $cat->allow !== 'Both' ? 'pointer-events-none cursor-not-allowed' : 'cursor-pointer'  ?> my-1 h-60 rounded-md w-44  hover:bg-[#2F2F91cc] hover:scale-105 transition-all duration-300 ease-in-out" id="active<?= $cat->id ?>" onClick="changeProduct(<?= $cat->id ?>)">
                        <div class="flex flex-col gap-5">
                            <div class="p-2 h-36">
                                <img class="rounded-full shadow-[#2F2F91] <?= $this->session->userdata('category_name') === $cat->name ? 'shadow-2xl border-2 border-[#2F2F91]' : 'shadow-lg' ?>" src="<?= base_url('assets/cat_icons/'.$cat->icon) ?>" alt="<?= $cat->name ?>">
                            </div>
                            <div class="bg-[#2F2F91] transition-all rounded-2xl shadow-sm w-full text-white my-5 p-2 text-center font-semibold">
                                <?= $cat->name ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div class="bg-[#6D3332] transition-all rounded-2xl shadow-sm text-white my-5 p-2 text-center font-semibold uppercase">
            For Teachers Only
        </div>
        <ul class="flex flex-wrap gap-4 justify-center <?= $user_type === 'Teacher' ? 'userTeacher' : '' ?>">
            <?php foreach ($categories as $cat) { ?>
                <?php if ($cat->allow === 'Teacher') { ?>
                    <li class="my-1 h-60 rounded-md w-44 cursor-pointer hover:bg-[#2F2F91cc] hover:scale-105 transition-all duration-300 ease-in-out" id="active<?= $cat->id ?>" onClick="changeProduct(<?= $cat->id ?>)">
                        <div class="flex flex-col gap-5">
                            <div class="p-2 h-36">
                                <img class="rounded-full shadow-[#2F2F91] <?= $this->session->userdata('category_name') === $cat->name ? 'shadow-2xl border-2 border-[#2F2F91]' : 'shadow-lg' ?>" src="<?= base_url('assets/cat_icons/'.$cat->icon) ?>" alt="<?= $cat->name ?>">
                            </div>
                            <div class="bg-[#2F2F91] transition-all rounded-2xl shadow-sm w-full text-white my-5 p-2 text-center font-semibold">
                                <?= $cat->name ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
