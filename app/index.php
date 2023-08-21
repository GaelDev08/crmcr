
<?php
    error_reporting(E_ERROR | E_PARSE);
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
   //Comprobamos si esta definida la sesión 'tiempo'.
    if(isset($_SESSION['tiempo']) ) {
    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 1200;//20min en este caso.
    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($vida_session > $inactivo)
        {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();              
            //Redirigimos pagina.
            header("Location: ../");
            exit();
        } else {  // si no ha caducado la sesion, actualizamos
            $_SESSION['tiempo'] = time();
        }
    } else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
    }
    $Correo=$_SESSION["use_email"] ;
    $Nivel=$_SESSION["gro_id"];
    $id=$_SESSION["use_id"];
    $ucomid=$_SESSION["com_id"];
    $Usu_usuario=$_SESSION["nomc"];
    if ($id !='') {
        ///
        include "../functions/BD.php";
        $sqlgen = "SELECT CONCAT(g.gro_name,' : ',u.use_name_lastname) as usunom FROM user u, groups g WHERE u.use_id='$id' and u.gro_id = g.gro_id";
        $resgen = mysqli_query($con,$sqlgen);
        $arrgen = mysqli_fetch_array($resgen,MYSQLI_ASSOC);
        $nomtit = $arrgen['usunom'];
        ///
        include "config/Head.php";
        include "config/M_Perfil.php";
        include "config/M_Interna.php";
    
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid" style="max-width:95%">
                    <?php 
            $url=$_GET['menu'];
            $url = preg_replace('([^A-Za-z0-9])', '', $url);
            ///ADMINISTRADOR / EMPRESA PRINCIPAL
            switch ($url){
            case '':                           
            case 'HvaDdWDXGSnWNgkMBuArumVH5gdUftDFWb8E':     
                include "config/VPrincipal.php"; break;
                       
            case 'cKi2cpSq2tSwMAwPgr5STXyxSGnc4C2ju6ny':
                include "views/Filtrar/V_Clientes.php"; break;
                
            case 'MGZDARAUV6tG3yDAFbJV6S7TcR84qY2tvazG':
                include "views/Filtrar/V_Boletas.php"; break; 
                
            case 'UensYuNFd6h5T7neGFJsJpMBxxDEscJ8vDZz':
                include "views/Filtrar/V_Bitacora.php"; break;    

            case 'NrB2EmrgRPkeJ8UKofJAV6dhQ8zjyqEnYEkn':
                include "views/Cliente/V_Cliente.php"; break;

            case 'HREJkBcWG28tyszQTZFgRLWqk7GSjp6yzG6L':
                include "views/Usuarios/V_Usuarios.php"; break; 
                
            case 'YymLxK78WsHPBWFZwtkXxVpqVuipxP53NSNf':
                include "views/Boleta/V_Boleta.php"; break;     

            case 'nRGkZk7QpdpEwvSwwg9wMwHG48TP75BHpfP4':
                include "views/Categoria/V_Categoria.php"; break;
            
            case 'U3WG3HwDihrcGRGNCnjiHaRqNxjtPkATKXkb':
               include "views/Cotizacion/V_Cotizacion.php"; break;
               
            case 'WCgjTHpiFp4K3cAGsHQatToMzYexVznaAfmG':
                include "views/Empresa/V_Empresa.php"; break;

            case 'pAGkUcEfFgweLTdmA6iE4YzvYeMGBMBBx5yo':
                include "views/Remitentes/V_Remitentes.php"; break;
                break;    
            
            case 'eFJLH4QB8NA8qpQtyn8AnHEtnMgZuijsbfGz':
                include "views/Remoto/V_Remoto.php"; break;
                break;    

            case '5GJ4Nm5oEEd3RKvrobCiRFt2dsYhdxEM53iD':
                include "views/Equipos/V_Equipos.php"; break;
                break;    
                     
            default:
                include "views/VPrincipal.php"; break;     
            } 
             // }

             ?>
                    </div>
                </div>
            </div>        
 <?php
    include "config/Footer.php";
    } else {
    echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL= ../">';
    }
 ?>