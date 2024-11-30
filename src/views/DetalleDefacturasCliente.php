<?php
namespace App\Views;

class DetalleDefacturasCliente extends BaseView{
    public function render($productos){
        ob_start();
    ?>
     <!-- <div class="container"> -->
            <h1>Productos en la tienda</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre del producto</th>
                        <th>Cantidad</th>
                        <th>precio unitario</th>
                        <th>Total por producto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['Nombre_producto']; ?></td>
                            <td><?php echo $producto['cantidad_facturada']; ?></td>
                            <td><?php echo '$' . number_format($producto['precio_unitario'], 2); ?></td>
                            <td><?php echo '$' . number_format($producto['Total_factura'], 2); ?></td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php
        $content = ob_get_clean();
        $this -> renderTemplate($content);
    }
}