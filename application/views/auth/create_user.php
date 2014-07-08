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
<h1><?php echo lang('create_user_heading');?></h1>
<p class="text-info"><?php echo lang('create_user_subheading');?></p>
<hr class="divider">
<div><?php echo $message;?></div>
<?php $attForm = array('role'=>'form','class'=>'form-horizontal');  ?>
<?php echo form_open("auth/create_user",$attForm);?>
       <div class="form-group <?php if( form_error('rut')){ echo "has-error has-feedback";} ?> ">   
       <label for="rut" class="col-lg-4 control-label"><?php echo lang('create_user_rut_label', 'rut');?></label>
        <div class="col-lg-8">    
            <?php  echo form_input($rut); ?>
            <?php if(form_error('rut')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
       </div>
    </div>

    <div class="form-group <?php if( form_error('first_name')){ echo "has-error has-feedback";} ?> ">   
        <label for="first_name" class="col-lg-4 control-label">     <?php echo lang('create_user_fname_label', 'first_name');?></label>
        <div class="col-lg-8">
            <?php  echo form_input($first_name); ?>
            <?php if(form_error('first_name')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
        </div>  
    </div>
      
    <div class="form-group <?php if( form_error('last_name')){ echo "has-error has-feedback";} ?> ">   
        <label for="last_name" class="col-lg-4 control-label">      <?php echo lang('create_user_lname_label', 'last_name');?></label>
        <div class="col-lg-8">     
            <?php  echo form_input($last_name); ?>
            <?php if(form_error('last_name')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
        </div>
    </div>
      
     
   
     

    <div class="form-group <?php if( form_error('email')){ echo "has-error has-feedback";} ?> ">  
         <label for="email" class="col-lg-4 control-label"> <?php echo lang('create_user_email_label', 'email');?></label>
        <div class="col-lg-8">    
       
        <?php  echo form_input($email); ?>
        <?php if(form_error('email')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
    </div></div>
      
    <div class="form-group <?php if( form_error('phone')){ echo "has-error has-feedback";} ?> ">   
      <label for="phone" class="col-lg-4 control-label">  <?php echo lang('create_user_phone_label', 'phone');?></label>
        <div class="col-lg-8">  
      
        <?php  echo form_input($phone); ?>
        <?php if(form_error('phone')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
    </div>  </div>
      

 <div class="form-group">
          <label for="groups" class="col-lg-4 control-label"> Perfil:</label>
   
    <div class="col-lg-8">
<select name="groups" class="form-control" id="groups">
    <?php foreach ($groups as $group):?>
    <?php
		$gID=$group['id'];
		$checked = null;
		
		
			if ($gID == $grp) {
				$checked= ' selected="selected"';
		
			}
		
	?>
    
    <option <?php echo $checked ?> value="<?php echo $gID ?>" ><?php echo $group['name']; ?></option>
    <?php endforeach?>
</select>
	
	
	

    </div>
  </div>

 







   
       
        <?php  echo form_input($password); ?>
           
   
        <?php  echo form_input($password_confirm); ?>
      

<div class="form-group">            <label for="enviar" class="col-lg-4"> <a href="javascript:history.back();"  style="margin-left: 50px;" class="btn btn-warning">volver</a></label>
  
  
    <div class="col-lg-8">
  <?php echo form_submit($submit);?>
    </div>
  </div>
     

<?php echo form_close();?>
 </div>
      </div></div>

<script>
    $(document).ready(function(){
        $('#rut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup'
});



$('form').submit(function(){
var r = $('#rut').val();
r = r.replace('.','');
r = r.replace('.','');
r = r.replace('-','');

$('#password').val(r);
$('#password_confirm').val(r);


});
    }
);

</script>
<?php echo $foot; ?>