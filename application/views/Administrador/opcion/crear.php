
<h4>Crear nueva opcion</h4>
<hr/>


<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioCrear','id'=>'formularioCrear'); 
echo form_open("/entorno/crearPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php 


$nombre=array(     
     'name'=>'frase_percepcion', 
     'placeholder'=>'Opcion'
    
);

$valor=array(     
     'name'=>'valor', 
     'placeholder'=>'Valor'
    
);

?>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Opcion: ','frase_percepcion',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($nombre); ?>
     
    </div>
  </div>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Valor: ','valor',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($valor); ?>
     
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
       
       
       $.post("<?php echo base_url().'administrador/opcion/crearPost' ?>", {frase_percepcion: $("input[name='frase_percepcion']").val(),valor: $("input[name='valor']").val()}, function(data){ // Respuesta en formatoo JSON
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





