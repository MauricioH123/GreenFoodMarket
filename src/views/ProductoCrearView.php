<?php

namespace App\Views;

class ProductoCrearView extends BaseView
{
    public function render($mensaje)
    {
        ob_start();
?>
        <div class="container">
            <h1>Crear Producto</h1>

            <?php
            switch ($mensaje) {
                case "Error: ID del proveedor invalido":
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: El nombre del producto es inválido":
                ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: El precio de venta no es válido":
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Producto creado exitosamente":
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                    break;

                case "Error: el Id del proveedor no existe.":
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                    break;
            }
            ?>
            <form action="index.php?action=crearP" method="post">
                <div class="mb-3">
                    <label for="idProveedor" class="form-label">Id del Proveedor</label>
                    <input type="number" id="idProveedor" name="id_proveedor" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el ID del proveedor.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                    <input type="text" id="nombreProducto" name="nombre_producto" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el nombre del producto.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Precio de Venta</label>
                    <input type="number" step="0.01" id="precioVenta" name="precio_venta" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el precio de venta del producto.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </form>
        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
