<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Contenido{
   
    public function __construct() { 
    
     
      
    }
    
    function GenerarEntorno($id,$nombre){
        $blabla="<tr id='tr".$id."' class='success'><td>".$id."</td><td>".$nombre."</td><td>
                <a class='editar'  data-toggle='tooltip' title='Editar' titulo='editar' href='' id='".$id."'><i class='icon-edit'></i></a> &nbsp;
              
                <a class='eliminar'  data-toggle='tooltip' title='Eliminar'  titulo='eliminar'  href='' id='".$id."' ><i class='icon-remove'></i></a></td></tr>";
        
        return $blabla;
    }
    function GenerarIndicador($id,$nombre,$entorno){
        $blabla="<tr id='tr".$id."' class='success'><td>".$id."</td><td>".$nombre."</td><td>".$entorno."</td><td>
                 <a class='editar' data-toggle='tooltip' title='Editar' titulo='editar' href='' id='".$id."'><i class='icon-edit'></i></a> &nbsp;
                 <a class='eliminar' data-toggle='tooltip' title='Eliminar'  titulo='eliminar' href='' id='".$id."'><i class='icon-remove'></i></a></td></tr>";
        
        return $blabla;
    }
    
    function GenerarFamilia($id,$nombre,$descripcion){
    
        $blabla = '<div id="f'.$id.'" class="panel panel-primary">
                        <div class="panel-heading">
                           <form id="form_hf'.$id.'" class="form-inline" role="form">
                             <div  class="row">
                                 <div id="1col'.$id.'" class="col-xs-3">   
                                     
                                     <label id="label_nombre'.$id.'" class="control-label" for="kk">'.$nombre.'</label> 
                                 </div>
                                 <div id="2col'.$id.'" class="col-xs-6">      
                                     <p id="label_descripcion'.$id.'" class="form-control-static">'.$descripcion.'</p>
                                 </div>                                  
                                 <div id="3col'.$id.'" class="col-xs-1">       
                                     <button type="button" data-placement="left" title="Editar" data-toggle="tooltip" id_familia="'.$id.'" id="btn_edit'.$id.'"  class="btn btn-default editar_familia"><i class="fa fa-edit"></i></button>
                                 </div>
                                 <div id="4col'.$id.'" class="col-xs-1">
                                     <button type="button" data-placement="left" title="Eliminar" data-toggle="tooltip" id_familia="'.$id.'" id="btn_delete'.$id.'" class="btn btn-default eliminar_familia"><i class="fa fa-trash-o"></i></button> 
                                 </div>
                                 <div id="5col'.$id.'" class="col-xs-1">       
                                     <button type="button"  data-placement="left" title="Abrir" rel="tooltip" data-toggle="collapse"  data-parent="#accordion" href="#collapse'.$id.'" id_familia="'.$id.'" id="btn_abrir'.$id.'"  class="btn btn-dark abrir_familia"><i class="fa fa-chevron-down"></i></button>
                                 </div>
                             </div> 
                           </form> 
                         </div
                         
                         <!-- familias -->
             <div id="collapse'.$id.'" class="panel-collapse collapse">
                
                         <div class="panel-body">
                           <div class="panel panel-borderpumpkin">
                           <div class="panel-body">
                              <strong>Agregar nueva Sub-Familia</strong>
                              <form  id="agregar_sf'.$id.'" class="form-inline" role="form">
                 
                               <div class="row">
                                 <div class="col-xs-10">  
                                   <input type="hidden" id="id_familia" name="id_familia" value="'.$id.'" />
                                   <input type="text" class="form-control" size="89" id="nombre" name="nombre" placeholder="Nombre">
                                 </div>
                                 <div class="col-xs-2">
                                  <button type="button" id_familia="'.$id.'" class="btn btn-default agregar_sf">Agregar</button>
                                 </div>
                              </div>
                                  
                             </form>
                          </div>
                               
                         
                         <table id="table'.$id.'" class="table table-hover">
                             <thead>
                                <tr class="-pumpkin">
                                   <th>nombre</th>
                                   <th style="width:150px;" >acciones</th>
                                </tr>
                             </thead>
                             <tbody>
                          
                  </tbody>
                         </table>
                         
                         </div>
      
      
                </div>
             </div>
            </div>';
        
        
        
        return $blabla;
    }
    
    
    function GenerarSubFamilia($id,$nombre,$id_familia){
        $blabla=' <tr id="tr'.$id.'">                        
                   <td id="1td'.$id.'">'.$nombre.'</td> 
                   <td id="2td'.$id.'" style="width:150px;"> 
                      <button id_subfamilia="'.$id.'" data-placement="left" title="Editar" data-toggle="tooltip" id_familia="'.$id_familia.'" id="editar_subfamilia'.$id.'"  class="btn btn-default editar_sf"><i class="fa fa-edit"></i></button> 
                      <button id_subfamilia="'.$id.'" data-placement="left" title="Eliminar" data-toggle="tooltip" id="eliminar_subfamilia'.$id.'" class="btn btn-default eliminar_sf"><i class="fa fa-trash-o"></i></button>   
                   </td>                           
                  </tr>';
        return $blabla;
    }
    
    function GenerarPiezaMueble($id,$cod,$nombre,$color,$num,$total){       
        
        $blabla ='<div id="pieza'.$id.'" class="panel panel-danger col-md-10 col-md-offset-1">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3"><div id="barra'.$id.'" ></div></div>
                            <div class="col-md-3">'.$nombre.'</div>
                            <div class="col-md-3">'.$color.'</div>
                            <div class="col-md-2"> Pieza '.$num.' de '.$total.'</div>                          
                            <div class="col-md-1"><button id_pieza="'.$id.'" class="btn btn-danger desasociar"  data-toggle="tooltip" data-placement="top" title="Desasociar"><span class="glyphicon glyphicon-remove"></span></button></div>
                        </div>
                    </div>
                </div>
                 <script>
            $("#barra'.$id.'").barcode("'.$cod.'", "ean13",{barHeight:20});     
        </script>';
                
        return $blabla;
    }
}
?>
