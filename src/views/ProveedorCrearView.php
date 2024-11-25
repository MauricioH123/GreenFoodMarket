<?php
namespace App\Views;

class ProveedorCrearView extends BaseView{
    
    public function render($mensaje)
    {
        ob_start();
?>

        <div class="container">
            <h1>Crear Proveedor</h1>

            <?php
            switch ($mensaje) {
                case "Error: El nombre del proveedor es inválido":
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;
                case "Se creo el proveedor con exito":
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    break;
            }
            ?>
            <form action="index.php?action=proveedorC" method="post">

                <div class="mb-3">
                    <label for="nombreProducto" class="form-label">Nombre del proveedor</label>
                    <input type="text" id="nombreProducto" name="nombre_proveedor" class="form-control" required>
                    <div id="idHelp" class="form-text">
                        Por favor, ingrese el nombre del proveedor.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
            </form>
        </div>
<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}