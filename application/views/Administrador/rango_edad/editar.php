<h5>Modificar entorno</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar'); 
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $minimo=array(     
     'name'=>'min', 
     'placeholder'=>'Valor Mínimo',
    'value'=>$rango->result()[0]->min,
    'maxlength'=>'2'
);

$maximo=array(     
     'name'=>'max', 
     'placeholder'=>'Valor Máximo',
    'value'=>$rango->result()[0]->max,
    'maxlength'=>'2'
);


$idrango=$rango->result()[0]->idrango;
    

?>
<input type='hidden' name='idpercepcion' value='<?php echo $idrango; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Valor Mínimo: ','min',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($minimo); ?>
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Valor Máximo: ','max',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($maximo); ?>
    </div>
  </div>

<div class="control-group">
    <div class="controls">     
        <button type="submit" class="btn pull-right" >Actualizar</button>
    </div>
</div>

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>

 <script>
    $("#formularioEditar").submit(function(){ 
        
    
    $.post("<?php echo base_url().'administrador/rango_edad/editarPost' ?>", {idrango: $("input[name='idrango']").val(),min: $("input[name='min']").val(),max: $("input[name='max']").val()}, function(data){ // Respuesta en formatoo JSON
            if(data.error){
                alert(data.error);
            }
            else{ if(data.editar === "ok"){
                    
                $('#editarModal').modal('hide');
                $('#editarModal').on('hidden', function () {  location.reload();});
            }}
        }, 'json');      
        return false;
    });
</script>