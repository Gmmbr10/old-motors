<?php view('templates/head.php'); ?>
<header class="headerCommon justify-center">
    <img src="<?= base_link("public/images/logo.png") ?>" alt="Old motors" class="logo">
</header>
<main class="container">

    <div class="row justify-center">

        <form class="col col-4 p-8 bg-white border flex-col gap-5 rounded-4 mt-10">
            <h2 class="text-center">Login</h2>

            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" name="email" id="emailInput" class="form-group--input" placeholder="john.doe@example.com">
            </div>

            <div class="form-group">
                <label for="passwordInput">Senha</label>
                <input type="password" name="password" id="passwordInput" class="form-group--input">
            </div>

            <button class="btn--primary">Entrar</button>

        </form>

    </div>

    <?php view('templates/admin/footer.php'); ?>