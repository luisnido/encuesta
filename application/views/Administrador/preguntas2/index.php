<?php echo $head ?>
<?php echo $menu ?>
<?php echo $navegacion ?>
<div class="alert alert-error"  id ="alert_e">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <center>  <strong><p id ="alert_eliminar"></p></strong> </center>
</div>
<div class="alert alert-info" id ="alert_m">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 <center>  <strong><p id ="alert_modificar"></p></strong> </center>
</div>
<div class="alert alert-success" id ="alert_c">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 <center> <strong><p id ="alert_crear"></p></strong> </center>
</div>
<script>
    $('.alert').hide();
    </script>
<hr/>
<div class="container">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?php echo $sidebar?>
    </div>
    <div class="span10">

        

        <button id="crear" class="btn btn-success span12" >Para agregar un nuevo indicador presione aquí</button>
        <table id="tabla" class="table table-hover table-bordered">
            <thead><tr><th>Indicador</th><th>Pregunta</th><th>Tipo</th><th width='50'>Acciones</th></tr>  </thead>
            <tbody><?php if($preguntas){?>
            <?php foreach ($preguntas->result() as $pregunta){
            echo '<tr id="tr'.$pregunta->idpregunta.'"><td>'.$pregunta->indicador.'</td><td>'.$pregunta->pregunta.'</td><td>'.$pregunta->tipo.'</td><td>
                  <a class="editar"  data-toggle="tooltip" title="Editar" titulo="editar" href="" id="'.$pregunta->idpregunta.'"><i class="icon-edit"></i></a>&nbsp;
                  <a class="eliminar"  data-toggle="tooltip" title="Eliminar"  titulo="eliminar"  href="" id="'.$pregunta->idpregunta.'" ><i class="icon-remove"></i></a></td></tr>';
            }}?>
            </tbody>
        </table>
       


          
        <?php echo form_fieldset_close()?>
        <?php echo form_close();?>
        <?php echo $paginacion; ?>
    </div>
  </div>
</div>
</div>

<div id="crearModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">×</button>
    <h3 id="myModalLabel">Preguntas</h3>
  </div>
  <div id="crearBody" class="modal-body">
         <p class="text-success">Crear nueva pregunta</p>
                  <hr/>
        <form class="form-horizontal" method="post" id="form-crear" name="form-crear">
            <fieldset>
                <div id="idindicador-crear-v" class="control-group">
                    <label class="control-label">Indicador:</label>
                    <div class="controls">
                      <select name = "idindicador" id = "idindicador" >
                          <?php if($indicadores){ ?>
                            <?php foreach($indicadores->result() as $indicador){?>
                               <option value="<?php echo $indicador->idindicador; ?>"><?php echo $indicador->nombre; ?></option>
                            <?php }?>
                          <?php } ?>
                      </select>                        
                    </div>             
                </div>
                 <div id="idtipo-crear-v" class="control-group">
                    <label class="control-label">Tipo:</label>
                    <div class="controls">
                      <select name = "idtipo" id = "idtipo" >
                          <?php if($tipos){ ?>
                                <?php foreach($tipos->result() as $tipo){?>
                                   <option value="<?php echo $tipo->idtipo; ?>"><?php echo $tipo->nombre; ?></option>
                                <?php }?>  
                          <?php } ?>
                      </select>                        
                    </div>             
                </div>
                <div id="nombre-crear-v" class="control-group">
                    <label class="control-label">Pregunta:</label>
                    <div class="controls">
                        <textarea id="pregunta" name="pregunta" rows="3"></textarea>                    
                    </div>
                </div>              
                <div class="control-group">
                    <div class="controls">     
                        <button type="submit" class="btn btn-success" >Agregar</button>
                    </div>
                </div> 
            </fieldset>
        </form>
  </div>  
</div>



<div id="editarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Preguntas</h3>
</div>
<div id="editarBody" class="modal-body">
     <p class="text-warning">Modificar pregunta</p>
                 <hr/> 
   <form id="form-editar" method="post" name="form-editar" class="form-horizontal">
        <fieldset>
              <fieldset>
                <div id="indicador-crear-v" class="control-group">
                    <label class="control-label">Indicador:</label>
                    <div class="controls">
                      <select name = "idindicador" id = "idindicador" >
                           <?php if($indicadores){ ?>
                            <?php foreach($indicadores->result() as $indicador){?>
                               <option value="<?php echo $indicador->idindicador; ?>"><?php echo $indicador->nombre; ?></option>
                            <?php }?>
                           <?php }?>
                      </select>                        
                    </div>             
                </div>
                <div id="tipo-crear-v" class="control-group">
                    <label class="control-label">Tipo:</label>
                    <div class="controls">
                      <select name = "idtipo" id = "idtipo" >
                          <?php if($tipos){ ?>
                            <?php foreach($tipos->result() as $tipo){?>
                               <option value="<?php echo $tipo->idtipo; ?>"><?php echo $tipo->nombre; ?></option>
                            <?php }?>
                           <?php }?>
                      </select>                        
                    </div>             
                </div>
                <div id="pregunta-crear-v" class="control-group">
                    <label class="control-label">Pregunta:</label>
                    <div class="controls">
                        <textarea id="pregunta" name="pregunta" rows="3"></textarea>                    
                    </div>
                </div>
              
                <div class="control-group">
                    <div class="controls">     
                        <button type="submit" class="btn btn-success" >Modificar</button>
                    </div>
                </div> 
            </fieldset> 
        </fieldset>
    </form>
  </div>  
</div>


<div id="eliminarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Preguntas</h3>
  </div>
        <div id="eliminarBody" class="modal-body">
          <p class="text-danger">Eliminar pregunta</p>
             <hr/> 
          <form id="form-eliminar" method="post" name="form-eliminar" class="form-horizontal">
              <fieldset>        
                 <input type='hidden' name='id' id="id" value='' />
                 <div  id="indicador-eliminar-v"  class="control-group">
                     <label class="control-label">Indicador</label>
                     <div class="controls">
                       <input type="text" value="" name="indicador" id="indicador" disabled />
                     </div>
                 </div>
                 <div id="tipo-eliminar-v"  class="control-group">
                     <label class="control-label">Tipo</label>
                     <div class="controls">                         
                       <input type="text" value="" name="tipo" id="tipo" disabled />
                     </div>
                 </div>
                 <div id="pregunta-eliminar-v"  class="control-group">
                     <label class="control-label">Pregunta</label>
                     <div class="controls">                         
                         <textarea rows="3" name="pregunta" id="pregunta" disabled="disabled"></textarea>
                     </div>
                 </div>
                 <div class="control-group">
                     <div class="controls">     
                       <button type="submit" class="btn btn-danger">Eliminar</button>
                     </div>
                 </div>
            </fieldset>
          </form>
  </div>
  
</div>

 <script>
  $(document).ready(function(){
      $('#crear').click(function(){
          $('#crearModal').modal('show');
          
      });
      
      $(document).on('click','.editar',function(){
           $.ajax({
           url:'<?php echo base_url() ?>'+'administrador/preguntas2/obtenerPreguntaPost',
           type: 'POST',
           data:{id: $(this).attr('id')},
           success: function(msj){
           console.log(msj);
           var  obj = $.parseJSON(msj);
              if(obj.ok){
                $('#form-editar #idindicador option[value='+ obj.idindicador +']').attr("selected",true);
                $('#form-editar #idtipo option[value='+ obj.identorno +']').attr("selected",true);
                $('#form-editar #id').val(obj.id);
                $('#form-editar #pregunta').val(obj.pregunta);
                $('#editarModal').modal('show');
              }else{
                  alert('Error: '+obj.validacion);
              }
           }
       }); 
          return false;
      });
      
      $(document).on('click','.eliminar',function(){
           $.ajax({
           url:'<?php echo base_url() ?>'+'administrador/preguntas2/obtenerPreguntaPost',
           type: 'POST',
           data:{id: $(this).attr('id')},
           success: function(msj){
           console.log(msj);
           var  obj = $.parseJSON(msj);
              if(obj.ok){
                $('#form-eliminar #tipo').val(obj.tipo);
                $('#form-eliminar #indicador').val(obj.indicador);  
                $('#form-eliminar #pregunta').val(obj.pregunta);  
                $('#form-eliminar #id').val(obj.id);
                 $('#eliminarModal').modal('show');
              }else{
                  alert('Error:'+obj.validacion);
              }
           }
       }); 
     
         
          return false;
      });      
      
      $('#form-crear').submit(function(){   
          $('#nombre-crear-v').removeClass('error');
          $('#nombre-crear-v').find('span').remove();
          $.ajax({
           url:'<?php echo base_url() ?>'+'administrador/preguntas2/crearPost',
           type: 'POST',
           data: $('#form-crear').serialize(),
           success: function(msj){
           console.log(msj);
           var  obj = $.parseJSON(msj);
              if(obj.ok){
                   $('#crearModal').modal('hide');               
                   $('#form-crear #nombre').val('');                
                   $(obj.contenido).prependTo('#tabla tbody');  
                   $('#tr'+obj.id).hide().fadeIn(2000,function(){$('#tr'+obj.id).removeClass('success',6000,'easeOutQuint');});
                   $('a').tooltip();
                   $('#alert_crear').html(obj.mensaje);
                   $('#alert_c').fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();                  
              }else{
                  
                  $('#nombre-crear-v').addClass('error');
                  $('#nombre-crear-v').find('#nombre').after(obj.nombre);
              }
           }
       }); 
   
       return false;
      });
      
      $('#form-editar').submit(function(){   
       $('#nombre-editar-v').removeClass('error');
           $('#nombre-editar-v').find('span').remove();
          $.ajax({
           url:'<?php echo base_url() ?>'+'administrador/indicador/editarPost',
           type: 'POST',
           data: $('#form-editar').serialize(),
           success: function(msj){
           console.log(msj);
           var  obj = $.parseJSON(msj);
              if(obj.ok){
                  $('#editarModal').modal('hide');               
                  $('#form-editar #nombre').val('');                
                  
                   $('#tr'+obj.id).fadeOut({
                       duration: 2000,
                       done: function(){
                            $(obj.contenido).prependTo('#tabla tbody');  
                              $('#tr'+obj.id).hide().fadeIn(2000,function(){$('#tr'+obj.id).removeClass('success',6000,'easeOutQuint');});
                 
                       }
                   });
                   $('a').tooltip();
                   $('#alert_modificar').html(obj.mensaje);
                   $('#alert_m').fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();                  
              }else{
                    $('#nombre-editar-v').addClass('error');
                    $('#nombre-editar-v').find('#nombre').after(obj.nombre);
              }
           }
       }); 
   
       return false;
      });
      
      $('#form-eliminar').submit(function(){   
          $.ajax({
           url:'<?php echo base_url() ?>'+'administrador/indicador/eliminarPost',
           type: 'POST',
           data: $('#form-eliminar').serialize(),
           success: function(msj){
           console.log(msj);
           var  obj = $.parseJSON(msj);
              if(obj.ok){
                  $('#eliminarModal').modal('hide');               
                              
                  
                   $('#tr'+obj.id).fadeOut(2000);
                   $('button').tooltip();
                   $('#alert_eliminar').html(obj.mensaje);
                   $('#alert_e').fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();                  
              }else{
                  alert('Error:'+obj.validacion);
              }
           }
       }); 
   
       return false;
      });});
</script>

<?php echo $foot; ?>