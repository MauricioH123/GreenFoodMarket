<?php

namespace App\Views;

class HomeView extends BaseView
{
    public function render($jsonVentasDiaria, $jsonVentasMensuales)
    {
        ob_start();
?>

        <div class="">
            <div class=" row ">
                <div class="col">
                    <div style="text-align: center;">
                        <h2>Ventas Diarias</h2>
                        <!-- Contenedor de la gráfica -->
                        <div id="ventasDiarias" style="height: 300px; width: 90%; margin: auto;"></div>
                    </div>
                </div>
                <div class="col">
                    <div style="text-align: center;">
                        <h2>Ventas Mensuales</h2>
                        <!-- Contenedor de la gráfica -->
                        <div id="ventasMensuales" style="height: 300px; width: 90%; margin: auto;"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Datos provenientes de PHP
            var datosDiarios = <?php echo $jsonVentasDiaria; ?>;
            var datosMensuales = <?php echo $jsonVentasMensuales; ?>;

            // Opciones para la gráfica
            var opciones = {
                xtitle: "Fecha",
                ytitle: "Ventas ($)",
                legend: true,
                colors: ["#28a745"], // Color verde
                format: "currency" // Formato de moneda
            };

            // Crear la gráfica
            new Chartkick.LineChart("ventasDiarias", datosDiarios, opciones);
            new Chartkick.LineChart("ventasMensuales", datosMensuales, opciones);
        </script>


<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
