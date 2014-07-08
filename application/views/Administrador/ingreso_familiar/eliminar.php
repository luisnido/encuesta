<h5>Eliminar Rango Edad</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEliminar','id'=>'formularioEliminar');
echo form_open("/entorno/eliminarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $minimo=$ingreso->result()[0]->ingresomin; $idingreso=$ingreso->result()[0]->idingresofamiliar; $maximo=$ingreso->result()[0]->ingresomax; ?>
<input type='hidden' name='idingresofamiliar' value='<?php echo $idingreso; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Ingreso Mímino: ','ingresomin',$attLabel); ?>
    <div class="controls">
      <?php echo $minimo; ?>
    </div>
  </div>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Ingeso Máximo: ','ingresomax',$attLabel); ?>
    <div class="controls">
      <?php echo $maximo; ?>
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
        
   
        $.post("<?php echo base_url().'administrador/ingreso_familiar/eliminarPost' ?>", {idingresofamiliar: $("input[name='idingresofamiliar']").val()}, function(data){ // Respuesta en formatoo JSON
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