<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="mb-4">
    <a href="<?= $rollback ?>" class="headerCommon__link">&larr; Voltar</a>
</div>

<div class="row">
    <form name="vehicleRegister" method="POST" class="col col-6 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Editar veículo</h2>

        <?php if (isset($success)): ?>
            <span class="form-group--success"><?= $success ?></span>
        <?php endif; ?>

        <?php if ($errors['unknown'] ?? false): ?>
            <span class="form-group--error"><?= $errors['unknown'] ?></span>
        <?php endif; ?>

        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $vehicle['id'] ?>">
        <input type="hidden" name="rollback" value="<?= $rollback ?>">

        <div class="form-group">
            <label for="markInput">Marca</label>
            <input type="text" name="mark" id="markInput" class="form-group--input" placeholder="Ex: Chevrolet" value="<?= old('mark', $vehicle['mark']) ?>">
            <?php if ($errors['mark'] ?? false): ?>
                <span class="form-group--error"><?= $errors['mark'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="modelInput">Modelo</label>
            <input type="text" name="model" id="modelInput" class="form-group--input" placeholder="Ex: Caravan" value="<?= old('model', $vehicle['model']) ?>">
            <?php if ($errors['model'] ?? false): ?>
                <span class="form-group--error"><?= $errors['model'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="yearInput">Ano</label>
            <input type="number" pattern="[\d]{4}" name="year" id="yearInput" class="form-group--input" placeholder="Ex: 1111" value="<?= old('year', $vehicle['year']) ?>">
            <?php if ($errors['year'] ?? false): ?>
                <span class="form-group--error"><?= $errors['year'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="carPlateInput">Placa</label>
            <input type="text" name="carPlate" id="carPlateInput" class="form-group--input" placeholder="Ex: CCC-1111" value="<?= old('carPlate', $vehicle['plate']) ?>">
            <?php if ($errors['carPlate'] ?? false): ?>
                <span class="form-group--error"><?= $errors['carPlate'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="priceInput">Preço</label>
            <input type="number" step="0.01" name="price" id="priceInput" class="form-group--input" placeholder="Ex: 500.000,00" value="<?= number_format(old('price', $vehicle['price']), 2, ',', '') ?>">
            <?php if ($errors['price'] ?? false): ?>
                <span class="form-group--error"><?= $errors['price'] ?></span>
            <?php endif; ?>
        </div>

        <button class="btn--primary-outline">Editar</button>
    </form>
</div>

<?php view('templates/admin/footer.php'); ?>