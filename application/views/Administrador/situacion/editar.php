<h5>Modificar Situacion Laboral</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar'); 
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=array(     
     'name'=>'situacionlaboral', 
     'placeholder'=>'Situacion Laboral',
    'value'=>$situacion->result()[0]->situacionlaboral
);

$idsituacion=$situacion->result()[0]->idsituacionlaboral;
    

?>
<input type='hidden' name='idsituacionlaboral' value='<?php echo $idsituacion; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','situacionlaboral',$attLabel); ?>
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
        
    
    $.post("<?php echo base_url().'administrador/situacion/editarPost' ?>", {idsituacionlaboral: $("input[name='idsituacionlaboral']").val(),situacionlaboral: $("input[name='situacionlaboral']").val()}, function(data){ // Respuesta en formatoo JSON
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