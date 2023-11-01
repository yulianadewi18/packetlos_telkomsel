<?php foreach ($payload as $item): ?>
    <tr>
        <td><?= $item['date']; ?></td>
        <td><a href="<?= base_url('Payload/index/?kabupaten=' . $item['kabupaten']); ?>"><?= $item['kabupaten']; ?></a></td>
        <td><?= $item['total_payload']; ?></td>
        <!-- Tambahkan kolom lain sesuai dengan struktur tabel Anda -->
    </tr>
<?php endforeach; ?>