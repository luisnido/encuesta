<?php echo $head; ?>
<?php echo $menu; ?>

<style type="text/css">
    body{
         background-image: url("<?php echo base_url().'application/views/img/agua.png'; ?>");
         background-repeat:no-repeat;
         background-position:center 100px;
}
</style>
        <div class="container">
            <div class="jumbotron"> 
                <hr />
                <h1 class="text-center">Bienvenido <?php echo $this->session->userdata('nombre_usuario')?></h1>
                
                <p class="lead text-center">Panel de control del cuadro de mando operativo para carabineros de chile</p>
           
                <hr />
               
            </div>
        </div>    
<?php echo $foot; ?>