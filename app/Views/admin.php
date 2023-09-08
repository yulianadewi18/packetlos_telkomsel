<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">

            <div class="row">
                <div class="col">
                    <h1 class="mt-4 mb-4">Admin</h1>
                </div>
                <div class="col-4">
                    <form class="mt-4 mb-4" method="post">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Cari" name="keyword" aria-label="Cari" aria-describedby="btnNavbarSearch" />
                            <button class="btn btn-primary" id="btnNavbarSearch" name="submit" type="submit"><i class="fas fa-search"> </i></button>
                        </div>
                    </form>
                </div>
                <!-- Filter by Status -->
                <div class="col-4">
                    <form class="mt-4 mb-4" method="post">
                        <div class="input-group">
                            <select class="form-select" name="filter_status">
                                <option value="">Filter by Status</option>
                                <option value="SPIKE">SPIKE</option>
                                <option value="CLEAR">CLEAR</option>
                                <option value="CONSECUTIVE">CONSECUTIVE</option>
                                <!-- Add more status options as needed -->
                            </select>
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="table">
                <table class="table border ">
                    <thead class="table-light ">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Week</th>
                            <th scope="col">Site ID</th>
                            <th scope="col">NOP</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">AVG Packet Loss</th>
                            <th scope="col">PL Status</th>
                            <th scope="col">Remark</th>
                            <th scope="col">Aksi</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($packetloss as $p) : ?>
                            <?php if (empty($_POST['filter_status']) || $_POST['filter_status'] == $p['pl_status']) : ?>

                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $p['week']; ?></td>
                                    </td>
                                    <td><?= $p['site_id']; ?></td>
                                    <td><?= $p['nop']; ?></td>
                                    <td><?= $p['kabupaten']; ?></td>
                                    <td><?= $p['avg_packet_loss']; ?></td>
                                    <td><?= $p['pl_status']; ?></td>
                                    <td><?= $p['remark']; ?></td>
                                    <td>
                                        <form method="post">
                                            <button type="button" class="btn btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $p['site_id']; ?>">Edit</button>
                                        </form>
                                                   
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</div>

<?php foreach ($packetloss as $p) : ?>
    <div class="modal fade" id="modalUbah<?= $p['site_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editForm<?= $p['site_id']; ?>" action="<?php echo base_url('admin/edit') ?>">
                        <!-- Hidden input for site_id -->
                        <input type="hidden" name="site_id" value="<?= $p['site_id']; ?>">
                        <div class="mb-3">
                            <label for="pl_status" class="form-label">PL Status</label>
                            <select class="form-select" name="pl_status">
                                <option value="SPIKE" <?= ($p['pl_status'] == 'SPIKE') ? 'selected' : ''; ?>>SPIKE</option>
                                <option value="CLEAR" <?= ($p['pl_status'] == 'CLEAR') ? 'selected' : ''; ?>>CLEAR</option>
                                <option value="CONSECUTIVE" <?= ($p['pl_status'] == 'CONSECUTIVE') ? 'selected' : ''; ?>>CONSECUTIVE</option>
                                <!-- Add more options as needed -->
                            </select>
                            <div class="form-group">
                                <label for="editAvgPacketLoss">Average Packet Loss</label>
                                <input type="text" class="form-control" id="editAvgPacketLoss" name="avg_packet_loss" value="<?= $p['avg_packet_loss']; ?>" oninput="validateAvgPacketLoss(this)" required>
                                <span id="avgPacketLossError" style="color: red;"></span>
                                <script>
                                    function validateAvgPacketLoss(input) {
                                        var avgPacketLoss = input.value;
                                        var filteredAvgPacketLoss = avgPacketLoss.replace(/[^0-9.]/g, ''); // Menghapus karakter selain angka dan titik
                                        var dotsCount = (filteredAvgPacketLoss.match(/\./g) || []).length;

                                        // Menghapus titik tambahan jika ada lebih dari satu
                                        if (dotsCount > 1) {
                                            filteredAvgPacketLoss = filteredAvgPacketLoss.replace(/\./g, (match, offset) => {
                                                return offset === filteredAvgPacketLoss.lastIndexOf('.') ? '.' : '';
                                            });
                                        }

                                        input.value = filteredAvgPacketLoss;

                                        var errorSpan = document.getElementById('avgPacketLossError');

                                        if (filteredAvgPacketLoss !== avgPacketLoss) {
                                            errorSpan.textContent = "Hanya angka dan titik yang diizinkan";
                                        } else {
                                            errorSpan.textContent = "";
                                        }
                                    }

                                    function validateForm(event) {
                                        var avgPacketLossInput = document.getElementById('editAvgPacketLoss');
                                        var avgPacketLoss = avgPacketLossInput.value;
                                        var errorSpan = document.getElementById('avgPacketLossError');

                                        if (avgPacketLoss.trim() === '') {
                                            event.preventDefault(); // Mencegah formulir disubmit
                                            errorSpan.textContent = "Masukkan nilai";
                                        } else {
                                            errorSpan.textContent = "";
                                        }
                                    }
                                </script>


                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="editForm<?= $p['site_id']; ?>" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    new DataTable('#myTable');
</script>

<?= $this->endSection(); ?>