<?php echo $head; ?>


<div class="container"><?php echo $menu; ?>
<ol class="breadcrumb" style="margin-top:  -20px; ">
  <li><a href="#">Administrador</a></li>
   <li><a href="#">Administrar</a></li>
      <li><a href="#">Usuarios</a></li>
  <li class="active">Editar</li>
  
</ol>
      <div class="row">
    <div class="col-md-6 col-md-offset-3">
<h1><?php echo lang('edit_user_heading');?></h1>
<p class="text-info"><?php echo lang('edit_user_subheading');?></p>

<hr class="divider">
<div><?php echo $message;?></div>
<?php $attForm = array('role'=>'form','class'=>'form-horizontal');  ?>
<?php echo form_open(uri_string(),$attForm);?>

<div class="form-group">   
       <label for="company" class="col-lg-4 control-label"><?php echo lang('edit_user_rut_label', 'rut');?></label>
        <div class="col-lg-8">    
           
            <input type="text" id="hrut" class="form-control" value="" disabled/>
          
       </div>
    </div>
            
      <div class="form-group <?php if( form_error('first_name')){ echo "has-error has-feedback";} ?> ">   
        <label for="first_name" class="col-lg-4 control-label">     <?php echo lang('edit_user_fname_label', 'first_name');?></label>
        <div class="col-lg-8">
            <?php  echo form_input($first_name); ?>
             
            <?php if(form_error('first_name')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
        </div>  
    </div>
      
      <div class="form-group <?php if( form_error('last_name')){ echo "has-error has-feedback";} ?> ">   
        <label for="last_name" class="col-lg-4 control-label">      <?php echo lang('edit_user_lname_label', 'last_name');?></label>
        <div class="col-lg-8">     
            
            <?php  echo form_input($last_name); ?>
            <?php if(form_error('last_name')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
        </div>
    </div>
      
     
    
     

    
      
    <div class="form-group <?php if( form_error('phone')){ echo "has-error has-feedback";} ?> ">   
      <label for="phone" class="col-lg-4 control-label">  <?php echo lang('edit_user_phone_label', 'phone');?></label>
        <div class="col-lg-8">  
      
        <?php  echo form_input($phone); ?>
        <?php if(form_error('phone')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
    </div>  </div>
      
 <!--   <div class="form-group <?php if( form_error('password')){ echo "has-error has-feedback";} ?> ">   
         <label for="password" class="col-lg-4 control-label"> <?php echo lang('edit_user_password_label', 'password');?></label>
        <div class="col-lg-8">
       
        <?php  echo form_input($password); ?>
        <?php if(form_error('password')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
    </div>    
    </div>
            
    <div class="form-group <?php if( form_error('password_confirm')){ echo "has-error has-feedback";} ?> ">   
       <label for="password_confirm" class="col-lg-4 control-label"> <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
        <div class="col-lg-8">
        <?php  echo form_input($password_confirm); ?>
        <?php if(form_error('password_confirm')){    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
    </div>
    </div> -->
      
      
      
     <div class="form-group">
          <label for="groups" class="col-lg-4 control-label"> Perfil:</label>
          <div class="col-lg-8">
              <select name="groups" class="form-control" id="groups">
                    <?php foreach ($currentGroups as $grp) :?>
                    <?php foreach ($groups as $group):?>
                    <?php
                                $gID=$group['id'];
                                $checked = null;
                                        if ($gID == $grp->id) 
                                        {
                                                $checked= ' selected="selected"';		
                                        }
                        ?>
                    <option <?php echo $checked ?> value="<?php echo $gID ?>" ><?php echo $group['name']; ?></option>
                    <?php endforeach?>
                    <?php endforeach?>
              </select>
          </div>
     </div>

      <?php  echo form_input($password); ?>
      <?php  echo form_input($password_confirm); ?>
      <?php echo form_input($rut);?>
      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

<hr>
<p class="text-info">Para reestablecer la contraseña presione el boton y luego guarde los cambios</p>

<div class="form-group">   
      <label  class="col-lg-7 control-label">Reestablecer contraseña?</label>
        <div class="col-lg-5">
             <button type="button" class="btn btn-primary" id="rest" data-toggle="button">No</button>
        </div> 
</div>
         
         
         
<hr class="divider">
         
         <div class="form-group">
            <label for="enviar" class="col-lg-4"> <a href="javascript:history.back();"  style="margin-left: 100px;" class="btn btn-warning">volver</a></label>
              <div class="col-lg-8">
                <?php echo form_submit($submit);?>
              </div>
         </div>

       <?php echo form_close();?>
       </div>
    </div>
</div>
<script>
$(document).ready(function(){ 
     $('#hrut').val($('#rut').val());
     
   $('.btn').click(function (e) {    
     

            if ($(this).attr('data-toggle') == 'button' && !($(this).is('.active'))) {
                $(this).addClass('btn-warning');
                $(this).removeClass('btn-primary');
                $(this).html('Si');

            }
            if ($(this).attr('data-toggle') == 'button' && ($(this).is('.active'))) {
                $(this).removeClass('btn-warning');
                $(this).addClass('btn-primary');
                $(this).html('No');
            }
        });
     
     $('form').submit(function(){
           var rut = $('#rut').val();
       rut = rut.replace('.','');
       rut = rut.replace('.','');
       rut = rut.replace('-','');
       
      
if ($('#rest').html() == 'Si') {
                $('#password').val(rut);
                $('#password_confirm').val(rut);
              
                
            } else {
                  $('#password').val('');
                $('#password_confirm').val('');
              
            }
     });
});
</script>
<?php echo $foot; ?>