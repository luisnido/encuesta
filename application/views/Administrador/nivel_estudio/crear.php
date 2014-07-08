
<h4>Crear nuevo nivel de estudios</h4>
<hr/>


<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioCrear','id'=>'formularioCrear'); 
echo form_open("/entorno/crearPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php 


$nombre=array(     
     'name'=>'nivelestudio', 
     'placeholder'=>'Nivel de Estudios'
    
);



?>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nivel de Estudios: ','nivelestudio',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($nombre); ?>
     
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
       
       
       $.post("<?php echo base_url().'administrador/nivel_estudio/crearPost' ?>", {nivelestudio: $("input[name='nivelestudio']").val()}, function(data){ // Respuesta en formatoo JSON
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





