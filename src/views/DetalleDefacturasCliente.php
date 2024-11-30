<?php
namespace App\Views;

class DetalleDefacturasCliente extends BaseView{
    public function render($productos, $nombreCliente, $id_facturaMostrar){
        ob_start();

        // Calcular el total de la factura
        $totalFactura = 0;
        foreach ($productos as $producto) {
            $totalFactura += $producto['Total_factura'];
        }

        ?>
        <!-- <div class="container"> -->
        <h1>Factura #<?php echo $id_facturaMostrar;?></h1>
        
        <!-- Nombre del cliente en la parte superior izquierda -->
        <div class="row mb-3">
            <div class="col">
                <h3>Cliente: <?php echo $nombreCliente; ?></h3>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre del producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total de la factura alineado a la derecha -->
        <div class="form-group text-end">
            <label for="totalFactura" class="form-label">Total de la factura:</label>
            <input type="text" class="form-control w-auto d-inline-block" id="totalFactura" value="<?php echo '$' . number_format($totalFactura, 2); ?>" readonly>
        </div>

        </div>
        <?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
?>