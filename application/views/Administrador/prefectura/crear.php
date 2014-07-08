
<h4>Crear nueva prefectura</h4>
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



$prefectura=array(     
     'name'=>'prefectura', 
     'placeholder'=>'Prefectura'
    
);

 

?>
<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Prefectura: ','prefectura',$attLabel); ?>
    <div class="controls">
      <?php echo form_input($prefectura); ?>
    </div>
  </div>



<div class="control-group">
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Prefecto: ','idprefecto',$attLabel); ?>
    <div class="controls">
    <select name = "idprefecto" id = "idprefecto" >
        
<?php if($usuarios){
  echo  '<option  value="0">Seleccione un prefecto</option>';
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
   <?php $attLabel=array('class'=>'control-label'); echo form_label('Zona: ','idzona',$attLabel); ?>
    <div class="controls">
    <select name = "idzona" id = "idzona" >
        
<?php if($zonas){
  echo  '<option  value="0">Seleccione una zona</option>';
    foreach($zonas->result() as $zona){?>
<option value="<?php echo $zona->idzona; ?>"><?php echo $zona->zona; ?></option>
<?php }}else{
     echo  '<option  value="0">No hay zonas disponibles</option>';
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
        
   
  
        $.post("<?php echo base_url().'administrador/prefectura/crearPost' ?>", {prefectura: $("input[name='prefectura']").val(),idprefecto:  $("select[name='idprefecto']").val(),idzona:  $("select[name='idzona']").val()}, function(data){ // Respuesta en formatoo JSON
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

