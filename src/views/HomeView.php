<?php

namespace App\Views;

class HomeView extends BaseView
{
    public function render($jsonVentasDiaria, $jsonVentasMensuales, $jsonComprasDiaria, $jsonComprasMensuales)
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

            <div class="row">
                <div class="col">
                    <div style="text-align: center;">
                        <h2>Compras Diarias</h2>
                        <!-- Contenedor de la gráfica -->
                        <div id="comprasDiarias" style="height: 300px; width: 90%; margin: auto;"></div>
                    </div>
                </div>
                <div class="col">
                    <div style="text-align: center;">
                        <h2>Compras Mensuales</h2>
                        <!-- Contenedor de la gráfica -->
                        <div id="comprasMensuales" style="height: 300px; width: 90%; margin: auto;"></div>
                    </div>

                </div>
            </div>

        </div>

        <script>
            // Datos provenientes de PHP
            var datosDiarios = <?php echo $jsonVentasDiaria; ?>;
            var datosMensuales = <?php echo $jsonVentasMensuales; ?>;
            var datosComprasDiarias = <?php echo $jsonComprasDiaria; ?>;
            var datosComprasMensuales = <?php echo $jsonComprasMensuales; ?>;

            // Opciones para la gráfica
            var opciones = {
                xtitle: "Fecha",
                ytitle: "Ventas ($)",
                legend: true,
                colors: ["#28a745"], // Color verde
                format: "currency" // Formato de moneda
            };

            var opcionesCompra = {
                xtitle: "Fecha",
                ytitle: "Compras ($)",
                legend: true,
                colors: ["#28a745"], // Color verde
                format: "currency" // Formato de moneda
            };

            // Crear la gráfica
            new Chartkick.LineChart("ventasDiarias", datosDiarios, opciones);
            new Chartkick.LineChart("ventasMensuales", datosMensuales, opciones);
            new Chartkick.LineChart("comprasDiarias", datosComprasDiarias, opcionesCompra);
            new Chartkick.LineChart("comprasMensuales", datosComprasMensuales, opcionesCompra);
        </script>


<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
