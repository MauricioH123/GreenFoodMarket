<?php
namespace App\Views;

class ProductosLista extends BaseView{
    public function render($productos){
        ob_start();
    ?>
     <div class="container">
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
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
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