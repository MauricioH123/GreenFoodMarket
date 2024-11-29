<?php

namespace App\Views;

class DetalleFacturaView extends BaseView
{
    public function render($mensaje, $facturas, $productos)
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
                    <div class="col">
                        <label for="idFactura" class="form-label">Numero de factura</label>
                        <select class="form-select" name="id_factura" aria-label="Default select example" required>
                            <option selected hidden value="0">---Selecciona el numero de la factura---</option>
                            <?php foreach ($facturas as $factura): ?>
                                <option value="<?php echo $factura->id_factura; ?>"><?php echo $factura->id_factura; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="number" id="idProveedor" name="id_proveedor" class="form-control" required> -->
                        <div id="idHelp" class="form-text">
                            Por favor, seleccione la factura.
                        </div>
                    </div>
                </div>

                <div id="productos-container" class="mb-3">
                    <div class="row producto">
                        <div class="col">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select class="form-select" name="productos[id_producto][]" required>
                                <option selected hidden value="0">---Selecciona el producto---</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" step="1" name="productos[cantidad][]" class="form-control" required>
                        </div>

                        <div class="col">
                            <label for="precioVenta" class="form-label">Precio de venta</label>
                            <input type="number" step="0.01" name="productos[precio][]" class="form-control" required>
                        </div>
                    </div>
                </div>


                    <button type="button" id="agregar-producto" class="btn btn-secondary">Agregar Producto</button>


                    <button type="submit" class="btn btn-primary">Guardar Detalle</button>


            </form>
        </div>

        <script>
            // JavaScript para agregar dinámicamente productos al formulario.
            document.getElementById('agregar-producto').addEventListener('click', function() {
                const container = document.getElementById('productos-container');
                const productoTemplate = document.querySelector('.producto');
                const nuevoProducto = productoTemplate.cloneNode(true);
                container.appendChild(nuevoProducto);
            });
        </script>

        
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}


