
<h4>Crear nuevo indicador</h4>
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



$nombre=array(     
     'name'=>'nombre', 
     'placeholder'=>'Nombre del entorno'
    
);

 

?>
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
<option value="<?php echo $entorno->identorno; ?>"><?php echo $entorno->nombre; ?></option>
<?php }?>
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
        
  
        $.post("<?php echo base_url().'administrador/indicador/crearPost' ?>", {nombre: $("input[name='nombre']").val(), identorno: $("select[name='identorno']").val()}, function(data){ // Respuesta en formatoo JSON
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

