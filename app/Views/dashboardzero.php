<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">




<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h1 class="mt-4 mb-4">Dashboard Zero</h1>
            <div class="card">
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 450px;">
                        <canvas id="maps"></canvas>
                    </div>

                </div>
            </div>

            <div class="row mt-4">
                <!-- Trend ALL -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
                <!-- NOP Barchart -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
                <!-- TREND NOP -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container-fluid px-4 ">

                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col-4">
                            </div>
                            <!-- Filter by Status -->
                            <div class="col-4">
                                <form class="mt-4 mb-4" method="post">
                                    <div class="input-group">
                                        <select class="form-select" name="filter_nop">
                                            <option value="">Filter by NOP</option>
                                            <option value="LAMONGAN">LAMONGAN</option>
                                            <option value="MALANG">MALANG</option>
                                            <option value="JEMBER">JEMBER</option>
                                            <option value="SURABAYA">SURABAYA</option>
                                            <option value="KEDIRI">KEDIRI</option>
                                            <option value="MADIUN">MADIUN</option>
                                            <option value="SIDOARJO">SIDOARJO</option>
                                            <!-- Add more status options as needed -->
                                        </select>
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                                        
                                    </div>
                                </form>



                            </div>
                        </div>


                        <div class="table table-responsive">
                            <table id="tableZero" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Site ID</th>
                                        <th>Tech</th>
                                        <th>Date</th>
                                        <th>Cell Name</th>
                                        <th>Site Name</th>
                                        <th>Kecamatan</th>
                                        <th>Kabupaten</th>
                                        <th>Provinsi</th>
                                        <th>NOP</th>
                                        <th>Remark</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php if (!empty($zero)) {
                                        foreach ($zero as $z) : ?>
                                            <?php if (empty($_POST['filter_nop']) || $_POST['filter_nop'] == $z['nop']) :  ?>

                                                <tr>
                                                    <td scope="row"><?= $i++; ?></td>
                                                    <td><?= $z['site_id']; ?></td>
                                                    <td><?= $z['tech']; ?></td>
                                                    <td><?= $z['date']; ?></td>
                                                    <td><?= $z['cell_name']; ?></td>
                                                    <td><?= $z['site_name']; ?></td>
                                                    <td><?= $z['kecamatan']; ?></td>
                                                    <td><?= $z['kabupaten']; ?></td>
                                                    <td><?= $z['provinsi']; ?></td>
                                                    <td><?= $z['nop']; ?></td>
                                                    <td><?= $z['remark']; ?></td>

                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach;
                                    } else {
                                        ?>
                                        <tr>
                                            <th colspan="9" class="text-center">Tidak ada data.</th>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
    </main>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>


<script>
    $(document).ready(function() {
        let table = new DataTable('#tableZero',{
            //$('#myTable').DataTable( {
                lengthChange: false,
    dom: 'Bfrtip',
    buttons: [
        'print', 'excel'
    ]
} );

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection(); ?>