<? if (isset($error)) { ?>
    <h5>Error, email o password equivocado, intente de nuevo.</h5>
<? } ?>
<h2>Bienvenido</h2>
<form action="<? echo base_url('login/entrar') ?>" method="POST">
    <label>E-mail</label>
    <input type="text" name="email" value="" />
    <label>Password</label>
    <input type="password" name="password" value="" />
    <input type="submit" value="Entrar" />
</form>