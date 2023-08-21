
 <?php 
  include "../../../functions/BD.php";
  
  $ftitulo = $_POST['ftitulo']; 
  $empid = $_POST['empid'];
  $univel = $_POST['univel'];
  $modd = $_POST['modd'];
  $pname = $_POST['pname'];
  ////
      $stylei = '<div class="badge badge-soft-success font-size-12">';
      $stylei2 = '<div class="badge badge-soft-danger font-size-12">';
      $stylef = '</div>';
  $sqldet = "SELECT *,(CASE WHEN mop_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
  ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2  FROM module_main WHERE mod_id='$modd'";
  $rdet = mysqli_query($con,$sqldet);

 ?>
  <link rel="stylesheet" href="views/Modulos/jquery-simple-tree-table.css"></script>
  <div class="row" id="opcion">

    <input type="hidden" id="bempid" value="<?=$empid;?>"> 
    <!-- <input type="hidden" id="bid"    value="<?=$idusu;?>">
    <input type="hidden" id="prodd" value="<?=$prodd;?>">-->
    
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-cogs"></i>&nbsp;<?=$ftitulo.': <small> Modulo de '.$pname.'</small>';?> </h4>
                </div>
                  <div class="col-lg-6 text-right">
                    <a href="#" class="btn btn-success mb-1" id="btnMenu"><i class="mdi mdi-plus mr-1"></i> Menu</a>
                    <button class="btn btn-warning mb-1" id="btnRegre"><i class="mdi mdi-arrow-left mr-1"></i> Atras</button>
                  </div>
                </div>
               
         
        <div class="input-group mb-3 mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Buscar</span>
            </div>
            <input id="FiltrarContenido" type="text" class="form-control" placeholder="Ingrese nombre" aria-label="Alumno" aria-describedby="basic-addon1">
        </div>
        <table id="basic2" class="table datatable table-hover table-bordered">
          <tbody class="BusquedaRapida">
            
            <th style="background:#041043; color: white;">Titulo</th>
            <th class="text-center" style="background:#041043; color: white;">Estatus</th>
            <th class="text-center" style="background:#041043; color: white;">Acciones</th>
            <?php 
              $cuenta =0;
              while($row=mysqli_fetch_array($rdet,MYSQLI_ASSOC)){ ?>
              <tr data-node-id="<?=$row['mop_id'];?>" data-node-pid="<?=$row['mop_parent_id'];?>">
                  <td><?=$row['mop_name'];?></td>
                  <td class="text-center"><?=$row['status2'];?></td>
                  <td class="text-center"><button class='btn btn-info btn-sm mdi mdi-playlist-plus font-size-14 btnAddc' title='AGREGAR'></button> <button class='btn btn-warning btn-sm mdi mdi-playlist-edit font-size-14 btnEdit' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim'  title='HABILITAR / DESHABILITAR'></button></td>
              </tr>
            <?php
              }
              ?>
            </tbody>
          </table>  

            
        </div> 
     </div> <!--card-->
  </div>
</div>
<script src="views/Modulos/jquery-simple-tree-table.js"></script>
<script>
  $('#basic2').simpleTreeTable({
    expander: $('#expander'),
    collapser: $('#collapser'),
    storeState: true
  });
  </script>
<script type="text/javascript">
  $(document).ready(function() {
  var butipo, bgrupo, opcion, bid, bnivel, bempid, prodd;  
  bempid = $.trim($('#bempid').val());
  
  $('#FiltrarContenido').focus();
   (function($) {
       $('#FiltrarContenido').keyup(function () {
            var ValorBusqueda = new RegExp($(this).val(), 'i');
            $('.BusquedaRapida tr').hide();
             $('.BusquedaRapida tr').filter(function () {
                return ValorBusqueda.test($(this).text());
              }).show();
                })
      }(jQuery));
      
  $("#btnRegre").click(function(e){
     e.preventDefault();
     refresh();
  });

  function refresh() {
    setTimeout(function () {
        location.reload()
    }, 1500);
  }

  });
</script>