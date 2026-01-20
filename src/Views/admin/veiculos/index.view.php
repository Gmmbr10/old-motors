<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <div class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Veículos</h2>

        <table>
            <tr>
                <th class="col">Marca</th>
                <th class="col">Modelo</th>
                <th class="col">Ano</th>
                <th class="col">Placa</th>
                <th class="col">Preço</th>
                <th class="col"></th>
            </tr>
            <tr>
                <td>Chevrolet</td>
                <td>Caravan</td>
                <td>1979</td>
                <td>CCC-1979</td>
                <td>R$ 500.000,00</td>
                <td>
                    <a href="#" class="btn">Editar</a>
                </td>
            </tr>
        </table>

    </div>
</div>

<?php view('templates/admin/footer.php'); ?>