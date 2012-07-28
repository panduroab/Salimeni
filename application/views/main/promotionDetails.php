<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>SALGO.MX - Now</title>
    </head>
    <body>
        <ul>
            <?
            if (isset($promotion))
                foreach ($promotion as $row) {
                    ?>
                    <li>
                        <div>
                            <span><? echo 'Promocion: ' . $row['promotion']; ?></span>
                            <span><? echo 'Nombre: ' . $row['name']; ?></span>
                            <span><? echo 'Lugar: ' . $row['place']; ?></span>
                        </div>
                    </li>
                    <?
                }
            ?>
        </ul>
    </body>
</html>