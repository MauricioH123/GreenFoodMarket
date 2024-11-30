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

            <!-- Mensajes de alerta -->
            <?php
            switch ($mensaje) {
                case "Error: El id del producto es invalido":
                case "Error: La cantidad unitaria del producto es invalido":
                case "Error: El precio del producto es invalido":
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

            <!-- Formulario -->
            <form action="index.php?action=facturaD" method="post">
                <div class="mb-3">
                    <div class="col">
                        <label for="idFactura" class="form-label">Número de factura</label>
                        <select class="form-select" name="id_factura" aria-label="Default select example" required>
                            <option selected hidden value="0">---Selecciona el número de la factura---</option>
                            <?php foreach ($facturas as $factura): ?>
                                <option value="<?php echo $factura->id_factura; ?>"><?php echo $factura->id_factura; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="idHelp" class="form-text">Por favor, seleccione la factura.</div>
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
                            <input type="number" step="1" name="productos[cantidad][]" class="form-control cantidad" required>
                        </div>

                        <div class="col">
                            <label for="precioVenta" class="form-label">Precio de venta</label>
                            <input type="number" step="0.01" name="productos[precio][]" class="form-control precio" required>
                        </div>
                    </div>
                </div>

                <button type="button" id="agregar-producto" class="btn btn-secondary">Agregar Producto</button>

                <div class="mt-3">
                    <h4>Total: <span id="total-factura">0.00</span></h4>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Detalle</button>
            </form>
        </div>

        <script>
            // Formateador de moneda para agregar separadores de miles y decimales
            const formateador = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Actualiza el total de la factura
            function actualizarTotal() {
                let total = 0;
                const productos = document.querySelectorAll('.producto');

                productos.forEach(producto => {
                    const cantidad = parseFloat(producto.querySelector('.cantidad').value) || 0;
                    const precio = parseFloat(producto.querySelector('.precio').value) || 0;
                    total += cantidad * precio;
                });

                // Actualizar el total con formato de moneda
                document.getElementById('total-factura').textContent = formateador.format(total);
            }

            // Agregar un nuevo producto al formulario
            document.getElementById('agregar-producto').addEventListener('click', function() {
                const container = document.getElementById('productos-container');
                const productoTemplate = document.querySelector('.producto');
                const nuevoProducto = productoTemplate.cloneNode(true);

                // Limpiar los campos del nuevo producto
                nuevoProducto.querySelector('.cantidad').value = '';
                nuevoProducto.querySelector('.precio').value = '';
                container.appendChild(nuevoProducto);

                // Reasignar el evento de cambio
                nuevoProducto.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', actualizarTotal);
                });
            });

            // Escucha cambios en cantidad y precio para recalcular el total
            document.querySelectorAll('.cantidad, .precio').forEach(input => {
                input.addEventListener('input', actualizarTotal);
            });
        </script>



<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
