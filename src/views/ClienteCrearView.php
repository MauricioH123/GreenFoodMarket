<?php

namespace App\Views;

class ClienteCrearView extends BaseView
{

    public function render($mensaje)
    {
        ob_start();
?>

        <div class="container">
            <h1>Crear Cliente</h1>

            <?php
            switch ($mensaje) {
                case "Error: El nombre del cliente es inválido":
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: El numero de celular es invalido":
                ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: El correo es invalido":
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Se agrego el nuevo cliente":
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;

                case "Error: La direccion es invalida":
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                    break;
            }
            ?>
            <form action="index.php?action=clienteC" method="post">

                <div class="mb-3">
                    <label for="nombreProducto" class="form-label">Nombre del Cliente</label>
                    <input type="text" id="nombreProducto" name="nombre" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el nombre del cliente.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Numero de Celular</label>
                    <input type="number" step="0.01" id="precioVenta" name="numero_celular" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el numero de celular del cliente.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Correo Electronico</label>
                    <input type="email" step="0.01" id="precioVenta" name="correo" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el correo electronico del cliente.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="precioVenta" class="form-label">Direccion del cliente</label>
                    <input type="text" step="0.01" id="precioVenta" name="direccion" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese la direccion del cliente.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
            </form>
        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
