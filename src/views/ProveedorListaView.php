<?php

namespace App\Views;

class ProveedorListaView extends BaseView
{
    public function render($proveedores)
    {
        ob_start();
?>
        <!-- <div class="container"> -->
        <h1>Productos en la tienda</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id del proveedor</th>
                    <th>Nombre del proveedor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?php echo $proveedor->id_proveedor; ?></td>
                        <td><?php echo $proveedor->nombre_proveedor; ?></td>
                        <td>
                            <form action="index.php?action=eliminarProve" method="post">
                                <input value="<?php echo $proveedor->id_proveedor; ?>" type="hidden" name="id_proveedor">
                                <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $proveedor->id_proveedor; ?>">
                                    Eliminar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-<?php echo $proveedor->id_proveedor; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $proveedor->id_proveedor; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel-<?php echo $proveedor->id_proveedor; ?>">Eliminar proveedor</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de eliminar este proveedor?</p>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar-modal-<?php echo $proveedor->id_proveedor; ?>">
                                Editar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editar-modal-<?php echo $proveedor->id_proveedor; ?>" tabindex="-1" aria-labelledby="editarModalLabel-<?php echo $proveedor->id_proveedor; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="index.php?action=actualizarProve" method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editarModalLabel-<?php echo $proveedor->id_proveedor;?>">Actualizar Proveedor</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input name="id_proveedor" value="<?php echo $proveedor->id_proveedor; ?>" type="hidden">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="nombre-<?php echo $proveedor->id_proveedor; ?>" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre-<?php echo $proveedor->id_proveedor; ?>" name="nombre_proveedor" value="<?php echo $proveedor->nombre_proveedor; ?>">
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
