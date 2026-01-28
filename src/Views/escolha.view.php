<?php view('templates/head.php'); ?>
<?php view('templates/header.php'); ?>

<div class="mb-4">
    <a href="<?= base_link('carros') ?>" class="headerCommon__link">&larr; Voltar</a>
</div>

<div class="row gap-4">
    <div class="col col-6">
        <div class="carousel border rounded-4 bg-white">
            <div class="main-image">
                <?php foreach ($images as $image): ?>
                    <img src="<?= base_link($image['path']) ?>" <?= $image['main'] ? 'class="active"' : '' ?>>
                <?php endforeach; ?>

                <div class="buttons">
                    <button onclick="prevImage()">❮</button>
                    <button onclick="nextImage()">❯</button>
                </div>
            </div>

            <div class="previews">
                <?php foreach ($images as $i => $image): ?>
                    <img src="<?= base_link($image['path']) ?>" <?= $image['main'] ? 'class="active"' : '' ?> onclick="setImage(<?= $i ?>)">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col col-6">
        <div class="border rounded-4 p-4 bg-white flex-col gap-8">
            <h2><?= $vehicle['mark'] . ' ' . $vehicle['model'] ?></h2>
            <ul class="flex-col gap-2">
                <li>Ano: <?= $vehicle['year'] ?></li>
                <li>Placa: <?= $vehicle['plate'] ?></li>
            </ul>
            <span class="badge--third">R$ <?= number_format($vehicle['price'], 2, ',', '.') ?></span>
        </div>
    </div>
</div>
<script>
    const images = document.querySelectorAll('.main-image img');
    const previews = document.querySelectorAll('.previews img');
    let currentIndex = 0;

    function updateCarousel(index) {
        images.forEach(img => img.classList.remove('active'));
        previews.forEach(img => img.classList.remove('active'));

        images[index].classList.add('active');
        previews[index].classList.add('active');
        currentIndex = index;
    }

    function nextImage() {
        let index = (currentIndex + 1) % images.length;
        updateCarousel(index);
    }

    function prevImage() {
        let index = (currentIndex - 1 + images.length) % images.length;
        updateCarousel(index);
    }

    function setImage(index) {
        updateCarousel(index);
    }
</script>
<?php view('templates/footer.php'); ?>