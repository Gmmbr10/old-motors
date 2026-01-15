<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <form name="employeeRegister" method="POST" class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Cadastrar funcionário</h2>

        <div class="form-group">
            <label for="fullnameInput">Nome completo</label>
            <input type="text" name="fullname" id="fullnameInput" class="form-group--input" placeholder="John Doe" value="<?= old('fullname') ?>">
            <?php if ($errors['fullname'] ?? false): ?>
                <span class="form-group--error"><?= $errors['fullname'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="emailInput">Email</label>
            <input type="email" name="email" id="emailInput" class="form-group--input" placeholder="john.doe@example.com" value="<?= old('email') ?>">
            <?php if ($errors['email'] ?? false): ?>
                <span class="form-group--error"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="cellnumberInput">Telefone</label>
            <input type="text" pattern="\([\d]{2}\) [\d]{5}\-[\d]{4}" name="cellnumber" id="cellnumberInput" class="form-group--input" placeholder="(xx) xxxxx-xxxx" value="<?= old('cellnumber') ?>">
        </div>

        <div class="form-group">
            <label for="positionInput">Cargo</label>
            <select name="position" id="positionInput" class="form-group--select">
                <?php foreach ($types as $type): ?>
                    <?php if ($type->value == 'common') continue; ?>
                    <option value="<?= $type->value ?>"><?= \Core\Enum\PositionTypes::content($type) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if ($errors['position'] ?? false): ?>
                <span class="form-group--error"><?= $errors['position'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="defaultPasswordInput">Senha padrão</label>
            <input type="text" name="defaultPassword" id="defaultPasswordInput" class="form-group--input" value="oldMotors" readonly disabled>
        </div>

        <button class="btn--primary-outline">Cadastrar</button>
    </form>
</div>

<?php view('templates/admin/footer.php'); ?>