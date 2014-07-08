<h5>Modificar zona</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar');
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=array(     
     'name'=>'zona', 
     'placeholder'=>'Nombre de la zona',
    'value'=>$zona->result()[0]->zona
);

$idzona=$zona->result()[0]->idzona;
    $idjefezona=$zona->result()[0]->idjefezona;

?>
<input type='hidden' name='idzona' value='<?php echo $idzona; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','zona',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($nombre); ?>       
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Jefe zona: ','idjefezona',$attLabel); ?>
    <div class="controls">
    <select name = "idzona" id = "idzona" >
    <?php if($usuarios){
  echo  '<option  value="0">Seleccione un jefe de zona</option>'; foreach($usuarios->result() as $usuario){?>
<option <?php if($usuario->idusuario==$idjefezona){echo "selected='selected'";} ?> value="<?php echo $usuario->idusuario; ?>" ><?php echo $usuario->nombre; ?></option>
<?php }}else{
     echo  '<option  value="0">No hay jefe de zonas disponibles</option>';
}
?>
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
        $.post("<?php echo base_url().'administrador/zona/editarPost' ?>", {idzona: $("input[name='idzona']").val(),zona: $("input[name='zona']").val(),idjefezona:$("select[name='idjefezona']").val()}, function(data){ // Respuesta en formatoo JSON
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