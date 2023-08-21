<?php
   session_start();
?>
<HTML LANG="es">
<HEAD>
<TITLE>Desconectar</TITLE>
</HEAD>
<BODY>

<?php
if (isset($_SESSION["usuario_valido"]))
    {
      unset($_SESSION["usuario_valido"]);
      //Destruimos sesión.
      session_destroy();              
      //Redirigimos pagina.    
      echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL= ../">';
      echo"<p>&nbsp;</p>";
      echo"<p>&nbsp;</p>";
      echo"<p>&nbsp;</p>";
      echo"<p>&nbsp;</p>";
      print ("<p><center></center></p>\n");
      print ("<p ALIGN='CENTER'></p>\n");
    }
 else
   {
    echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL= ../">';
    print ("<p ALIGN='CENTER'></p>\n");
   }
?>

</BODY>
</HTML>
