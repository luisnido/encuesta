<h5>Eliminar nivel de estudios</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEliminar','id'=>'formularioEliminar');
echo form_open("/entorno/eliminarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=$nivel->result()[0]->nivelestudio; $idnivelestudio=$nivel->result()[0]->idnivelestudio;  ?>
<input type='hidden' name='idnivelestudio' value='<?php echo $idivelestudio; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nivel de Estudios: ','nivelestudio',$attLabel); ?>
    <div class="controls">
      <?php echo $nombre; ?>
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
        $.post("<?php echo base_url().'administrador/nivel_estudio/eliminarPost' ?>", {idnivelestudio: $("input[name='idnivelestudio']").val()}, function(data){ // Respuesta en formatoo JSON
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