<ul class="m-0 app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><?= $this->session->userdata('board_name') ?></li>
    <li class="breadcrumb-item"><?= $this->session->userdata('publication_name') ?></li>
    <li class="breadcrumb-item"><?= $this->session->userdata('class_name') ?></li>
    <li class="breadcrumb-item"><?= $this->session->userdata('category_name') ?></li>
    <input type="text" id="active" value="<?= $this->session->userdata('category') ?>" class="d-none">
</ul>
