<style type="text/css">
.nav-tabs > li {
    float:none;
    display:inline-block;
    *display:inline; /* ie7 fix */
     zoom:1; /* hasLayout ie7 trigger */
}

.nav-tabs {
  text-align:center;
}

</style>

  

 <div class="tabbable tabs-below"> <!-- Only required for left/right tabs -->
  
  <div  id="myTabContent" class="tab-content"> 
      <div  class="tab-pane fade <?php if(isset($active1)){ echo  'active in';}?>" id="tab1">
      <?php if(isset($tab1)){ echo  $tab1;}?>
    </div>
    <div  class="tab-pane fade <?php if(isset($active2)){ echo  'active in';}?>" id="tab2">
      <?php if(isset($tab2)){ echo  $tab2;}?>
    </div>
      <div class="tab-pane fade <?php if(isset($active3)){ echo  'active in';}?>" id="tab3">
      <?php if(isset($tab3)){ echo  $tab3;}?>
    </div>
  </div>
    
     <ul class="nav nav-tabs" id="myTab">
         <li <?php if(isset($active1)){ echo  'class="active"';}?> ><a href="#tab1" id="ta1" data-toggle="tab">Cuadro de Mando Operativo</a></li>
    <li   <?php if(isset($active2)){ echo  'class="active"';}?>><a href="#tab2" id="ta2" data-toggle="tab">Datos Encuesta</a></li>
    <li <?php if(isset($active3)){ echo  'class="active"';}?> ><a href="#tab3" id="ta3" data-toggle="tab">Sectores</a></li>
  </ul>
</div>
 
<script>
   $(document).ready(function(){      
       
       
       $('#ta1').click(function(){
            location.href='<?php echo base_url().'administrador/entorno';  ?>';
       });
       $('#ta2').click(function(){
            location.href='<?php echo base_url().'administrador/preguntas1';  ?>';
       });
        $('#ta3').click(function(){
            location.href='<?php echo base_url().'administrador/zona';  ?>';
       });
       
       
       
   });
               
                
          
         
      </script>