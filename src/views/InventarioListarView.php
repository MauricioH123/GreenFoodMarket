<?php
namespace App\Views;

class InventarioListarView extends BaseView{
    public function render($inventario)
    {
        ob_start();
?>
        <!-- <div class="container"> -->
        <h1>Inventario</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id del producto</th>
                    <th>Nombre del producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventario as $productos): ?>
                    <tr>
                        <td><?php echo $productos->id_inventario;?></td>
                        <td><?php echo $productos->id_producto;?></td>
                        <td><?php echo $productos->cantidad;?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar-modal-<?php echo $productos->id_inventario;?>">
                                Editar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editar-modal-<?php echo $productos->id_inventario;?>" tabindex="-1" aria-labelledby="editarModalLabel-<?php echo$productos->id_inventario;?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="index.php?action=actualizarInven" method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editarModalLabel-<?php echo $productos->id_inventario;?>">Actualizar Cantidad</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input name="id_producto" value="<?php echo $productos->id_inventario;?>" type="hidden">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="nombre-<?php echo $productos->id_inventario;?>" class="form-label">Cantidad</label>
                                                            <input type="text" class="form-control" id="nombre-<?php echo $productos->id_inventario;?>" name="cantidad_producto" value="<?php echo $productos->cantidad;?>">
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
