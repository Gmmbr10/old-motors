<?php view('templates/head.php'); ?>
<?php view('templates/admin/header.php'); ?>

<div class="row">
    <form name="vehicleRegister" method="POST" class="col col-12 bg-white p-4 rounded-2 border flex-col gap-5" enctype="multipart/form-data">
        <h2>Cadastrar veículo</h2>

        <?php if (isset($success)): ?>
            <span class="form-group--success"><?= $success ?></span>
        <?php endif; ?>

        <?php if ($errors['unknown'] ?? false): ?>
            <span class="form-group--error"><?= $errors['unknown'] ?></span>
        <?php endif; ?>

        <input type="hidden" name="vehicleId" value="<?= old('vehicleId', $id) ?>">

        <div class="form-group">
            <label for="imagesInput">Imagens</label>
            <input type="file" name="images[]" id="imagesInput" class="form-group--input" multiple>
            <?php if ($errors['error'] ?? false): ?>
                <span class="form-group--error"><?= $errors['error'] ?></span>
            <?php endif; ?>
            <div id="preview"></div>
            <span class="form-group--error" id="error"></span>
        </div>

        <button class="btn--primary-outline">Cadastrar</button>
    </form>
</div>

<script>
    const input = document.getElementById('imagesInput');
    const preview = document.getElementById('preview');
    const erro = document.getElementById('error');

    const tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
    const tamanhoMaximo = 10 * 1024 * 1024;
    const totalMaximo = 50 * 1024 * 1024;
    const maxImagens = 5;

    input.addEventListener('change', () => {
        preview.innerHTML = '';
        erro.textContent = '';

        const arquivos = Array.from(input.files);

        if (arquivos.length > maxImagens) {
            erro.textContent = `Máximo de ${maxImagens} imagens`;
            input.value = '';
            return;
        }

        let tamanhoTotal = 0;

        arquivos.forEach(file => {
            tamanhoTotal += file.size;

            if (!tiposPermitidos.includes(file.type)) {
                erro.textContent = 'Tipo de imagem inválido';
                input.value = '';
                return;
            }

            if (file.size > tamanhoMaximo) {
                erro.textContent = 'Uma das imagens excede 2MB';
                input.value = '';
                return;
            }
        });

        if (tamanhoTotal > totalMaximo) {
            erro.textContent = 'Tamanho total excede 10MB';
            input.value = '';
            return;
        }

        arquivos.forEach(file => {
            const img = new Image();
            const url = URL.createObjectURL(file);

            img.onload = () => {
                if (img.width < 300 || img.height < 300) {
                    erro.textContent = 'Imagem muito pequena';
                    input.value = '';
                    URL.revokeObjectURL(url);
                    return;
                }

                img.style.maxWidth = '120px';
                img.style.margin = '5px';
                preview.appendChild(img);
            };

            img.src = url;
        });
    });
</script>
<?php view('templates/admin/footer.php'); ?>