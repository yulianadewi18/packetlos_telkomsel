<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

<?php

$selectedKabupaten = $_GET['kabupaten'] ?? null;
$selectedKecamatan = $_GET['kecamatan'] ?? null;
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h1 class="mt-3 mb-3"></h1>
            <div class="card">
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 450px;">
                        <canvas id="maps"></canvas>
                        <script>
                            var map = L.map('map').setView([-7.837222, 113.0275], 8);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            <?php foreach ($payload as $index => $value) { ?>
                                $.getJSON("<?= base_url('geo/' . $value['geo']) ?>", function(data) {
                                    geoLayer = L.geoJson(data, {
                                        style: function(feature) {
                                            <?php if ($index <= 10) : ?>
                                                return {
                                                    opacity: 2.0,
                                                    color: 'red',
                                                    fillOpacity: 0.6,
                                                    fillColor: 'red',
                                                }
                                            <?php elseif ($index > 10 && $index < 21) : ?>
                                                return {
                                                    opacity: 2.0,
                                                    color: 'yellow',
                                                    fillOpacity: 0.6,
                                                    fillColor: 'yellow',
                                                }
                                            <?php else : ?>
                                                return {
                                                    opacity: 2.0,
                                                    color: 'green',
                                                    fillOpacity: 0.6,
                                                    fillColor: 'green',
                                                };
                                            <?php endif; ?>
                                        },
                                    }).addTo(map);
                                    geoLayer.eachLayer(function(layer) {
                                        layer.bindPopup("");
                                    });
                                });
                            <?php } ?>
                        </script>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-4">
                <div class="card my-5">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Payload Data</h4>
                        <?php if ($selectedKabupaten !== null || $selectedKecamatan !== null) : ?>
                            <a class="btn btn-primary" href="<?= base_url('Payload') ?>" id="back">Kembali</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table" id="myTable"> <!-- Tambahkan id "myTable" -->
                                <thead>
                                    <tr>
                                        <th>Date
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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    new DataTable('#myTable');
</script>

<?= $this->endSection(); ?>