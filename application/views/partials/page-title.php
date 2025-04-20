<!-- start page title -->

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"><?= $this->uri->segment(1) == 'indikator' && ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'input') ? '<a href="' . base_url('indikator/' . ($this->uri->segment(2) == 'add' ? 'penetapan' : 'pengisian')) . '" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>' : ''; ?><?= $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $li_1 ?></a></li>
                    <?php if (isset($li_2)) :  ?>
                        <li class="breadcrumb-item active"><?= $li_2 ?></li>
                    <?php endif ?>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->