<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tuavenida.com</title>

        <link rel="stylesheet" href="css/main.css" type="text/css" />

        <script>
            function actualizarPadre(valor)
            {
                // form1 corresponde al nombre del formulario de la pagina contenedora o principal
                // campo1 es el nombre del campo donde se ingresara el valor en la pagina principal
                //parent.document.form1.campo1.value = valor;
                parent.document.location.href=valor;
                window.parent.Shadowbox.close();
            }
        </script>
    </head>

    <body>

        <div id="idiomashadow" align="center">
            <table  border="0" cellspacing="0" width="346" height="239">
                <tr>
                    <td class="idiomashadow_logo" height="59" colspan="3" align="left"><img src="images/logo.png" width="320" height="115" /></td>
                </tr>
                <tr>
                    <td class="idiomashadow_logo" height="50" colspan="3" align="left">
                        <p>BIENVENIDO, selecciona tu país de residencia WELCOME, select your country of residence</p></td></tr> 

                <tr>
                    <td width="33%" align="center"><a href="javascript:actualizarPadre('index.php?idioma=br')" ><img src="images\banderas\br.png"/><br>Brasil</br></a></td>
                    <td width="33%" align="center"><a href="javascript:actualizarPadre('index.php?idioma=co')" ><img src="images\banderas\co.png" /><br>Colombia</br></a></td>

                    <td width="33%" align="center"><a href="javascript:actualizarPadre('index.php?idioma=us')" ><img src="images\banderas\us.png" /><br>USA</br></a></td>
                </tr>

            </table>
        </div>
    </body>
</html>
