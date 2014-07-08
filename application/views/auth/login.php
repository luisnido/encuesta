<?php echo $head; ?>



    <div class="navbar navbar-static-top">
  <div class="navbar-inner">
      
    <a class="brand" href="#">Sistema de mejora contínua para la calidad</a>
     <p class="navbar-text pull-right">Carabineros de Chile</p>
    
  </div>
</div>    
  
     <div class="container"  style="margin-top:50px;">   
         
         <div class="row">
     <div class="span6 offset3">
<h1><?php echo lang('login_heading');?></h1>
<p class="text-info"><?php echo lang('login_subheading');?></p>
 <?php // echo $message;?>



<?php echo form_open("auth/login");?>

 <?php if( form_error('email')){ echo '<div class="control-group warning">';} ?>
    
   <label class="control-label" for="email">Email</label> 
    <div class="controls">
      <div class="input-prepend">       
        <span class="add-on"><i class="fa fa-envelope-o fa-fw"></i></span>
         <?php  echo form_input($email); ?>
      </div>
      <?php if( form_error('email')){ echo '<span class="help-block">'.form_error('email').'</span>';} ?>    
     </div>
   

 <?php if( form_error('email')){ echo   '</div>'; }?> 
  
   
 

  <?php if( form_error('password')){ echo '<div class="control-group warning">';} ?>
    
   <label class="control-label" for="password">Contraseña</label> 
    <div class="controls">
    <div class="input-prepend">       
    <span class="add-on"><i class="fa fa-key"></i></span>
         <?php  echo form_input($password); ?>
    </div>
      <?php if( form_error('password')){ echo '<span class="help-block">'.form_error('password').'</span>';} ?>    
     </div>
    

 <?php if( form_error('password')){ echo   '</div>'; }?> 
   
  

  
    <label class="checkbox">
     <input type="checkbox" id="remember" name="remember" value="false"/>  Recordar
    </label>

    
 
  
  <p><?php echo form_submit($submit);?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
</div></div>
</div>
   
  
    <script>
    $('.alert').fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();
    
    </script>
  <?php echo $foot; ?>