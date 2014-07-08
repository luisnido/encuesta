
<h4>Crear nuevo ingreso familiar</h4>
<hr/>


<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioCrear','id'=>'formularioCrear'); 
echo form_open("/entorno/crearPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php 


$minimo=array(     
     'name'=>'ingresomin', 
     'placeholder'=>'Ingreso Mínimo',
    'maxlength'=>'7'
    
);

$maximo=array(     
     'name'=>'ingresomax', 
     'placeholder'=>'Ingreso Máximo',
    'maxlength'=>'7'
    
);

?>
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
        <button type="submit" class="btn pull-right" >Ingresar</button>
    </div>
</div>
    

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>


<script>
    $("#formularioCrear").submit(function(){
       
       
       $.post("<?php echo base_url().'administrador/ingreso_familiar/crearPost' ?>", {ingresomin: $("input[name='ingresomin']").val(),ingresomax: $("input[name='ingresomax']").val()}, function(data){ // Respuesta en formatoo JSON
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





