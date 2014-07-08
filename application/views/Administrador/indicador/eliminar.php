<h5>Eliminar entorno</h5>
<hr/> 
<?php $nombre=$indicador->result()[0]->nombre; 
      $idindicador=$indicador->result()[0]->idindicador; 
      $entorno=$indicador->result()[0]->entorno; ?>   
    
    
    <?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEliminar','id'=>'formularioEliminar'); 
echo form_open("/indicador/eliminarPost",$attForm);?>


    
    <?php echo form_fieldset() ?>

<input type='hidden' name='idindicador' value='<?php echo $idindicador; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','nombre',$attLabel); ?>
    <div class="controls">
      <?php echo $nombre; ?>
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Entorno: ','entorno',$attLabel); ?>
    <div class="controls">
      <?php echo $entorno; ?>
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
        $.post("<?php echo base_url().'administrador/indicador/eliminarPost' ?>", {idindicador: $("input[name='idindicador']").val()}, function(data){ // Respuesta en formatoo JSON
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