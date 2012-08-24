<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <? if (isset($error)) { ?>
            <h5>Error, email o password equivocado, intente de nuevo.</h5>
        <? } ?>
        <h1>Este es el login</h1>
        <form action="<? echo base_url('login/entrar') ?>" method="POST">
            <label>E-mail</label>
            <input type="text" name="email" value="" />
            <label>Password</label>
            <input type="password" name="password" value="" />
            <input type="submit" value="Entrar" />
        </form>
    </body>
</html>