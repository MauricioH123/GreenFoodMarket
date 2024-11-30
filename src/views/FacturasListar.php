<?php
namespace App\Views;

class FacturasListar extends BaseView{
    public function render($facturas){
        ob_start();
    ?>
     <!-- <div class="container"> -->
            <h1>Facturas</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID factura</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Total de la factura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facturas as $factura): ?>
                        <tr>
                            <td><?php echo $factura['id_factura']; ?></td>
                            <td><?php echo $factura['nombre']; ?></td>
                            <td><?php echo $factura['fecha']; ?></td>
                            <td><?php echo '$' . number_format($factura['total_factura'], 2); ?></td>
                            <td><a href="index.php">Ver factura</a></td>
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