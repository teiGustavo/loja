<tr>
    <td>
        <?= $customer->cpf; ?>
    </td>

    <td>
        <?= $customer->nome; ?>
    </td>

    <td>
        <?= $customer->email; ?>
    </td>

    <td>
        <?= $customer->datacadastro; ?>
    </td>

    <td>
        <button type='button' id='btnEditar' data-action="<?= $router->route("customer.find"); ?>" data-update
            data-id="<?= $customer->id; ?>" class='btn btn-secondary btn-sm' data-toggle='modal'
            data-target='#modal-edit-cliente'><i class='nav-icon fas fa-edit'></i>Editar</button>

        <button type='button' id='btnExcluir' data-action="<?= $router->route("customer.delete"); ?>" data-delete
            data-id="<?= $customer->id; ?>" class='btn btn-danger btn-sm' style='margin-left: 0.25rem;'><i
                class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>
    </td>
</tr>