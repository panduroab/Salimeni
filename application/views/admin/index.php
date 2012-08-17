<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>SALGO.MX</title>
    </head>
    <body>
        <ul>
            <?
            if (isset($users)) {
                foreach ($users as $value) {
                    ?>
                    <li><? echo $value['name']; ?></li>
                    <?
                }
            } else if (isset($places)) {
                foreach ($places as $value) {
                    ?>
                    <li><? echo $value['name']; ?></li>
                    <?
                }
            }
            ?>
        </ul>
    </body>
</html>