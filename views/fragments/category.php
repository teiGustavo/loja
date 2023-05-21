<tr>
    <td>
        <?= $category->nome; ?>
    </td>

    <td>
        <?= $category->data_cadastro; ?>
    </td>

    <td>
        <button type='button' id='btnEditar' data-action="<?= $router->route("category.update"); ?>" data-update
            data-id="<?= $category->codigo_categoria; ?>" class='btn btn-secondary btn-sm' data-toggle='modal'
            data-target='#modal-edit-categoria'><i class='nav-icon fas fa-edit'></i>Editar</button>
        <button type='button' id='btnExcluir' data-action="<?= $router->route("category.delete"); ?>" data-delete
            data-id="<?= $category->codigo_categoria; ?>" class='btn btn-danger btn-sm' style='margin-left: 0.25rem;'><i
                class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>
    </td>
</tr>