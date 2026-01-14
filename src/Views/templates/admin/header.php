<div class="row">
    <header class="header">
        <img src="<?= base_link("public/images/logo.png") ?>" alt="Old motors" class="logo">
        <nav>
            <ul class="header__navbar">
                <li>
                    <a href="<?= base_link("admin/home") ?>" class="header__link--active">Home</a>
                </li>
                <li class="dropdown">
                    <p class="header__link dropdown__btn">Funcionários</p>
                    <div class="dropdown--content">
                        <a href="<?= base_link("admin/funcionarios") ?>" class="header__link">Listar</a>
                        <a href="<?= base_link("admin/funcionarios/cadastrar") ?>" class="header__link">Cadastrar</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container">