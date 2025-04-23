<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php $this->load->view('partials/head-css') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">

</head>

<?php $this->load->view('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <?php $this->load->view('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?php $this->load->view('partials/page-title') ?>
                <!-- end page title -->

                <?php if ($this->session->admin | $this->session->admin2) : ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <select class="form-control select2" name="pilih-skpd" id="pilih-skpd" style="width: 100%;" required>
                                <option value="all" selected>Semua OPD</option>
                                <?php foreach ($props['skpd_list'] as $ks => $vs) : ?>
                                    <option value="<?= $vs['id_skpd'] ?>" <?= $vs['id_skpd'] == $this->uri->segment(3, 0) ? 'selected' : '' ?>><?= $vs['nama_skpd']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border border-primary">
                            <div class="card-header bg-primary">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Indikator</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class=""><?= $props['stats_indikator']['konfirmasi_ok']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-warning">
                            <div class="card-header bg-warning">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Data</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class=""><?= array_sum($props['stats_data']['data']) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-success">
                            <div class="card-header bg-success">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Progres</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class=""><?= $props['stats_data']['total'] ?>%</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Progres Pengisian Data</h4>
                                    <a href="https://wa.me/<?= $props['stats_indikator']['telp_skpd'] ?? '' ?>?text=<?= urlencode("Progress pengisian " . ($props['stats_indikator']['nama_skpd'] ?? 'OPD') . " " . $props['stats_data']['total'] . "%, dengan rincian:\n\n" . implode("\n", array_map(function($k, $v, $i) { return ($i+1) . ". " . $k . " " . $v . "%"; }, array_keys($props['stats_data']['detail']), array_values($props['stats_data']['detail']), array_keys(array_keys($props['stats_data']['detail']))))) ?>" 
                                    class="btn btn-success" target="_blank">
                                        <i class="mdi mdi-whatsapp me-1"></i> Share Progress
                                    </a>
                                </div>
                                <div>
                                    <div class="progress animated-progess mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $props['stats_data']['total'] ?>%" aria-valuenow="<?= $props['stats_data']['total'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <thead class="bg-primary text-light">
                                        <tr class="text-center">
                                            <?php foreach ($props['stats_data']['detail'] as $kd => $vd) : ?>
                                                <th><?= $kd; ?></th>
                                            <?php endforeach ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <?php foreach ($props['stats_data']['detail'] as $kd => $vd) : ?>
                                                <td><?= $vd; ?>%</td>
                                            <?php endforeach ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                <div class="col-md-8">
                                        <h4>Daftar Indikator</h4>
                                        </p>
                                    </div>
                                    <?php if ($this->session->admin | $this->session->admin2) : ?>
                                    <div class="col-md-2 d-flex align-items-end justify-content-end">
                                        <select class="form-control select2" name="pilih-tagar" id="pilih-tagar" style="width: 100%;" required>
                                            <option value="" selected>Semua Tagar</option>
                                            <!-- <option value="">Semua Tagar</option> -->
                                            <?php foreach ($props['tagar_list'] as $ks => $vs) : ?>
                                                <option value="<?= $vs['id_tagar'] ?>" <?= $vs['id_tagar'] == $this->uri->segment(4, 0) ? 'selected' : '' ?>><?= $vs['nama_tagar']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-sm-2 col-md-2 align-items-center justify-content-center">
                                        <?php if ($this->uri->segment(3) != null || !$this->session->admin) : ?>
                                            <div class="d-flex align-items-center">
                                                <div class="dropdown me-2">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Export <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="<?= base_url('download/download/data/excel/' . ($this->session->admin ? $this->uri->segment(3) : null)) ?>" target="_blank" id="btn-all">Semua Data</a>
                                                        <a class="dropdown-item" href="<?= base_url('download/download/penetapan/pdf') ?>" id="btn-pilih">Pilih Data</a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">Import</a>    
                                                </div>
                                            </div>
                                            

                                            <!-- Import Modal -->
                                            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="importModalLabel">Import Indikator (Excel)</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control" id="importFile" accept=".xlsx,.xls,.csv">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button id="previewImport" class="btn btn-primary">Preview Data</button>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="importPreviewContainer" class="d-none">
                                                                <div class="table-responsive">
                                                                    <table id="importPreviewTable" class="table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr id="headerRow">
                                                                                <!-- Dynamic headers will be inserted here -->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="importPreviewBody">
                                                                            <!-- Dynamic rows will be inserted here -->
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="button" class="btn btn-primary" id="saveImportedData">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tb_indikator" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="max-width: 20%;">Nama Indikator</th>
                                            <th style="max-width: 30%;">Definisi Operasional</th>
                                            <th style="max-width: 10%;">Satuan</th>
                                            <th style="max-width: 20%;">Tagar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php $this->load->view('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<div id="modal-detail" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-cetak" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">cetak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?= base_url() ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>
<script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script>
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    // $('#pilih-skpd').on('change', function(e) {
    //     e.preventDefault();
    //     showPreloader();
    //     var id = $(this).val();
    //     window.open(base_url + 'indikator/pengisian/' + id, '_self');
    // })

    $('#pilih-skpd').on('change', function(e) {
        e.preventDefault();
        showPreloader();
        var id = $(this).val();
        var idt = $('#pilih-tagar').val(); // Mendapatkan nilai dari dropdown tagar
        if (id != null && id !== "all") {
            var url = base_url + 'indikator/pengisian/' + id;
            if (idt != null && idt !== "all") {
                url += '/' + idt;
            }
            window.location.href = url;
        }else if(id == "all"){
            window.open(base_url + 'indikator/pengisian/all/' + idt, '_self'); // Menambahkan nilai idt setelah id

        }
    });


    $('#pilih-tagar').on('change', function(e) {
        e.preventDefault();
        showPreloader();
        var idt = $(this).val();
        var id = $('#pilih-skpd').val(); // Mengambil nilai dari dropdown skpd
        if (id != null && id !== "all"){
            window.open(base_url + 'indikator/pengisian/' + id + '/' + idt, '_self'); // Menambahkan nilai idt setelah id
        }else if( id == "all"){
            window.open(base_url + 'indikator/pengisian/all/' + idt, '_self'); // Menambahkan nilai idt setelah id
        }else if(id == null){
            window.open(base_url + 'indikator/pengisian/all/' + idt, '_self'); // Menambahkan nilai idt setelah id
        }
    })


    // $(document).on('change', '#pilih-skpd, #pilih-tagar', function(event) {
    //     event.preventDefault();
    //     showPreloader();

    //     var id = $('#pilih-skpd').val();
    //     var idt = $('#pilih-tagar').val();

    //     // Build URL with optional parameters
    //     var url = base_url + 'indikator/pengisian/';
    //     if (id) {
    //         url += id;
    //     }
    //     if (idt) {
    //         url += (id ? '&' : '') + idt;  // Add '&' if id is already present
    //     }

    //     window.open(url, '_self');
    //     });

    var tb_indikator = $('#tb_indikator').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "ajax": {
            url: base_url + 'indikator/get_indikator_list/input/<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : null ?>/<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(4) : null ?>',
            type: 'POST'
        },
        scrollX: true,
        drawCallback: function() {
            $('.btn-detail').on('click', function(e) {
                e.preventDefault();

                showPreloader()
                var btn = $(this);
                btn.attr('disabled', true)
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                var id = $(this).data('id');
                var modal = $('#modal-detail');
                $.post(base_url + 'indikator/get_datas', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Data');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                        hidePreloader();
                        btn.attr('disabled', false)
                        btn.html('<i class="far fa-eye"></i> Lihat');
                    });
            });
            $('.btn-input').on('click', function(e) {
                e.preventDefault();

                showPreloader()
                var btn = $(this);
                btn.attr('disabled', true)
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                var id = $(this).data('id');
                window.open(base_url + 'indikator/input/' + id, '_self');
            });
        },
    });

    $('#btn-pilih').on('click', function(e) {
        e.preventDefault();
        var modal = $('#modal-cetak');
        $.post(base_url + 'indikator/cetak/pilih//<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : null ?>/<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(4) : null ?>', {
                // id: id,
            })
            .done(function(data) {
                modal.find('.modal-title').html('Data');
                modal.find('.modal-body').html(data);
                modal.modal('show');
            });
    })
</script>

<!-- Add this in your script section -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>
$(document).ready(function() {
    let importedData = [];
    let mappedFields = {};
    let rowCounter = 0; // For unique row IDs
    
    $('#previewImport').on('click', function() {
        const fileInput = $('#importFile')[0];
        const file = fileInput.files[0];
        
        if (!file) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Silakan pilih file terlebih dahulu'
            });
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {type: 'array'});
            const sheetName = workbook.SheetNames[0];
            const worksheet = workbook.Sheets[sheetName];
            
            // Get all data from the worksheet
            const allData = XLSX.utils.sheet_to_json(worksheet, {header: 1, defval: '', blankrows: false});
            
            // Skip the first row (index 0)
            importedData = allData.length > 1 ? allData.slice(1) : [];
            
            // If no data left after skipping the first row, provide a default header
            if (importedData.length === 0) {
                importedData = [['Column 1']]; // Default header if empty
            }
            
            renderImportPreview(importedData);
        };
        reader.readAsArrayBuffer(file);
    });

    function renderImportPreview(data) {
        const headerRow = $('#headerRow');
        const previewBody = $('#importPreviewBody');
        const fieldMappingContainer = $('#fieldMappingContainer');
        
        // Clear previous data
        headerRow.empty();
        previewBody.empty();
        fieldMappingContainer.empty();
        rowCounter = 0;

        // Render headers
        data[0].forEach((header, index) => {
            headerRow.append(`
                <th class="column-header" data-index="${index}">
                    <div class="d-flex align-items-center">
                        <span class="header-text">${header || 'Column ' + (index + 1)}</span>
                        <i class="bx bx-move ms-2 handle" style="cursor: move;"></i>
                    </div>
                </th>
            `);
        });
        
        // Add "Add Column" button
        headerRow.append(`
            <th style="width: 40px;">
                <button class="btn btn-sm btn-success add-column">+</button>
            </th>
        `);

        // Render data rows
        if (data.length > 1) {
            data.slice(1).forEach((row, rowIndex) => {
                const rowId = 'row-' + (++rowCounter);
                const rowHtml = $('<tr>', {
                    id: rowId,
                    class: 'data-row',
                    'data-row-index': rowIndex
                });
                
                // Add drag handle at the beginning of each row
                // rowHtml.append(`
                //     <td style="width: 30px; vertical-align: middle;">
                //         <i class="bx bx-move row-handle" style="cursor: move;"></i>
                //     </td>
                // `);
                
                // Add cells without individual drag handles
                row.forEach((cell, cellIndex) => {
                    const cellContent = cell === '' || cell === null || cell === undefined ? '-' : cell;
                    rowHtml.append(`
                        <td class="editable-cell" data-row="${rowId}" data-col="${cellIndex}">
                            <span class="cell-content">${cellContent}</span>
                        </td>
                    `);
                });
                
                // Add delete row button
                rowHtml.append(`
                    <td>
                        <button class="btn btn-sm btn-danger delete-row">×</button>
                    </td>
                `);
                
                previewBody.append(rowHtml);
            });
        }

        // Add "Add Row" button row
        const addRowHtml = $('<tr>');
        addRowHtml.append(`
            <td colspan="${data[0].length + 2}" class="text-center">
                <button class="btn btn-sm btn-primary add-row">Add New Row</button>
            </td>
        `);
        previewBody.append(addRowHtml);

        // Initialize sortable for headers
        $("#headerRow").sortable({
            handle: '.handle',
            items: 'th.column-header',
            update: function(event, ui) {
                updateColumnOrder();
                console.log('Current table data:', getTableData());
            }
        });
        
        // Initialize sortable for rows
        $("#importPreviewBody").sortable({
            handle: '.row-handle',
            items: 'tr.data-row',
            axis: 'y',
            update: function(event, ui) {
                updateRowOrder();
                console.log('Current table data:', getTableData());
            }
        });
        
        // Make cells editable on click
        setupCellEditing();
        
        // Button handlers
        setupButtonHandlers();

        $('#importPreviewContainer').removeClass('d-none');
        
        // Log initial table data
        console.log('Initial table data:', getTableData());
    }
    
    function setupCellEditing() {
        $('#importPreviewTable').on('click', '.editable-cell', function() {
            const cell = $(this);
            const currentContent = cell.find('.cell-content').text().trim();
            const isEditing = cell.data('editing');
            
            if (isEditing) return;
            
            cell.data('editing', true);
            const contentSpan = cell.find('.cell-content');
            const originalText = currentContent === '-' ? '' : currentContent;
            
            contentSpan.html(`<input type="text" class="form-control form-control-sm cell-input" value="${originalText}">`);
            const input = contentSpan.find('input');
            input.focus().select();
            
            input.on('blur', function() {
                const newValue = input.val().trim() || '-';
                contentSpan.text(newValue);
                cell.data('editing', false);
                
                // Update data
                updateCellData(cell, newValue);
                console.log('Current table data:', getTableData());
            });
            
            input.on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    input.blur();
                }
            });
        });
    }
    
    function setupButtonHandlers() {
        // Add column button
        $('#importPreviewTable').on('click', '.add-column', function() {
            const columnCount = $('#headerRow th.column-header').length;
            
            // Add new header
            $(this).parent().before(`
                <th class="column-header" data-index="${columnCount}">
                    <div class="d-flex align-items-center">
                        <span class="header-text">New Column</span>
                        <i class="bx bx-move ms-2 handle" style="cursor: move;"></i>
                    </div>
                </th>
            `);
            
            // Add cells to each data row
            $('.data-row').each(function() {
                const rowId = $(this).attr('id');
                $(this).find('td:last').before(`
                    <td class="editable-cell" data-row="${rowId}" data-col="${columnCount}">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-move me-2 row-handle" style="cursor: move;"></i>
                            <span class="cell-content">-</span>
                        </div>
                    </td>
                `);
            });
            
            console.log('Added column. Current table data:', getTableData());
        });
        
        // Add row button
        $('#importPreviewTable').on('click', '.add-row', function() {
            const rowId = 'row-' + (++rowCounter);
            const columnCount = $('#headerRow th.column-header').length;
            const newRow = $('<tr>', {
                id: rowId,
                class: 'data-row',
                'data-row-index': $('.data-row').length
            });
            
            for (let i = 0; i < columnCount; i++) {
                newRow.append(`
                    <td class="editable-cell" data-row="${rowId}" data-col="${i}">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-move me-2 row-handle" style="cursor: move;"></i>
                            <span class="cell-content">-</span>
                        </div>
                    </td>
                `);
            }
            
            // Add delete button
            newRow.append(`
                <td>
                    <button class="btn btn-sm btn-danger delete-row">×</button>
                </td>
            `);
            
            $(this).closest('tr').before(newRow);
            console.log('Added row. Current table data:', getTableData());
        });
        
        // Delete row button
        $('#importPreviewTable').on('click', '.delete-row', function() {
            $(this).closest('tr').remove();
            console.log('Deleted row. Current table data:', getTableData());
        });
        
        // Edit header
        $('#headerRow').on('click', '.header-text', function() {
            const headerCell = $(this);
            const currentText = headerCell.text().trim();
            headerCell.html(`<input type="text" class="form-control form-control-sm header-input" value="${currentText}">`);
            const input = headerCell.find('input');
            input.focus().select();
            
            input.on('blur', function() {
                const newValue = input.val().trim() || 'Untitled';
                headerCell.text(newValue);
                console.log('Updated header. Current table data:', getTableData());
            });
            
            input.on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    input.blur();
                }
            });
        });
    }
    
    function updateColumnOrder() {
        // Just log the new order - the actual data is retrieved from the DOM
        // when needed via getTableData()
        const headers = [];
        $('#headerRow th.column-header').each(function() {
            headers.push($(this).find('.header-text').text().trim());
        });
        console.log('New column order:', headers);
    }
    
    function updateRowOrder() {
        // Just log the new order - the actual data is retrieved from the DOM
        // when needed via getTableData()
        console.log('Rows reordered');
    }
    
    function updateCellData(cell, newValue) {
        // Update is handled through getTableData() when needed
        console.log(`Cell updated: ${cell.data('row')}, col ${cell.data('col')} to "${newValue}"`);
    }
    
    function getTableData() {
        const data = [];
        
        // Get headers
        const headers = [];
        $('#headerRow th.column-header').each(function() {
            headers.push($(this).find('.header-text').text().trim());
        });
        data.push(headers);
        
        // Get rows
        $('.data-row').each(function() {
            const rowData = [];
            $(this).find('.editable-cell').each(function() {
                const cellValue = $(this).find('.cell-content').text().trim();
                rowData.push(cellValue === '-' ? '' : cellValue);
            });
            data.push(rowData);
        });
        
        return data;
    }
    
    // Save imported data
    $('#saveImportedData').on('click', function() {
        // Get current table data
        const tableData = getTableData();
        const previewBody = $('#importPreviewBody');
        
        // Show loading state
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
        
        // Send data to server
        $.ajax({
            url: base_url + 'indikator/import_data',
            type: 'POST',
            data: {
                data: tableData
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message
                    });
                    $('#importModal').modal('hide');
                    
                    // Reload data table
                    tb_data.ajax.reload();
                    previewBody.empty();
                    
                    // Update chart if needed
                    if (typeof update_chart === 'function') {
                        update_chart();
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message || 'Gagal mengimpor data'
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan saat mengimpor data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: errorMessage
                });
            },
            complete: function() {
                // Reset button state
                $('#saveImportedData').prop('disabled', false).html('Simpan');
            }
        });
    });
});

$(document).ready(function() {
    // Format the WhatsApp share message
    function formatWhatsAppMessage() {
        const skpdName = <?= json_encode($props['stats_indikator']['nama_skpd'] ?? 'OPD') ?>;
        const totalProgress = <?= json_encode($props['stats_data']['total']) ?>;
        
        let message = `Progress pengisian ${skpdName} ${totalProgress}%, dengan rincian:\n\n`;
        
        // Add year details
        let counter = 1;
        <?php foreach ($props['stats_data']['detail'] as $year => $progress) : ?>
        message += `${counter}. ${year} ${<?= json_encode($progress) ?>}%\n`;
        counter++;
        <?php endforeach; ?>
        
        return encodeURIComponent(message);
    }
    
    // Create the WhatsApp share button
    const whatsappBtn = $('<a>', {
        class: 'btn btn-success ms-2',
        href: `https://wa.me/${<?= json_encode($props['stats_indikator']['telp_skpd'] ?? '') ?>}?text=${formatWhatsAppMessage()}`,
        target: '_blank',
        html: '<i class="mdi mdi-whatsapp me-1"></i> Share Progress'
    });
    
    // Add the button next to the progress bar
    $('.progress.animated-progess').parent().append(whatsappBtn);
});

</script>


</body>

</html>