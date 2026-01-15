<header class="headerCommon">
    <img src="<?= base_link("images/logo.png") ?>" alt="Old motors" class="logo">
    <nav>
        <ul class="headerCommon__navbar">
            <li>
                <a href="<?= base_link('/') ?>" class="<?= isUrl('/') ? 'header__link--active' : 'header__link' ?>">Home</a>
            </li>
            <li>
                <a href="<?= base_link('/') ?>" class="<?= isUrl('/carros') ? 'header__link--active' : 'header__link' ?>">Ver Carros</a>
            </li>
        </ul>
    </nav>
</header>
<main class="container">