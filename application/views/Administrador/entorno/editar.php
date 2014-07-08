<h5>Modificar entorno</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar'); 
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=array(     
     'name'=>'nombre', 
     'placeholder'=>'Nombre del entorno',
    'value'=>$entorno->result()[0]->nombre
);

$identorno=$entorno->result()[0]->identorno;
    

?>
<input type='hidden' name='identorno' value='<?php echo $identorno; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','nombre',$attLabel); ?>
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
        
    
    $.post("<?php echo base_url().'administrador/entorno/editarPost' ?>", {identorno: $("input[name='identorno']").val(),nombre: $("input[name='nombre']").val()}, function(data){ // Respuesta en formatoo JSON
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