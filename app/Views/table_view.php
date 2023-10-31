<?php if (isset($data)) : ?>
    <table id="data-table" class="table table-striped" style="width: 100%; border-collapse: collapse; margin: 10px 0;">
        <thead style="background-color: #f2f2f2;">
            <tr>
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
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td>
                        <?php if ($hierarki === 'kabupaten') : ?>
                            <a class="hierarki-link" data-hierarki="kecamatan" data-id="<?= $row['kabupaten']; ?>" href="javascript:void(0);">
                                <?= $row['kabupaten']; ?>
                            </a>
                        <?php elseif ($hierarki === 'kecamatan') : ?>
                            <a class="hierarki-link" data-hierarki="site" data-id="<?= $row['kecamatan']; ?>" href="javascript:void(0);">
                                <?= $row['kecamatan']; ?>
                            </a>
                        <?php else : ?>
                            <?= $row['site_id']; ?>
                        <?php endif; ?>
                    </td>
                    <td>Rp <?= number_format($dataModel->convertPayloadToNumeric($row['total_payload']), 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>