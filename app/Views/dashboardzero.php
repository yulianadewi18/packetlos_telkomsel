<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

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
    </main>
    <?= $this->endSection(); ?>