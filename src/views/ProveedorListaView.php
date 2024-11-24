<?php
namespace App\Views;

class ProveedorListaView extends BaseView{
    public function render($proveedores){
        ob_start();
    ?>
     <!-- <div class="container"> -->
            <h1>Productos en la tienda</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre del proveedor</th>
                        <th>Nombre del producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <tr>
                            <td><?php echo $proveedor->id_proveedor; ?></td>
                            <td><?php echo $proveedor->nombre_proveedor; ?></td>
                            <td>
                                <form action="index.php?action=eliminarP" method="post">
                                        <input value="<?php echo $proveedor->id_proveedor;;?>" type="hidden" name="deleteP">
                                        <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
                                        
                                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $proveedor->id_proveedor;; ?>">
                                Eliminar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?php echo $proveedor->id_proveedor; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $proveedor->id_proveedor;; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel-<?php echo $proveedor->id_proveedor;; ?>">Eliminar producto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de eliminar este producto?</p>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php
        $content = ob_get_clean();
        $this -> renderTemplate($content);
    }
}