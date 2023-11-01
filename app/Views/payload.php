<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<?php
    $selectedKabupaten = $_GET['kabupaten'] ?? null;
    $selectedKecamatan = $_GET['kecamatan'] ?? null;
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <div class="card my-5">
                <div class="card-header d-flex justify-content-between">
                    <h4>Payload Data</h4>
                    <?php if ($selectedKabupaten !== null || $selectedKecamatan !== null): ?>
                        <a class="btn btn-primary" href="<?=base_url('Payload')?>">Kembali</a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Date</th>

                                <?php if ($selectedKabupaten == "" && $selectedKecamatan == ""): ?>
                                    <th>Kabupaten</th>
                                <?php endif; ?>
                                <?php if ($selectedKabupaten !== null): ?>
                                    <th>Kecamatan</th>
                                <?php endif; ?>
                                <?php if ($selectedKecamatan !== null): ?>
                                    <th>Kecamatan</th>
                                    <th>Site Id</th>
                                <?php endif; ?>
                                <th>Payload</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($selectedKabupaten !== null): ?>
                            <?= view('payload_table_kabupaten', ['payload' => $payload]);?>
                        <?php elseif ($selectedKecamatan !== null): ?>
                            <?= view('payload_table_kecamatan', ['payload' => $payload]);?>
                        <?php else: ?>
                            <?= view('payload_table_default', ['payload' => $payload]);?>
                        <?php endif; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
     var table = $('#myTable').DataTable();
</script>
<?= $this->endSection(); ?>