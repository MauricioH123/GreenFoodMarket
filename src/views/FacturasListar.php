<?php

namespace App\Views;

class FacturasListar extends BaseView
{
    public function render($facturas)
    {
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
                        <td>
                            <form action="index.php?action=detalleFV" method="post">
                                <input type="number" hidden name="id_factura" value="<?php echo $factura['id_factura']; ?>">
                                <input type="text" hidden name="nombre" value="<?php echo $factura['nombre']; ?>">
                                <button type="submit" class="btn btn-primary">Ver</button>
                            </form>
                        </td>
                        <td>
                            <form action="index.php?action=imprimirDF" method="post">
                                <input type="number" hidden name="id_factura" value="<?php echo $factura['id_factura']; ?>">
                                <input type="text" hidden name="nombre" value="<?php echo $factura['nombre']; ?>">
                                <button type="submit" class="btn btn-primary">Imprimir</button>
                            </form>
                        </td>
                        <td>
                            <form action="index.php?action=enviarCorreo" method="post">
                                <input type="number" hidden name="id_factura" value="<?php echo $factura['id_factura']; ?>">
                                <input type="text" hidden name="nombre" value="<?php echo $factura['nombre']; ?>">
                                <input type="email" hidden name="correo" value="<?php echo $factura['correo']?>">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
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
