<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SALGO.MX</title>
        <link href='http://fonts.googleapis.com/css?family=Quattrocento' rel='stylesheet' type='text/css'>
            <style type="text/css">
                body{ background: url(<? echo base_url("/application/views/landing/bg.gif"); ?>) bottom repeat-x #dfdfdf; margin:0; padding:0; text-align:center;}
                .content{ margin:0 auto; width:1024px; position:relative;}
                .header,.middle,.footer{ margin:0 auto;}
                .footer{ background:url(<? echo base_url("/application/views/landing/footer-city.png"); ?>);bottom: 0;display: block; height: 329px;position: relative;}
                .header{ margin:30px 0px; text-align:center;}
                .header h1{ display:block; height:290px; width:279px; background:url(<? echo base_url("/application/views/landing/logo.png"); ?>) no-repeat; font-size:0px; margin:0 400px;}
                .texto{font-family: 'Quattrocento', serif;  text-align:center}
                .texto span{ display:block; line-height:1.5em}
                .naranja{ color:#ff3300; font-size:38px;}
                .amarillo{ color:#ff6600; font-size:20px;}
                .rosa{ color:#ff3366;font-size:20px;}
            </style>
    </head>

    <body>
        <div class="content">
            <div class="header">
                <h1>Salimos</h1>
            </div>
            <div class="middle">
                <p class="texto">
                    <span class="naranja">&iexcl;Felicidades!</span>
                    <span class="amarillo">Tu registro ha sido completado exitosamente</span>
                    <span class="rosa">Gracias</span>
                    <a href="<?echo base_url('main');?>">Volver a salgo.mx</a>
                </p>
            </div>
            <div class="footer">
            </div>
        </div>
    </body>
</html>
