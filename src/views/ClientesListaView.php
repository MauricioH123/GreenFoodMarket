<?php
namespace App\Views;

class ClientesListaView extends BaseView{
    public function render($clientes){
        ob_start();
    ?>

    <!-- <div class="container"> -->
    <h1>Productos en la tienda</h1>
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
