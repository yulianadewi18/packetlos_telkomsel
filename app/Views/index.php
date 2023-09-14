<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h1 class="mt-4 mb-4">Dashboard</h1>
            <div class="card">
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 450px;">
                        <canvas id="maps"></canvas>
                    </div>

                </div>
            </div>

            <div class="d-flex flex-row-reverse " style="top: 0; right: 0;">
                <div class="card mt-3" style=" border: none;">
                    <div class="card-body">
                        <!-- <form method="post" accept-charset="utf-8" action="<?php echo base_url("Home/index"); ?>"> -->
                        <select name="week">
                            <option>-- Pilih Minggu --</option>
                            <?php foreach ($week as $w) : ?>
                                <option value=" <?= $w['week']; ?>"><?= $w['week']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <!-- </form> -->
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <!-- Elemen Canvas untuk Line Chart (sebelah kiri) -->
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <div id="stackedAreaChart"></div>
                        </div>
                    </div>
                </div>
                <!-- Elemen Canvas untuk Donat Chart (sebelah tengah) -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="donatChart" style="height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Elemen Canvas untuk Bar Chart (sebelah kanan) -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="columnChart" style="height: auto;">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($results as $r) : ?>
                                <label for=""><?= $r['new_nop']; ?></label>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $r['percentage']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $r['percentage']; ?>%">
                                        <?= $r['percentage']; ?> %
                                    </div>
                                </div>

                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>



</div>
</div>
</main>

</div>
</div>


<?= $this->include('scripts/chart') ?>
<?= $this->endSection(); ?>