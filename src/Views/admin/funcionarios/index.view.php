<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <div class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5">
        <h2>Funcionários</h2>

        <table>
            <tr>
                <th class="col-1">Código</th>
                <th class="col-7">Nome</th>
                <th class="col-3">Cargo</th>
                <th class="col-1"></th>
            </tr>

            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= $employee['id'] ?></td>
                    <td><?= $employee['fullname'] ?></td>
                    <td><?= \Core\Enum\PositionTypes::content(\Core\Enum\PositionTypes::from($employee['type'])) ?></td>
                    <td>
                        <?php if ($employee['id'] != \Core\Session::get('user')['id']): ?>
                            <a href="<?= base_link('admin/funcionarios/editar?employee=' . $employee['id']) ?>" class="btn">Editar</a>
                        <?php else: ?>
                            <span class="btn--primary">Você</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($pagesNumber > 1): ?>

            <nav class="pagination">
                <table class="pagination__table">
                    <tr>
                        <?php if ($currentPage > ($range + 1)): ?>
                            <td>
                                <a class="pagination__link" href="<?= base_link('admin/funcionarios') ?>">
                                    1
                                </a>
                            </td>
                        <?php endif; ?>

                        <?php if ($currentPage > ($range + 2)): ?>
                            <td>
                                <span class="pagination__dots">
                                    ...
                                </span>
                            </td>
                        <?php endif; ?>

                        <?php for ($page = $start; $page <= $end; $page++): ?>
                            <td>
                                <a class="<?= $currentPage == $page ? 'pagination__link--active' : 'pagination__link' ?>" href="<?= base_link($page == 1 ? 'admin/funcionarios' : 'admin/funcionarios?page=' . $page) ?>">
                                    <?= $page ?>
                                </a>
                            </td>
                        <?php endfor; ?>

                        <?php if ($currentPage < ($pagesNumber - $range - 1)): ?>
                            <td>
                                <span class="pagination__dots">
                                    ...
                                </span>
                            </td>
                        <?php endif; ?>

                        <?php if ($currentPage < ($pagesNumber - $range)): ?>
                            <td class="pagination__link">
                                <a class="pagination__link" href="<?= base_link('admin/funcionarios?page=' . $pagesNumber) ?>">
                                    <?= $pagesNumber ?>
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                </table>
            </nav>

        <?php endif; ?>

    </div>
</div>

<?php view('templates/admin/footer.php'); ?>