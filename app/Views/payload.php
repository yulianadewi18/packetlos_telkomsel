<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

<?php
$selectedKabupaten = $_GET['kabupaten'] ?? null;
$selectedKecamatan = $_GET['kecamatan'] ?? null;
?>
<!-- Tambahkan elemen indikator loading data -->


<div id="load" style="display: inline;">
    Loading...
</div>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card my-5">
                <div class="card-header d-flex justify-content-between">
                    <h4>Payload Data</h4>
                    <?php if ($selectedKabupaten !== null || $selectedKecamatan !== null) : ?>
                        <a class="btn btn-primary" href="<?= base_url('Payload') ?>" id="back">Kembali</a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="myTable"> <!-- Tambahkan id "myTable" -->
                            <thead>
                                <tr>
                                    <th>Date>
                                        <?php if ($selectedKabupaten == "" && $selectedKecamatan == "") : ?>
                                    <th>Kabupaten</th>
                                <?php endif; ?>
                                <?php if ($selectedKabupaten !== null) : ?>
                                    <th>Kecamatan</th>
                                <?php endif; ?>
                                <?php if ($selectedKecamatan !== null) : ?>
                                    <th>Kecamatan</th>
                                    <th>Site Id</th>
                                <?php endif; ?>
                                <th>Payload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($selectedKabupaten !== null) : ?>
                                    <?php foreach ($payload as $item) : ?>
                                        <tr>
                                            <td><?= $item['date']; ?></td>
                                            <td><a href="<?= base_url('Payload/index/?kecamatan=' . $item['kecamatan']); ?> " style="text-decoration: none; color: black; cursor: pointer;" onmouseover="this.style.textDecoration='underline'; this.style.color='blue';" onmouseout="this.style.textDecoration='none'; this.style.color='black';"><?= $item['kecamatan']; ?></a></td>
                                            <td><?= $item['payload']; ?></td>
                                            <!-- Tambahkan kolom lain sesuai dengan struktur tabel Anda -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php elseif ($selectedKecamatan !== null) : ?>
                                    <?php foreach ($payload as $item) : ?>
                                        <tr>
                                            <td><?= $item['date']; ?></td>
                                            <td><?= $item['kecamatan']; ?></td>
                                            <td><?= $item['site_id']; ?></td>
                                            <td><?= $item['payload']; ?></td>
                                            <!-- Tambahkan kolom lain sesuai dengan struktur tabel Anda -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach ($payload as $item) : ?>
                                        <tr>
                                            <td><?= $item['date']; ?></td>
                                            <td><a href="<?= base_url('Payload/index/?kabupaten=' . $item['kabupaten']); ?>" style="text-decoration: none; color: black; cursor: pointer;" onmouseover="this.style.textDecoration='underline'; this.style.color='blue';" onmouseout="this.style.textDecoration='none'; this.style.color='black';"><?= $item['kabupaten']; ?></a></td>
                                            <td><?= $item['total_payload']; ?></td>
                                            <!-- Tambahkan kolom lain sesuai dengan struktur tabel Anda -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="loading" class="overlay">
                    <!-- <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i> -->
                </div>
            </div>
        </div>
    </main>
</div>

<!-- <div id="loading" class="overlay">
    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
</div> -->

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#load').fadeOut(500);



        // $('#myTable tbody').on('click', 'a', function() {
        //     var rowData = table.row(this).data();
        //     var kabupaten = rowData[10];
        $('a').click(function() {
            // $('<div class=loadingDiv>loading...</div>').prependTo(document.body);
            // e.preventDefault();

            $('#loading').addClass('overlay');
            $('#loading').html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
            // $('#loading').html('<div style="display: flex; justify-content: center; align-items: center;"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i><div>')
            setTimeout(RemoveClass, 100);
        })

        function RemoveClass() {
            $('#loading').RemoveClass('overlay');
            $('#loading').fadeOut();
        }
    });

    // $("#load").load(payload.php);
    // var table = $('#myTable').DataTable();
    // var loadingIndicator = $('#loading-indicator');
    // $("#result").load(url);
    // $('#table-payload tbody').on('click', 'tr', function() {
    //     var rowData = table.row(this).data();
    //     var kecamatan = rowData[2];
    //     e.preventDefault();

    // Menampilkan indikator loading data
    // loadingIndicator.show();

    // $.ajax({
    //     url: 'http://localhost:8080/Controller/Payload',
    //     type: 'POST',
    //     data: {
    //         kecamatan: kecamatan
    //     },
    // success: function(response) {
    // Menyembunyikan indikator loading data
    // loadingIndicator.hide();

    // Memperbarui tabel dengan data kecamatan yang diambil
    // $('#table-payload tbody').html(response);
    // $('#loading').addClass('overlay');
    // $('#loading').html('<i class="fa fa-spinner fa-spin"></i>');
    // setTimeout(removeClass, 100);
    //     }
    // });

    //     function removeClass() {
    //         $('#loading').removeClass('overlay');
    //         $('#loading').fadeOut();
    //     }
    // });

    // $('#goBack').on('click', function(e) {
    //     e.preventDefault();
    //     // Lakukan apa yang diperlukan untuk kembali ke halaman sebelumnya
    // });
    // });
</script>

<?= $this->endSection(); ?>