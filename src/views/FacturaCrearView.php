<?php

namespace App\Views;

class FacturaCrearView extends BaseView
{
    public function render($mensaje, $clientes, $ultimoIdF)
    {
        ob_start();
?>

        <div class="container">
            <h1>Crear factura de venta</h1>

            <?php
            switch ($mensaje) {
                case "Error: El id del producto es invalido":
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: La cantidad unitaria del producto es invalido":
                ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: El precio del producto es invalido":
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: La fecha de ingreso del producto es invalido":
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Entrada creada exitosamente":
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                    break;
            }
            ?>
            <form action="index.php?action=facturaC" method="post">
                <div class="row">

                    <div class="col">
                        <label for="numeroFactura" class="form-label">Numero de la factura</label>
                        <input type="number" dstep="0.01" id="numeroFactura" name="numero_factura" class="form-control" required value="<?= htmlspecialchars($ultimoIdF + 1); ?>" readonly>
                    </div>

                    <div class="col">
                        <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                        <select class="form-select" name="id_cliente" aria-label="Default select example" required>
                            <option selected hidden value="0">---Selecciona el cliente---</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente->id_cliente; ?>"><?php echo $cliente->nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="number" id="idProveedor" name="id_proveedor" class="form-control" required> -->
                        <div id="idHelp" class="form-text">
                            Por favor, ingrese el nombre del producto.
                        </div>
                    </div>

                    <div class="col">
                        <label for="fechaFactura" class="form-label">Fecha de facturacion</label>
                        <input type="date" step="0.01" id="fechaFactura" name="fecha_factura" class="form-control" required>
                        <div id="idHelp" class="form-text">
                            Por favor, ingrese la fecha de facturacion.
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Factura</button>
            </form>

        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
