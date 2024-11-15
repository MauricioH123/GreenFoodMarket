<?php

namespace App\Views;

class ProductoCrearView extends BaseView
{
    public function render()
    {
        ob_start();
?>
        <div class="container">
            <h1>Crear Producto</h1>
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
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Precio de Venta</label>
                    <input type="number" step="0.01" id="precioVenta" name="precio_venta" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </form>
        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
