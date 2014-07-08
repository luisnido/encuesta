<h5>Eliminar entorno</h5>
<hr/> 
<?php $nombre=$zona->result()[0]->zona; 
      $idzona=$zona->result()[0]->idzona; 
      $usuario=$zona->result()[0]->nombre; ?>   
    
    
    <?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEliminar','id'=>'formularioEliminar'); 
echo form_open("/indicador/eliminarPost",$attForm);?>


    
    <?php echo form_fieldset() ?>

<input type='hidden' name='idzona' value='<?php echo $idzona; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','zona',$attLabel); ?>
    <div class="controls">
      <?php echo $nombre; ?>
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Jefe Zona: ','usuario',$attLabel); ?>
    <div class="controls">
      <?php echo $usuario; ?>
    </div>
  </div>
<div class="control-group">
    <div class="controls">     
      <button type="submit" class="btn btn-danger">Eliminar</button>
    </div>
  </div>
    

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>

 <script>

    $("#formularioEliminar").submit(function(){
        $.post("<?php echo base_url().'administrador/zona/eliminarPost' ?>", {idzona: $("input[name='idzona']").val()}, function(data){ // Respuesta en formatoo JSON
            if(data.error){
                alert(data.error);
            }
            else{ if(data.eliminar === "ok"){
                $('#eliminarModal').modal('hide');
                $('#eliminarModal').on('hidden', function () {  location.reload();});
            }}
        }, 'json');
        
        return false;
    });

</script>