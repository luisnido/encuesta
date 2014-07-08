<?php echo $head; ?>


<div class="container"><?php echo $menu; ?>
<ol class="breadcrumb" style="margin-top:  -20px; ">
  <li><a href="#">Administrador</a></li>
   <li><a href="#">Administrar</a></li>
      <li><a href="#">Usuarios</a></li>
  <li class="active">Crear</li>
  
</ol>
      <div class="row">
    <div class="col-md-4 col-md-offset-4">


<h1><?php echo lang('change_password_heading');?></h1>

<p class="text-info"><?php echo $message;?></p>
<?php $attForm = array('role'=>'form','class'=>'form-horizontal');  ?>
<?php echo form_open("auth/change_password",$attForm);?>

  <p> <?php echo lang('change_password_old_password_label', 'old_password');?>
    
     <?php echo form_input($old_password);?>
  
  </p>    
  <hr class="divider">

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password);?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
     <div class="form-group">
              <label for="enviar" class="col-lg-4"> <a href="javascript:history.back();"  style="margin-left: 50px;" class="btn btn-warning">volver</a></label>
  
    <div class="col-lg-8">
          <?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-primary"');?></p>
      </div></div>
<?php echo form_close();?>
    </div>
      </div>
</div>

<?php echo $foot; ?>