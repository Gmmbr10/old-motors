<div class="row">
    <header class="header">
        <img src="<?= base_link("images/logo.png") ?>" alt="Old motors" class="logo">
        <nav>
            <ul class="header__navbar">
                <li>
                    <a href="<?= base_link("admin/home") ?>" class="<?= isUrl('admin/home') ? 'header__link--active' : 'header__link' ?>">Home</a>
                </li>
                <li class="dropdown">
                    <p class="dropdown__btn <?= isUrl('admin/funcionarios') || isUrl('admin/funcionarios/cadastrar') || isUrl('admin/funcionarios/editar') ? 'header__link--active' : 'header__link' ?>">Funcionários</p>
                    <div class="dropdown--content">
                        <a href="<?= base_link("admin/funcionarios") ?>" class="<?= isUrl('admin/funcionarios') ? 'header__link--active' : 'header__link' ?>">Listar</a>
                        <a href="<?= base_link("admin/funcionarios/cadastrar") ?>" class="<?= isUrl('admin/funcionarios/cadastrar') ? 'header__link--active' : 'header__link' ?>">Cadastrar</a>
                    </div>
                </li>
                <li>
                    <a href="<?= base_link("logout") ?>" class="header__link">Sair</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container">