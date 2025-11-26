<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
    <?php $this->session->unset_userdata('success'); ?>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        <strong><?php echo $this->session->flashdata('error'); ?></strong>
    </div>
    <?php $this->session->unset_userdata('error'); ?>
<?php } ?>
