<?php echo $head; ?>


<div class="container"><?php echo $menu; ?>
<ol class="breadcrumb" style="margin-top:  -20px; ">
  <li><a href="#">Administrador</a></li>
   <li><a href="#">Administrar</a></li>
      <li><a href="#">Usuarios</a></li>
  <li class="active">Eliminar</li>
  
</ol>
      <div class="row">
    <div class="col-md-6 col-md-offset-3">
<h1>Eliminar Usuario</h1>
<p class="text-info">Información del usuario</p>

<hr class="divider">
<div><?php echo $message;?></div>
<?php $attForm = array('role'=>'form','class'=>'form-horizontal');  ?>
<?php echo form_open(uri_string(),$attForm);?>

 <div class="form-group">   
       <label for="company" class="col-lg-4 control-label">Rut:</label>
        <div class="col-lg-8">    
                <input class="form-control" type="text"  value="<?php  echo $user->rut; ?>" disabled />    
       </div>
    </div>

            
      <div class="form-group">   
        <label for="first_name" class="col-lg-4 control-label">Nombre:</label>
        <div class="col-lg-8">
           <input class="form-control" type="text"  value="<?php  echo $user->first_name; ?>" disabled />      
        </div>  
    </div>
      
      <div class="form-group">   
        <label for="last_name" class="col-lg-4 control-label">Apellido:</label>
        <div class="col-lg-8">     
               <input class="form-control" type="text"  value="<?php  echo $user->last_name; ?>" disabled />          
        </div>
    </div>
      
     
   
     

    
      
    <div class="form-group">   
      <label for="phone" class="col-lg-4 control-label">Teléfono:</label>
        <div class="col-lg-8">
               <input class="form-control" type="text"  value="<?php  echo $user->phone; ?>" disabled /> 
        </div>
    </div>
      
      
    
      
      
      
     <div class="form-group">
          <label for="groups" class="col-lg-4 control-label"> Perfil:</label>
   
    <div class="col-lg-8">

	
	  <input class="form-control" type="text"  value="<?php  foreach ($currentGroups as $object) {
  print $object->name;
}; ?>" disabled /> 
     
	

    </div>
  </div>


	 

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      
         
         <div class="form-group">
              <label for="enviar" class="col-lg-4"> <a href="javascript:history.back();"  style="margin-left: 100px;" class="btn btn-warning">volver</a></label>
  
    <div class="col-lg-8">
        <button class="btn btn-danger">Eliminar</button>
    </div>
  </div>

<?php echo form_close();?>
 </div>
      </div></div>
<?php echo $foot; ?>