
<?php echo $head ?>
<?php echo $menu ?>
<?php echo $navegacion ?>
<?php if($this->session->flashdata('eliminar')){ echo '<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 <center>  <strong>'.$this->session->flashdata('eliminar').'</strong> </center>
</div>';}?>
<?php if($this->session->flashdata('modificar')){ echo  '<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 <center>  <strong>'.$this->session->flashdata('modificar').'</strong> </center>
</div>';}?>
<?php if($this->session->flashdata('crear')){ echo '<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 <center> <strong>'.$this->session->flashdata('crear').'</strong> </center>
</div>';}?>
<style type="text/css">    
    .container{      
       
    }
</style>
<hr/>
<div class="container">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?php echo $sidebar?>
    </div>
    <div class="span10">

        <a titulo="crear" data-toggle="modal" class="btn btn-success span12" href="" >Para agregar una nueva zona presione aquí</a>
        <table class="table table-hover table-bordered">
            <tr><th>ID Zona</th><th>Nombre Zona</th><th>Jefe Zona</th> <th width='50'>Acciones</th></tr>  
            <?php  if($zonas){?>
            <?php foreach ($zonas->result() as $zona){
            echo '<tr><td>'.$zona->idzona.'</td><td>'.$zona->zona.'</td><td>'.$zona->nombre.'</td><td>
                    <a data-toggle="modal" titulo="editar" id="'.$zona->idzona.'" href="" ><i class="icon-edit"></i></a>&nbsp;
                    <a href="#"><i class="icon-list"></i></a>&nbsp;
                    <a data-toggle="modal" titulo="eliminar" id="'.$zona->idzona.'" href="" ><i class="icon-remove"></i></a></td></tr>';
            }}else{}?>
</table>
       


          
 <?php echo form_fieldset_close()?>
<?php echo form_close();?>
        <?php echo $paginacion; ?>
    </div>
  </div>
</div>
</div>

<div id="crearModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="limpiar();" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Zonas</h3>
  </div>
  <div id="crearBody" class="modal-body">
   
  </div>
  <div class="modal-footer">
    </div>
</div>



<div id="editarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="limpiar();" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Zonas</h3>
  </div>
  <div id="editarBody" class="modal-body">
   
  </div>
  <div class="modal-footer">
    </div>
</div>


<div id="eliminarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="limpiar();" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Zonas</h3>
  </div>
  <div id="eliminarBody" class="modal-body">
   
  </div>
  <div class="modal-footer">
    </div>
</div>

 <script>

  $(document).ready(function(){
      
     
     
      
$('a').click(function() {
   
    var titulo = $(this).attr('titulo');
   
    var idc=$(this).attr('id');
    switch(titulo) {
        case 'crear':
         $(function () 
         { $("#crearModal").modal();  
                  
                  $.ajax({ 
                  url:'<?php echo base_url() ?>administrador/zona/crear/',
                  type:'get'
                  }).done(function(data) {
                 $("#crearBody").html(data);
});
        });
        break;
        case 'editar':
         $(function () 
         { $("#editarModal").modal();  
                
                  $.ajax({ 
                  url:'<?php echo base_url() ?>administrador/zona/editar/'+idc,
                  type:'get'
                  }).done(function(data) {
                      
                 $("#editarBody").html(data);
});
        });
        break;
    case 'eliminar':
        $(function () 
         { $("#eliminarModal").modal();  
                  alert(idc);
                  $.ajax({ 
                  url:'<?php echo base_url() ?>administrador/zona/eliminar/'+idc,
                  type:'get'
                  }).done(function(data) {
                 $("#eliminarBody").html(data);
});
        });
            break;
    }});
});

</script>

<?php echo $foot ?>
