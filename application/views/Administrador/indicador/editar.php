<h5>Modificar indicador</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar');
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=array(     
     'name'=>'nombre', 
     'placeholder'=>'Nombre del indicador',
    'value'=>$indicador->result()[0]->nombre
);

$idindicador=$indicador->result()[0]->idindicador;
    $identorno=$indicador->result()[0]->identorno;

?>
<input type='hidden' name='idindicador' value='<?php echo $idindicador; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','nombre',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($nombre); ?>       
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Entorno: ','nombre',$attLabel); ?>
    <div class="controls">
    <select name = "identorno" id = "identorno" >
<?php foreach($entornos->result() as $entorno){?>
<option <?php if($entorno->identorno==$identorno){echo "selected='selected'";} ?> value="<?php echo $entorno->identorno; ?>" ><?php echo $entorno->nombre; ?></option>
<?php }?>
    </select>
    </div>
  </div>



<div class="control-group">
    <div class="controls">     
      <button type="submit" class="btn">Actualizar</button>
    </div>
  </div>
    

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>

 
 <script>

    $("#formularioEditar").submit(function(){
        $.post("<?php echo base_url().'administrador/indicador/editarPost' ?>", {idindicador: $("input[name='idindicador']").val(),nombre: $("input[name='nombre']").val(),identorno:$("select[name='identorno']").val()}, function(data){ // Respuesta en formatoo JSON
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