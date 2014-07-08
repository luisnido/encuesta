
<?php echo $head; ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid text-center">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <a class="navbar-brand" href="#">Sistema de gestión de inventario</a>
     
    </div>
 <p class="navbar-text pull-right">Muebles Tahuari</p>
  
  </div><!-- /.container-fluid -->
</nav>
        
  
     <div class="container"  style="margin-top:50px;">   
       
         <div class="row">
    <div class="col-md-4 col-md-offset-4">


<h1><?php echo lang('forgot_password_heading');?></h1>
<p class="text-info"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<p class="text-danger"><?php echo $message;?></p>
<?php $attForm = array('role'=>'form','class'=>'form-horizontal');  ?>
<?php echo form_open("auth/forgot_password",$attForm);?>

       <div class="form-group">   
   
      	<label for="email" class="col-lg-4 control-label"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label>
        <div class="col-lg-8"> 	<?php echo form_input($email);?>
      </div></div>
     

<div class="form-group">
    <label for="enviar" class="col-lg-4"> <a href="javascript:history.back();"  style="margin-left: 50px;" class="btn btn-warning">volver</a></label>
    <div class="col-lg-8">
  <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary"');?></p>

    </div>
  </div>
          
          
        
<?php echo form_close();?>

      </div>
</div>
     </div>
      
      
       <?php echo $foot; ?>