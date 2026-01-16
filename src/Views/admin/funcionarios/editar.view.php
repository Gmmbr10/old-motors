<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <form name="employeeUpdate" method="POST" class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Editar funcionário</h2>

        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $employee['id'] ?>">

        <div class="form-group">
            <label for="fullnameInput">Nome completo</label>
            <input type="text" name="fullname" id="fullnameInput" class="form-group--input" placeholder="John Doe" value="<?= old('fullname', $employee['fullname']) ?>">
            <?php if ($errors['fullname'] ?? false): ?>
                <span class="form-group--error"><?= $errors['fullname'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="emailInput">Email</label>
            <input type="email" name="email" id="emailInput" class="form-group--input" placeholder="john.doe@example.com" value="<?= old('email', $employee['email']) ?>">
            <?php if ($errors['email'] ?? false): ?>
                <span class="form-group--error"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="cellnumberInput">Telefone</label>
            <input type="text" pattern="\([\d]{2}\) [\d]{5}\-[\d]{4}" name="cellnumber" id="cellnumberInput" class="form-group--input" placeholder="(xx) xxxxx-xxxx" value="<?= old('cellnumber', $employee['cellnumber']) ?>">
        </div>

        <div class="form-group">
            <label for="positionInput">Cargo</label>
            <select name="position" id="positionInput" class="form-group--select">
                <?php foreach ($types as $type): ?>
                    <?php if ($type->value == 'common') continue; ?>
                    <option value="<?= $type->value ?>" <?= $type->value == $employee['type'] ? 'selected' : '' ?>><?= \Core\Enum\PositionTypes::content($type) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if ($errors['position'] ?? false): ?>
                <span class="form-group--error"><?= $errors['position'] ?></span>
            <?php endif; ?>
        </div>

        <button class="btn--primary-outline">Atualizar</button>
    </form>
</div>

<?php view('templates/admin/footer.php'); ?>