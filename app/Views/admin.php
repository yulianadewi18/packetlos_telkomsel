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
            </div>


            <div class="table">
                <table class="table border ">
                    <thead class="table-light ">
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Week</th>
                            <th scope="col">Site ID</th>
                            <th scope="col">NOP</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">AVG Packet Loss</th>
                            <th scope="col">PL Status</th>
                            <th scope="col">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (25 * ($currentPage - 1)) ?>
                        <?php foreach ($packetloss as $p) : ?>

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
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= $pager->links('packetlos', 'admin_pagination'); ?>
            </div>
        </div>
    </main>
</div>

<?= $this->endSection(); ?>