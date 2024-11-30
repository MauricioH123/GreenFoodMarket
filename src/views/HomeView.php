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
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjO7WU8jB8wVDasnt-MMRi4qmxdXs-y04vNONkQfv99WV8Pck4gcKIItc_S9CbrM4uX34&usqp=CAU" class="img-fluid" alt="...">
            </div>
        </div>


<?php
        $content = ob_get_clean();
        $this->renderTemplate($content);
    }
}
