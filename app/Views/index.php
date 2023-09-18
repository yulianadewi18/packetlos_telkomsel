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
                            <?php
                            // Urutkan hasil berdasarkan persentase secara menurun
                            // usort($results, function ($a, $b) {
                            //     return $b['percentage'] <=> $a['percentage'];
                            // });

                            // Ambil hanya 7 teratas
                            $topResults = array_slice($results, 0, 7);

                            foreach ($topResults as $index => $r) :
                                $percentage = $r['percentage'];
                                $progressClass = '';
                                switch (true) {
                                    case ($index == 0):
                                        $progressClass = 'background-color: #38B000'; // Hijau
                                        break;
                                    case ($index == 1):
                                        $progressClass = 'background-color: #008000';
                                        break;
                                    case ($index == 2):
                                        $progressClass = 'background-color: #007200';
                                        break;
                                    case ($index == 3):
                                        $progressClass = 'background-color: #004B23';
                                        break;
                                    case ($index == 4):
                                        $progressClass = 'background-color: #6A040F';
                                        break;
                                    case ($index == 5):
                                        $progressClass = 'background-color: #9D0208';
                                        break;
                                    case ($index == 6):
                                        $progressClass = 'background-color: #D00000'; //Merah
                                        break;
                                    default:
                                        $progressClass = 'bg-secondary'; // Warna default jika tidak ada yang cocok
                                        break;
                                }
                            ?>
                                <div class="row g-0 text-left ">
                                    <div class="col-4">
                                        <div class="label">
                                            <label class="" style="font-size: 12px;"><?= $r['new_nop']; ?></label>
                                            <?php if ($index < 3) : ?>
                                                <i class="fas fa-trophy text-warning "></i> <!-- Ganti dengan ikon pemenang yang sesuai -->
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-6 my-1">
                                        <div class="progress ">
                                            <div class="progress-bar <?= $progressClass; ?>" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="<?= $progressClass ?>; width: <?= $percentage; ?>% ; background-color:;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 my-1">
                                        <div class="text-center" style="color: black; font-size: 9px;"><?= $percentage; ?> %</div>
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