<h5>Eliminar Situacion Laboral</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEliminar','id'=>'formularioEliminar');
echo form_open("/entorno/eliminarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=$situacion->result()[0]->situacionlaboral; $idsituacion=$situacion->result()[0]->idsituacionlaboral; ?>
<input type='hidden' name='idsituacionlaboral' value='<?php echo $idsituacion; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Opcion: ','situacionlaboral',$attLabel); ?>
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
        $.post("<?php echo base_url().'administrador/situacion/eliminarPost' ?>", {idsituacionlaboral: $("input[name='idsituacionlaboral']").val()}, function(data){ // Respuesta en formatoo JSON
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