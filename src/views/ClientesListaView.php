<?php

namespace App\Views;

class ClientesListaView extends BaseView
{
    public function render($clientes)
    {
        ob_start();
?>

        <!-- <div class="container"> -->
        <h1>Clientes de la tienda</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>Numero de Celular</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente->id_cliente; ?></td>
                        <td><?php echo $cliente->nombre; ?></td>
                        <td><?php echo $cliente->numero_celular; ?></td>
                        <td><?php echo $cliente->correo; ?></td>
                        <td><?php echo $cliente->direccion; ?></td>
                        <td>
                            <form action="index.php?action=eliminarC" method="post">
                                <input value="<?php echo $cliente->id_cliente; ?>" type="hidden" name="deleteC">
                                <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eliminar-modal-<?php echo $cliente->id_cliente; ?>">
                                    Eliminar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="eliminar-modal-<?php echo $cliente->id_cliente; ?>" tabindex="-1" aria-labelledby="eliminarModal-<?php echo $cliente->id_cliente; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="eliminarModal-<?php echo $cliente->id_cliente; ?>">Eliminar Cliente</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de eliminar este cliente?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-primary">Sí</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar-modal-<?php echo $cliente->id_cliente; ?>">
                                Editar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editar-modal-<?php echo $cliente->id_cliente; ?>" tabindex="-1" aria-labelledby="editarModalLabel-<?php echo $cliente->id_cliente; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="index.php?action=actualizarC" method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editarModalLabel-<?php echo $cliente->id_cliente; ?> ?>">Actualizar Cliente</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input name="id_cliente" value="<?php echo $cliente->id_cliente; ?>" type="hidden">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="nombre-<?php echo $cliente->id_cliente; ?>" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre-<?php echo $cliente->id_cliente; ?>" name="nombre" value="<?php echo $cliente->nombre; ?>">
                                                        </div>

                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="numero-<?php echo $cliente->id_cliente; ?>" class="form-label">Número de Celular</label>
                                                            <input type="text" class="form-control" id="numero-<?php echo $cliente->id_cliente; ?>" name="numero_celular" value="<?php echo $cliente->numero_celular; ?>">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="correo-<?php echo $cliente->id_cliente; ?>" class="form-label">Correo</label>
                                                            <input type="email" class="form-control" id="correo-<?php echo $cliente->id_cliente; ?>" name="correo" value="<?php echo $cliente->correo; ?>">
                                                        </div>

                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="direccion-<?php echo $cliente->id_cliente; ?>" class="form-label">Dirección</label>
                                                            <input type="text" class="form-control" id="direccion-<?php echo $cliente->id_cliente; ?>" name="direccion" value="<?php echo $cliente->direccion; ?>">
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                </div>
                                            </div>
                                        </form>



                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
