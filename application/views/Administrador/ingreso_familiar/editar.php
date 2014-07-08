<h5>Modificar entorno</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar'); 
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $minimo=array(     
     'name'=>'ingresomin', 
     'placeholder'=>'Ingreso Mínimo',
    'value'=>$ingreso->result()[0]->ingresomin,
    'maxlength'=>'7'
);

$maximo=array(     
     'name'=>'ingresomax', 
     'placeholder'=>'Ingreso Máximo',
    'value'=>$ingreso->result()[0]->ingresomax,
    'maxlength'=>'7'
);


$idingreso=$ingreso->result()[0]->idingresofamiliar;
    

?>
<input type='hidden' name='idingresofamiliar' value='<?php echo $idingreso; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Ingreso Mínimo: ','ingresomin',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($minimo); ?>
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Ingreso Máximo: ','ingresomax',$attLabel); ?>
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
        
    
    $.post("<?php echo base_url().'administrador/ingreso_familiar/editarPost' ?>", {idingresofamiliar: $("input[name='idingresofamiliar']").val(),ingresomin: $("input[name='ingresomin']").val(),ingresomax: $("input[name='ingresomax']").val()}, function(data){ // Respuesta en formatoo JSON
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