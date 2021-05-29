<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i><?= $this->session->flashdata('success'); ?>..!!!</h5>

    </div>

<?php } ?>

<?php if ($this->session->has_userdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i><?= strip_tags(str_replace('</p>', '', $this->session->flashdata('error'))); ?>..!!!</h5>

    </div>

<?php } ?>