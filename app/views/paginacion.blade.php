<nav aria-label="page navigation">
    <ul class='pagination'>

        <?php
        $totalPaginas = ceil($totalFilas / $tareasPorPagina);
        $paginaSiguiente = $pagina + 1;
        $paginaAnterior = $pagina - 1;
        $rango = 2;
        $numeroInicio = $pagina - $rango;
        $numeroLimite = ($pagina + $rango) + 1;

        $paginas = [];
        for ($x = $numeroInicio; $x < $numeroLimite; $x++) {
            if (($x > 0) && ($x <= $totalPaginas)) {
                $paginas[] = [
                    'active' => $x == $pagina,
                    'numero' => $x
                ];
            }
        }
        ?>

        <!-- BOTON IR A PRIMERA PAGINA -->
        <li class='page-item mr-3 <?= ($pagina > 1) ? "" : "disabled" ?>'>
            <a class='page-link' href='<?= $paginaUrl ?>page=1'>
                <span>Primera</span>
            </a>
        </li>

        <!-- BOTON IR A PAGINA ANTERIOR -->
        <li class='page-item <?= ($pagina > 1) ? "" : "disabled" ?>'>
            <a class='page-link' href='<?= $paginaUrl ?>page=<?= $paginaAnterior ?>'>
                <span>&laquo;</span>
            </a>
        </li>

        <!-- BOTONES DE PAGINAS -->
        <?php foreach ($paginas as $p) : ?>
            <li class='page-item <?= $p['active'] ? 'active' : "" ?>'>
                <a class='page-link' href='<?= $paginaUrl ?>page=<?= $p['numero'] ?>'>
                    <?= $p['numero'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- BOTON IR A SIGUIENTE PAGINA -->
        <li class='page-item <?= ($pagina < $totalPaginas) ? "" : "disabled" ?>'>
            <a class='page-link' href='<?= $paginaUrl ?>page=<?= $paginaSiguiente ?>'>
                <span>&raquo;</span>
            </a>
        </li>

        <!-- BOTON IR A ULTIMA PAGINA -->
        <li class='page-item ml-3 <?= ($pagina < $totalPaginas) ? "" : "disabled" ?>'>
            <a class='page-link' href='<?= $paginaUrl ?>page=<?= $totalPaginas ?>'>
                <span>Última</span>
            </a>
        </li>

    </ul>
</nav>