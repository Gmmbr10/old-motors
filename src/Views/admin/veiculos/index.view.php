<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <div class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Veículos</h2>

        <table>
            <tr>
                <th class="col">Marca</th>
                <th class="col">Modelo</th>
                <th class="col">Ano</th>
                <th class="col">Placa</th>
                <th class="col">Preço</th>
                <th class="col"></th>
            </tr>
            <?php if (sizeof($vehicles) > 0): ?>
                <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?= $vehicle['mark'] ?></td>
                        <td><?= $vehicle['model'] ?></td>
                        <td><?= $vehicle['year'] ?></td>
                        <td><?= $vehicle['plate'] ?></td>
                        <td>R$ <?= number_format($vehicle['price'], 2, ',', '.') ?></td>
                        <td>
                            <a href="<?= base_link('admin/veiculos/editar?id=' . $vehicle['id']) ?>" class="btn--third">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

    </div>
</div>

<?php view('templates/admin/footer.php'); ?>