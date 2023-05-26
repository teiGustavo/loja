<tr>
    <td>
        <?= $product->nome; ?>
    </td>

    <td>
        <?= $product->preco; ?>
    </td>

    <td>
        <?= $product->quantidade; ?>
    </td>

    <td>
        <?= $product->data_cadastro; ?>
    </td>

    <td class="d-none">
        <?= $product->categoria; ?>
    </td>

    <td>
        <button type="button" id="btnEditar" data-action="<?= $router->route("product.find"); ?>" data-update
                data-id="<?= $product->codigo_produto; ?>"
                class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-edit-produto"><i
                    class="nav-icon fas fa-edit"></i>Editar
        </button>

        <button type="button" id="btnExcluir" data-action="<?= $router->route("product.delete"); ?>" data-delete
                data-id="<?= $product->codigo_produto; ?>"
                class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"
                                                 style='margin-right: 0.1rem;'></i>Excluir
        </button>
    </td>
</tr>
