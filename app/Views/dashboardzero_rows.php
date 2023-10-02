<?php $i = 1 ?>
<?php foreach ($zerotrafic_load as $z) : ?>
    <?php if (empty($_POST['filter_nop']) || $_POST['filter_nop'] === $z['nop']) : ?>
        <tr>
            <th><?= $i++; ?></th>
            <td><?= $z['tech']; ?></td>
            <td><?= $z['date']; ?></td>
            <td><?= $z['cell_name']; ?></td>
            <td><?= $z['site_id']; ?></td>
            <td><?= $z['site_name']; ?></td>
            <td><?= $z['kecamatan']; ?></td>
            <td><?= $z['kabupaten']; ?></td>

            <td><?= $z['nop']; ?></td>
            <td><?= $z['remark']; ?></td>

        </tr>
    <?php endif; ?>
<?php endforeach ?>