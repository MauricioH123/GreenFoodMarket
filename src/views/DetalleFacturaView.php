<?php
namespace App\Views;

class DetalleFacturaView extends BaseView{
    public function render($mensaje, $facturas)
    {
        ob_start();
?>

        <div class="container">
            <h1>Detalle de la factura</h1>

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
            <form action="index.php?action=facturaD" method="post">

            <div class="mb-3">
                    <label for="idFactura" class="form-label">Numero de factura</label>
                    <select class="form-select" name="id_factura" aria-label="Default select example" required>
                        <option selected hidden value="0">---Selecciona el numero de la factura---</option>
                        <?php foreach ($facturas as $factura): ?>
                        <option value="<?php echo $factura->id_factura;?>"><?php echo $factura->id_factura;?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="number" id="idProveedor" name="id_proveedor" class="form-control" required> -->
                    <div id="idHelp" class="form-text">
                        Por favor, seleccione la factura.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Cantidad</label>
                    <input type="number" step="0.01" id="precioVenta" name="cantidad_entrada" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese la cantidad en unidades del producto.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Precio de entrada</label>
                    <input type="number" step="0.01" id="precioVenta" name="precio_entrada" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el precio de entrada del producto.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Fecha de entrada</label>
                    <input type="date" step="0.01" id="precioVenta" name="fecha_entrada" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese la fecha en la que ingreso el producto.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Entrada</button>
            </form>
        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}

