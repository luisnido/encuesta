
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

        <a data-toggle="modal" class="btn btn-success span12" href="<?php echo base_url(); ?>entorno/crear" data-target="#crearModal">Para agregar un nuevo entorno presione aquí</a>
        <table class="table table-hover table-bordered">
            <tr><th>Pregunta</th><th>indicador</th> <th width='50'>Acciones</th></tr>  
            <?php if($preguntas){?>
            <?php foreach ($preguntas->result() as $pregunta){
            echo '<tr><td>'.$pregunta->identorno.'</td><td>'.$pregunta->pregunta.'</td><td><a data-toggle="modal" href="'.  base_url().'entorno/editar/'.$pregunta->idpregunta.'" data-target="#editarModal"><i class="icon-edit"></i></a>&nbsp;<a href="#"><i class="icon-list"></i></a>&nbsp;<a data-toggle="modal"  href="'.  base_url().'entorno/eliminar/'.$pregunta->idpregunta.'" data-target="#eliminarModal"><i class="icon-remove"></i></a></td></tr>';
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
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Entornos</h3>
  </div>
  <div id="crearModalBody" class="modal-body">
   
  </div>
  <div class="modal-footer">
    </div>
</div>



<div id="editarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Entornos</h3>
  </div>
  <div class="modal-body">
   
  </div>
  <div class="modal-footer">
    </div>
</div>


<div id="eliminarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Entornos</h3>
  </div>
  <div class="modal-body">
   
  </div>
  <div class="modal-footer">
    </div>
</div>

<?php echo $foot; ?>