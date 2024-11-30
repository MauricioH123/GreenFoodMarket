<?php

namespace App\Views;

class HomeView extends BaseView
{
    public function render($ventas)
    {
        ob_start();
?>

        <div class="container">
            <div class=" row ">
                <div class="col">
                    <div style="text-align: center;">
                        <h2>Ventas Mensuales</h2>
                        <!-- Contenedor de la gráfica -->
                        <div id="lineChart" style="height: 300px; width: 80%; margin: auto;"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // Datos provenientes de PHP
        var datos = <?php echo $ventas; ?>;

        // Opciones para la gráfica
        var opciones = {
            xtitle: "Fecha",
            ytitle: "Ventas ($)",
            legend: true,
            colors: ["#28a745"], // Color verde
            format: "currency" // Formato de moneda
        };

        // Crear la gráfica
        new Chartkick.LineChart("lineChart", datos, opciones);
    </script>


<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
