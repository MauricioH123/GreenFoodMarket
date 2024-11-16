<?php
namespace App\Views;

class ProductosLista extends BaseView{
    public function render($productos){
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
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto->id; ?></td>
                            <td><?php echo $producto->proveedor; ?></td>
                            <td><?php echo $producto->nombre; ?></td>
                            <td><?php echo '$' . number_format($producto->precio, 2); ?></td>
                            <td>
                                <form action="index.php?action=eliminarP" method="post">
                                        <input value="<?php echo $producto->id;?>" type="hidden" name="deleteP">
                                        <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
                                        
                                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $producto->id; ?>">
                                Eliminar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?php echo $producto->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $producto->id; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel-<?php echo $producto->id; ?>">Eliminar producto</h1>
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