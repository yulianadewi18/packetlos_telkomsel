<?php foreach ($payload as $item): ?>
    <tr>
        <td><?= $item['date']; ?></td>
        <td><a href="<?= base_url('Payload/index/?kecamatan=' . $item['kecamatan']); ?>"><?= $item['kecamatan']; ?></a></td>
        <td><?= $item['payload']; ?></td>
        <!-- Tambahkan kolom lain sesuai dengan struktur tabel Anda -->
    </tr>
<?php endforeach; ?>