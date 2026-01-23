<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <form name="vehicleRegister" method="POST" class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Cadastrar veículo</h2>

        <?php if (isset($success)): ?>
            <span class="form-group--success"><?= $success ?></span>
        <?php endif; ?>

        <?php if ($errors['unknown'] ?? false): ?>
            <span class="form-group--error"><?= $errors['unknown'] ?></span>
        <?php endif; ?>

        <div class="form-group">
            <label for="markInput">Marca</label>
            <input type="text" name="mark" id="markInput" class="form-group--input" placeholder="Ex: Chevrolet" value="<?= old('mark') ?>">
            <?php if ($errors['mark'] ?? false): ?>
                <span class="form-group--error"><?= $errors['mark'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="modelInput">Modelo</label>
            <input type="text" name="model" id="modelInput" class="form-group--input" placeholder="Ex: Caravan" value="<?= old('model') ?>">
            <?php if ($errors['model'] ?? false): ?>
                <span class="form-group--error"><?= $errors['model'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="yearInput">Ano</label>
            <input type="number" pattern="[\d]{4}" name="year" id="yearInput" class="form-group--input" placeholder="Ex: 1111" value="<?= old('year') ?>">
            <?php if ($errors['year'] ?? false): ?>
                <span class="form-group--error"><?= $errors['year'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="carPlateInput">Placa</label>
            <input type="text" name="carPlate" id="carPlateInput" class="form-group--input" placeholder="Ex: CCC-1111" value="<?= old('carPlate') ?>">
            <?php if ($errors['carPlate'] ?? false): ?>
                <span class="form-group--error"><?= $errors['carPlate'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="priceInput">Preço</label>
            <input type="number" step="0.01" name="price" id="priceInput" class="form-group--input" placeholder="Ex: 500.000,00" value="<?= old('price') ?>">
            <?php if ($errors['price'] ?? false): ?>
                <span class="form-group--error"><?= $errors['price'] ?></span>
            <?php endif; ?>
        </div>

        <button class="btn--secondary">Continuar</button>
    </form>
</div>

<?php view('templates/admin/footer.php'); ?>