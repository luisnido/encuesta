<h5>Modificar prefectura</h5>
<hr/> 
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioEditar','id'=>'formularioEditar');
echo form_open("/entorno/editarPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php $nombre=array(     
     'name'=>'prefectura', 
     'placeholder'=>'Prefectura',
    'value'=>$prefectura->result()[0]->prefectura
);

$idprefecto = $prefectura->result()[0]->idprefecto;


$idzona=$prefectura->result()[0]->idzona;
    

?>
<input type='hidden' name='idzona' value='<?php echo $idzona; ?>' />
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Nombre: ','zona',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($nombre); ?>       
    </div>
  </div>

<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Prefecto: ','idprefecto',$attLabel); ?>
    <div class="controls">
    <select name = "idprefecto" id = "idprefecto" >
    <?php if($usuarios){
  echo  '<option  value="0">Seleccione un prefecto</option>'; foreach($usuarios->result() as $usuario){?>
<option <?php if($usuario->idusuario==$idprefecto){echo "selected='selected'";} ?> value="<?php echo $usuario->idusuario; ?>" ><?php echo $usuario->nombre; ?></option>
<?php }}else{
     echo  '<option  value="0">No hay prefectos disponibles</option>';
}
?>
    </select>
    </div>
  </div>



<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Zona: ','idzona',$attLabel); ?>
    <div class="controls">
    <select name = "idzona" id = "idzona" >
    <?php if($zonas){
  echo  '<option  value="0">Seleccione una zona</option>'; foreach($zonas->result() as $zona){?>
<option <?php if($zona->idzona==$idzona){echo "selected='selected'";} ?> value="<?php echo $zona->idzona; ?>" ><?php echo $zona->zona; ?></option>
    <?php }} ?>
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
        $.post("<?php echo base_url().'administrador/prefectura/editarPost' ?>", {idprefectura: $("input[name='idzona']").val(),prefectura: $("input[name='zona']").val(),idprefecto:$("select[name='idjefezona']").val(),idzona:$("select[name='idzona']").val()}, function(data){ // Respuesta en formatoo JSON
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