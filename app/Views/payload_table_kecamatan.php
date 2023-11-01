<?php foreach ($payload as $item): ?>
    <tr>
        <td><?= $item['date']; ?></td>
        <td><?= $item['kecamatan']; ?></td>
        <td><?= $item['site_id']; ?></td>
        <td><?= $item['payload']; ?></td>
        <!-- Tambahkan kolom lain sesuai dengan struktur tabel Anda -->
    </tr>
<?php endforeach; ?>