<?php view('templates/head.php'); ?>
<header class="headerCommon justify-center">
    <img src="<?= base_link("images/logo.png") ?>" alt="Old motors" class="logo">
</header>
<main class="container">

    <div class="row justify-center">

        <form method="post" class="col col-4 p-8 bg-white border flex-col gap-5 rounded-4 mt-10">
            <input type="hidden" name="_method" value="POST">
            <h2 class="text-center">Login</h2>

            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" name="email" id="emailInput" class="form-group--input" placeholder="john.doe@example.com" value="<?= old('email') ?>">
                <?php if ($errors['email'] ?? false): ?>
                    <span class="form-group--error"><?= $errors['email'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="passwordInput">Senha</label>
                <input type="password" name="password" id="passwordInput" class="form-group--input">
                <?php if ($errors['password'] ?? false): ?>
                    <span class="form-group--error"><?= $errors['password'] ?></span>
                <?php endif; ?>
            </div>

            <button class="btn--primary">Entrar</button>

        </form>

    </div>

    <?php view('templates/admin/footer.php'); ?>