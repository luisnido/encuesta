
<h4>Crear nuevo entorno</h4>
<hr/>


<?php  $attForm = array('class'=>'form-horizontal','name'=>'formularioCrear','id'=>'formularioCrear'); 
echo form_open("/entorno/crearPost",$attForm);?>
<fieldset>
<div class="control-group">
    <label class="control-label">Nombre:</label>
    <div class="controls">
        <input type="text" name="nombre" id="nombre" value=""/>
    </div>
  </div>
<div class="control-group">
    <div class="controls">     
        <button type="submit" class="btn pull-right" >Ingresar</button>
    </div>
</div>
    

 
</fieldset>
<?php echo form_close();?>


<script>
    $("#formularioCrear").submit(function(){
       
       
       $.post("<?php echo base_url().'administrador/entorno/crearPost' ?>", {nombre: $("input[name='nombre']").val()}, function(data){ // Respuesta en formatoo JSON
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





