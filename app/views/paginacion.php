<nav aria-label="Page navigation example">
    <ul class='pagination'>

        <?php

        // BOTON IR A PRIMERA PAGINA
        if ($pagina > 1) {
            $paginaAnterior = $pagina - 1;
            echo "<li class='page-item'>";
            echo "<a class='page-link' href='{$paginaUrl}page={$paginaAnterior}'>";
            echo "<span>Anterior</span>";
            echo "</a>";
            echo "</li>";
        }

        // TOTAL DE PAGINAS
        $totalPaginas = ceil($totalFilas / $tareasPorPagina);

        // BOTONES DE PAGINAS
        $rango = 2;
        $numeroInicio = $pagina - $rango;
        $numeroLimite = ($pagina + $rango)  + 1;
        for ($x = $numeroInicio; $x < $numeroLimite; $x++) {
            if (($x > 0) && ($x <= $totalPaginas)) {
                if ($x == $pagina) {
                    echo "<li class='page-item active'>";
                } else {
                    echo "<li class='page-item'>";
                }
                echo " <a class='page-link' href='{$paginaUrl}page={$x}'>{$x}</a> ";
                echo "</li>";
            }
        }

        // BOTON IR A ULTIMA PAGINA
        if ($pagina < $totalPaginas) {
            $paginaSiguiente = $pagina + 1;
            echo "<li class='page-item'>";
            echo "<a class='page-link' href='{$paginaUrl}page={$paginaSiguiente}'>";
            echo "<span>Siguiente</span>";
            echo "</a>";
            echo "</li>";
        }

        ?>

    </ul>
</nav>