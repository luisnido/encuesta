<h5>Modificar entorno</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar'); 
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php 
$nombre=array(     
     'name'=>'nivelestudio', 
     'placeholder'=>'Nivel de Estudios',
     'value'=>$nivel->result()[0]->nivelestudio
    
);


$idnivelestudio=$nivel->result()[0]->idnivelestudio;
    

?>
<input type='hidden' name='idnivelestudio' value='<?php echo $idnivelestudio; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nivel de Estudios: ','nivelestudio',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($nombre); ?>
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
        
    
    $.post("<?php echo base_url().'administrador/nivel_estudio/editarPost' ?>", {idnivelestudio: $("input[name='idnivelestudio']").val(),nivelestudio: $("input[name='nivelestudio']").val()}, function(data){ // Respuesta en formatoo JSON
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