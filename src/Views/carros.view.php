<?php view('templates/head.php'); ?>
<?php view('templates/header.php'); ?>

<div class="px-8 grid cols-3 gap-8">

    <?php foreach ($vehicles as $vehicle): ?>

        <div class="border bg-white rounded-4 p-4 flex-col gap-4">
            <img
                src="<?= $vehicle['path'] ?>"
                class="rounded-2"
                style="height: 150px;object-fit: cover;">
            <h3><?= $vehicle['mark'] . ' - ' . $vehicle['model'] . ' - ' . $vehicle['year'] ?></h3>
            <p>R$ <?= $vehicle['price'] ?></p>
        </div>

    <?php endforeach; ?>

</div>

<?php view('templates/footer.php'); ?>