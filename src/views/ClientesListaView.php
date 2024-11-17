<?php
namespace App\Views;

class ClientesListaView extends BaseView{
    public function render($clientes){
        ob_start();
    ?>

    <!-- <div class="container"> -->
    <h1>Clientes de la tienda</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Cliente</th>
                        <th>Nombre</th>
                        <th>Numero de Celular</th>
                        <th>Correo</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente->id_cliente; ?></td>
                            <td><?php echo $cliente->nombre; ?></td>
                            <td><?php echo $cliente->numero_celular; ?></td>
                            <td><?php echo $cliente->correo; ?></td>
                            <td><?php echo $cliente->direccion; ?></td>
                            <td>
                                <form action="index.php?action=eliminarC" method="post">
                                        <input value="<?php echo $cliente->id_cliente;?>" type="hidden" name="deleteC">
                                        <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
                                        
                                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $cliente->id_cliente; ?>">
                                Eliminar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?php echo $cliente->id_cliente; ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $cliente->id_cliente; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel-<?php echo $cliente->id_cliente; ?>">Eliminar producto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de eliminar este producto?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-primary">Sí</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </form>
                            </td>
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
