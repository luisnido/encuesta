<h5>Modificar entorno</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar'); 
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=array(     
     'name'=>'frase_percepcion', 
     'placeholder'=>'Opcion',
    'value'=>$opcion->result()[0]->frase_percepcion
);

$valor=array(     
     'name'=>'valor', 
     'placeholder'=>'Valor',
    'value'=>$opcion->result()[0]->valor
);


$idopcion=$opcion->result()[0]->idpercepcion;
    

?>
<input type='hidden' name='idpercepcion' value='<?php echo $idopcion; ?>' />
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
        <button type="submit" class="btn pull-right" >Actualizar</button>
    </div>
</div>

 
<?php echo form_fieldset_close()?>
<?php echo form_close();?>

 <script>
    $("#formularioEditar").submit(function(){ 
        
    
    $.post("<?php echo base_url().'administrador/opcion/editarPost' ?>", {idpercepcion: $("input[name='idpercepcion']").val(),frase_percepcion: $("input[name='frase_percepcion']").val(),valor: $("input[name='valor']").val()}, function(data){ // Respuesta en formatoo JSON
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