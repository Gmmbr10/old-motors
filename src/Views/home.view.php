<?php view('templates/head.php'); ?>
<?php view('templates/header.php'); ?>

<div class="carousel">
    <div class="main-image" style="margin: auto; width: 1000px; height: 500px; overflow-y: hidden;">
        <img src="images/1.jpg" class="active" style="height: 100%; object-fit: cover">
        <img src="images/2.jpg" style="height: 100%; object-fit: cover">
        <img src="images/3.jpg" style="height: 100%; object-fit: cover">

        <div class="buttons">
            <button onclick="prevImage()">❮</button>
            <button onclick="nextImage()">❯</button>
        </div>
    </div>

    <div class="previews">
        <img src="images/1.jpg" class="active" onclick="setImage(0)">
        <img src="images/2.jpg" onclick="setImage(1)">
        <img src="images/3.jpg" onclick="setImage(2)">
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

    setInterval(() => {
        nextImage();
    }, 2500);
</script>

<?php view('templates/footer.php'); ?>