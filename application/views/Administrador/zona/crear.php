
<h4>Crear nueva zona</h4>
<hr/>

  <!--<div class="container">
<div class="container-fluid">
<div class="row-fluid">
    <div class="span2">-->
      <!--Sidebar content-->
      <?php // echo $sidebar?>
<!--    </div>
    <div class="span10">-->
<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioCrear','id'=>'formularioCrear'); echo form_open("/indicador/crearPost",$attForm);?>
<?php echo form_fieldset() ?>
<?php 



$zona=array(     
     'name'=>'zona', 
     'placeholder'=>'Nombre de la zona'
    
);

 

?>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Zona: ','zona',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($zona); ?>
    </div>
  </div>



<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Jefe Zona: ','idjefezona',$attLabel); ?>
    <div class="controls">
    <select name = "idjefezona" id = "idjefezona" >
        
<?php if($usuarios){
  echo  '<option  value="0">Seleccione un jefe de zona</option>';
    foreach($usuarios->result() as $usuario){?>
<option value="<?php echo $usuario->idusuario; ?>"><?php echo $usuario->nombre; ?></option>
<?php }}else{
     echo  '<option  value="0">No hay jefe de zonas disponibles</option>';
}
?>
    </select>
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
        
   
   // alert( $("select[name='idjefezona']").val());
  
        $.post("<?php echo base_url().'administrador/zona/crearPost' ?>", {zona: $("input[name='zona']").val(),idjefezona:  $("select[name='idjefezona']").val()}, function(data){ // Respuesta en formatoo JSON
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

