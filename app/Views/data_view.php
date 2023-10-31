<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="container-fluid px-4">
    <div id="layoutSidenav_content">
        <main>
            <?php if (isset($data)) : ?>
                <table id="table-payload" class="table table-striped" style="width: 100%; border-collapse: collapse; margin: 10px 0;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 5%;">No.</th>
                            <?php if ($hierarki === 'kabupaten') : ?>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kabupaten</th>
                            <?php elseif ($hierarki === 'kecamatan') : ?>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kecamatan</th>
                            <?php elseif ($hierarki === 'site') : ?>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Site ID</th>
                            <?php endif; ?>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Total Payload</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td>
                                    <?php if ($hierarki === 'kabupaten') : ?>
                                        <a href="<?= base_url('data/kecamatan/' . $row['kabupaten']); ?>" style="color: black; text-decoration: none;">
                                            <?= $row['kabupaten']; ?>
                                        </a>
                                    <?php elseif ($hierarki === 'kecamatan') : ?>
                                        <a href="<?= base_url('data/site/' . $row['kecamatan']); ?>" style="color: black; text-decoration: none;">
                                            <?= $row['kecamatan']; ?>
                                        </a>
                                    <?php else : ?>
                                        <span style="color: black; text-decoration: none;"><?= $row['site_id']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?= number_format($dataModel->convertPayloadToNumeric($row['total_payload']), 2, ',', '.'); ?></td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#table-payload').DataTable();
    // });
    new DataTable('#table-payload');
</script>
<?= $this->endSection(); ?>