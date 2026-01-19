<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="mb-4">
    <a href="<?= $rollback ?>" class="headerCommon__link">&larr; Voltar</a>
</div>

<div class="row gap-5">
    <form name="employeeUpdate" method="POST" class="col col-6 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Editar dados do funcionário</h2>

        <?php if (isset($success['data'])): ?>
            <span class="form-group--success"><?= $success['data'] ?></span>
        <?php endif; ?>

        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $employee['id'] ?>">
        <input type="hidden" name="rollback" value="<?= $rollback ?>">

        <div class="form-group">
            <label for="employeeId">Código</label>
            <input type="text" name="employeeId" value="<?= $employee['id'] ?>" readonly disabled class="form-group--input">
        </div>

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
    <div class="col col-6 gap-5">
        <form name="employeePassword" method="POST" action="<?= base_link('admin/funcionarios/editar/senha?employee=' . $employee['id']) ?>" class="row bg-white border rounded-2 p-4 flex-col gap-5 mb-5">
            <h2>Reiniciar senha</h2>

            <?php if (isset($success['password'])): ?>
                <span class="form-group--success"><?= $success['password'] ?></span>
            <?php endif; ?>

            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
            <input type="hidden" name="rollback" value="<?= $rollback ?>">

            <div class="form-group">
                <label for="defaultPasswordInput">Senha</label>
                <input type="text" name="defaultPassword" id="defaultPasswordInput" class="form-group--input" value="oldMotors" readonly disabled>
            </div>

            <button class="btn--primary-outline">Reiniciar senha</button>
        </form>
        <form name="employeeDelete" method="POST" action="<?= base_link('admin/funcionarios/deletar?employee=' . $employee['id']) ?>" class="row bg-white border rounded-2 p-4 flex-col gap-5">
            <h2>Deletar</h2>

            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
            <input type="hidden" name="rollback" value="<?= $rollback ?>">

            <p>
                Ao clicar em Deletar, este funcionário será removido permanentemente dos registros do sistema.
                Essa ação é irreversível e todas as informações vinculadas serão apagadas.
                Certifique-se de que deseja continuar antes de confirmar.
            </p>

            <dialog id="delete" class="modal">

                <header class="modal__header">
                    <h3>Deletar funcionário</h3>

                    <span class="modal__close-btn" onclick="closeModal('delete')"></span>
                </header>

                <main class="modal__content flex-col gap-5">

                    <p>
                        Deseja realmente continuar?
                    </p>

                    <div class="row gap-5">
                        <span class="col btn--primary-outline" onclick="closeModal('delete')">Cancelar</span>
                        <button class="col btn--primary">Deletar</button>
                    </div>

                </main>

            </dialog>

            <button type="button" onclick="openModal('delete')" class="btn--primary-outline">Deletar</button>
        </form>
    </div>
</div>

<?php view('templates/admin/footer.php'); ?>