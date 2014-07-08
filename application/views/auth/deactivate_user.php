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





<h1><?php echo lang('deactivate_heading');?></h1>
<p class="text-info"><?php echo sprintf(lang('deactivate_subheading'), $user->username);?>?</p>
<?php $attForm = array('role'=>'form','class'=>'form-horizontal');  ?>
<?php echo form_open("auth/deactivate/".$user->id,$attForm);?>

  
  <div class="radio">
  <label>
      <input type="radio" name="confirm" value="yes" checked="checked" />
      <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
  </label>
</div>
<div class="radio">
  <label>   
    <input type="radio" name="confirm" value="no" />  
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
  </label>
</div>
<br>
  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <div class="form-group">
    <label for="enviar" class="col-lg-4"> <a href="javascript:history.back();"  style="margin-left: 50px;" class="btn btn-warning">volver</a></label>
    <div class="col-lg-8"><?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-primary"');?></p>
    </div></div>
<?php echo form_close();?>

  
  </div>
      </div></div>
<?php echo $foot; ?>