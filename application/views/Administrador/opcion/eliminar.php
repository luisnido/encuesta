<h5>Eliminar opcion</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEliminar','id'=>'formularioEliminar');
echo form_open("/entorno/eliminarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=$opcion->result()[0]->frase_percepcion; $idopcion=$opcion->result()[0]->idpercepcion; $valor=$opcion->result()[0]->valor; ?>
<input type='hidden' name='idpercepcion' value='<?php echo $idopcion; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Opcion: ','frase_percepcion',$attLabel); ?>
    <div class="controls">
      <?php echo $nombre; ?>
    </div>
  </div>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Opcion: ','frase_percepcion',$attLabel); ?>
    <div class="controls">
      <?php echo $valor; ?>
    </div>
  </div>
<div class="control-group">
    <div class="controls">     
      <button type="submit" class="btn">Eliminar</button>
    </div>
  </div>
    

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>

  <script>

    $("#formularioEliminar").submit(function(){
        $.post("<?php echo base_url().'administrador/opcion/eliminarPost' ?>", {idpercepcion: $("input[name='idpercepcion']").val()}, function(data){ // Respuesta en formatoo JSON
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