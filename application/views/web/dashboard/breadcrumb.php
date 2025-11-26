<ul class="flex flex-wrap gap-2 items-center p-2">
    <li class="px-3 py-1 bg-[#9D2973] text-white text-sm font-semibold rounded-full"><?= $this->session->userdata('board_name') ?></li>
    <li class="px-3 py-1 bg-[#9D2973] text-white text-sm font-semibold rounded-full"><?= $this->session->userdata('publication_name') ?></li>
    <li class="px-3 py-1 bg-[#9D2973] text-white text-sm font-semibold rounded-full"><?= $this->session->userdata('class_name') ?></li>
    <li class="px-3 py-1 bg-[#9D2973] text-white text-sm font-semibold rounded-full"><?= $this->session->userdata('category_name') ?></li>
    <input type="text" id="active" value="<?= $this->session->userdata('category') ?>" class="hidden">
</ul>
