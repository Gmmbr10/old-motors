<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <form name="employeeRegister" method="POST" class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Cadastrar funcionário</h2>

        <div class="form-group">
            <label for="fullnameInput">Nome completo</label>
            <input type="text" name="fullname" id="fullnameInput" class="form-group--input" placeholder="John Doe">
        </div>

        <div class="form-group">
            <label for="emailInput">Email</label>
            <input type="email" name="email" id="emailInput" class="form-group--input" placeholder="john.doe@example.com">
        </div>

        <div class="form-group">
            <label for="cellInput">Telefone</label>
            <input type="text" pattern="\([\d]{2}\) [\d]{5}\-[\d]{4}" name="cell" id="cellInput" class="form-group--input" placeholder="(xx) xxxxx-xxxx">
        </div>

        <div class="form-group">
            <label for="positionInput">Cargo</label>
            <select name="position" id="positionInput" class="form-group--select">
                <option value="admin">Administrador</option>
                <option value="saleman">Vendedor</option>
            </select>
        </div>

        <button class="btn--primary-outline">Cadastrar</button>
    </form>
</div>

<?php view('templates/admin/footer.php'); ?>