
<h4>Crear nuevo rango edad</h4>
<hr/>


<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioCrear','id'=>'formularioCrear'); 
echo form_open("/entorno/crearPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php 


$minimo=array(     
     'name'=>'min', 
     'placeholder'=>'Valor Mínimo',
    'maxlength'=>'2'
    
);

$maximo=array(     
     'name'=>'max', 
     'placeholder'=>'Valor Máximo',
    'maxlength'=>'2'
    
);

?>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Mínimo: ','min',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($minimo); ?>
     
    </div>
  </div>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Máximo: ','max',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($maximo); ?>
     
    </div>
  </div>
<div class="control-group">
    <div class="controls">     
        <button type="submit" class="btn pull-right" >Ingresar</button>
    </div>
</div>
    

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>


<script>
    $("#formularioCrear").submit(function(){
       
       
       $.post("<?php echo base_url().'administrador/rango_edad/crearPost' ?>", {min: $("input[name='min']").val(),max: $("input[name='max']").val()}, function(data){ // Respuesta en formatoo JSON
            if(data.error){
                alert(data.error);
            }
            else{ if(data.crear === "ok"){
                $('#crearModal').modal('hide');
                $('#crearModal').on('hidden', function () {  location.reload();});
            }}
        }, 'json');
        
        return false;
    });
</script>





