<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="mb-4">
    <a href="<?= $rollback ?>" class="headerCommon__link">&larr; Voltar</a>
</div>

<div class="row gap-5">
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
    <div class="col col-6 gap-5">
        <div class="bg-white p-4 rounded-2 border flex-col gap-5">
            <div class="flex justify-between align-center">
                <h2>Imagens do veículo</h2>
                <a href="<?= base_link('admin/veiculos/cadastrar/imagens?id=' . $vehicle['id']) ?>" class="btn--secondary">&plus;</a>
            </div>

            <?php if (sizeof($images) > 0): ?>
                <?php foreach ($images as $image): ?>
                    <div class="form-group flex justify-between items-center">
                        <img class="col form-group--image" src="<?= base_link($image['path']) ?>" alt="Imagem do <?= $vehicle['mark'] . ' - ' . $vehicle['model'] ?> de <?= $vehicle['year'] ?>">

                        <?php if (!$image['main']): ?>
                            <form name="vehicleUpdate" method="POST" action="<?= base_link('admin/veiculos/imagens/principal') ?>">
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="vehicleId" value="<?= $vehicle['id'] ?>">
                                <input type="hidden" name="imageId" value="<?= $image['id'] ?>">
                                <input type="hidden" name="rollback" value="<?= $rollback ?>">

                                <button
                                    class="btn--secondary-outline">
                                    Tornar principal
                                </button>
                            </form>
                        <?php else: ?>
                            <span class="btn--secondary">Imagem Principal</span>
                        <?php endif; ?>
                        <?php if (sizeof($images) > 1): ?>
                            <form name="vehicleDelete" method="POST" action="<?= base_link('admin/veiculos/imagens?vehicle=' . $vehicle['id']) ?>" id="<?= $image['id'] ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="vehicleId" value="<?= $vehicle['id'] ?>">
                                <input type="hidden" name="imageId" value="<?= $image['id'] ?>">
                                <input type="hidden" name="rollback" value="<?= $rollback ?>">

                                <button
                                    type="button"
                                    class="btn--primary"
                                    onclick="openModalForm('deleteImage',<?= $image['id'] ?>)">
                                    Deletar
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <dialog id="deleteImage" class="modal">

                    <header class="modal__header">
                        <h3>Deletar imagem do veículo</h3>

                        <span class="modal__close-btn" onclick="closeModal('deleteImage')"></span>
                    </header>

                    <main class="modal__content flex-col gap-5">

                        <p>
                            Deseja realmente continuar?
                        </p>

                        <div class="row gap-5">
                            <span class="col btn--primary-outline" onclick="closeModal('deleteImage')">Cancelar</span>
                            <button class="col btn--primary">Deletar</button>
                        </div>

                    </main>

                </dialog>
            <?php else: ?>
                <p>Nenhuma imagem foi encontrada!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php view('templates/admin/footer.php'); ?>