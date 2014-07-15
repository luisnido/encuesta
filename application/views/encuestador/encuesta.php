<?php echo $head ?>
<?php echo $menu ?>
<?php echo $navegacion ?>

<hr/>
<script>
$(document).ready(function(){
    $(".collapse").collapse();
}));
</script>
<div class="container">
<div class="container-fluid">
    
  <div class="row-fluid">
      
   <div class="span12">
        <table>
            <thead>
                <tr>
                    <th>
                        Datos Demograficos
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Edad
                    </td>
                    <td>
                        <select>
                            <option>
                                18 a 26
                            </option>
                            <option>
                                27 a 35
                            </option>
                            <option>
                                36 a 44
                            </option>
                            <option>
                                45 y más
                            </option>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td>
                        Sexo
                    </td>
                    <td>
                        <label class="radio">
                           <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Masculino
                        </label>
                    </td>
                    <td>
                         <label class="radio">
                           <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                           Femenino
                         </label>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Nivel de estudios
                    </td>
                    <td>
                        <select>
                            <option>
                                Básicos
                            </option>
                            <option>
                                Medios
                            </option>
                            <option>
                                Técnico
                            </option>
                            <option>
                                Superior
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Situción Laboral
                    </td>
                    <td>
                        <select>
                            <option>
                                Empleado
                            </option>
                            <option>
                               Independiente
                            </option>
                            <option>
                                Cesante
                            </option>
                            <option>
                                Jubilado
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ingreso Familiar
                    </td>
                    <td>
                        <select>
                            <option>
                                0 a $70.543
                            </option>
                            <option>
                                $70.544 a $118.145
                            </option>
                            <option>
                                $118.146 a $181.703
                            </option>
                            <option>
                                $181.704 a $331.917
                            </option>
                            <option>
                               mas de $331.918
                            </option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
      <div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Encuesta Parte 1
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
          <?php foreach ($entornos->result() as $entorno) {?>
          <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Entorno <?php echo $entorno->nombre ?></th><th>Lo que esperaba</th><th>Lo que percibió</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parte1->result() as $pregunta) {?>
                     <?php if($entorno->identorno == $pregunta->identorno){ ?>
                        <tr class="<?php echo $pregunta->nombre; ?> parte1">
                            <td><?php echo $pregunta->nombre; ?></td>
                            <td><select id="esperaba" name="esperaba"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></td>
                            <td><select id="precibio" name="precibio"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></td>
                        </tr>
                     <?php } ?>
                    <?php } ?>
                </tbody>            
            </table>
          <?php }?>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        Encuesta Parte 2
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
           <?php foreach ($entornos->result() as $entorno) {?>
          <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Entorno <?php echo $entorno->nombre; ?></th><th>Lo que esperaba</th><th>Lo que percibió</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parte2->result() as $pregunta) {?>
                     <?php if($entorno->identorno == $pregunta->identorno){ ?>
                        <tr class="<?php echo $pregunta->indicador; ?> parte1">
                            <td><?php echo $pregunta->indicador; ?></td>
                            <td><?php echo $pregunta->pregunta; ?></td>
                            <td>
                                <select id="rango" name="rango">
                                    <?php if($rangos){?>
                                        <?php foreach($rangos->result() as $rango){?>
                                     <option value="<?php echo $rango->idrango; ?>"><?php echo $rango->rango; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                     <?php } ?>
                    <?php } ?>
                </tbody>            
            </table>
          <?php }?>
                 
      </div>
    </div>
  </div>
</div>
        



    </div>
  </div>
</div>
</div>




<?php echo $foot; ?>