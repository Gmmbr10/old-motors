<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <div class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Funcionários</h2>

        <table>
            <tr>
                <th class="col-2">Código</th>
                <th class="col-7">Nome</th>
                <th class="col-2">Cargo</th>
                <th class="col-2"></th>
            </tr>
            <tr>
                <td>1</td>
                <td>Giovanne</td>
                <td>Desenvolvedor</td>
                <td>
                    <a href="" class="btn">Editar</a>
                </td>
            </tr>
        </table>

    </div>
</div>

<?php view('templates/admin/footer.php'); ?>