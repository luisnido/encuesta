<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  
 
  


class Navegacion{
    private  $arr_nav;
    private  $active;
    public function __construct($arr) {
    
       
        $this->arr_nav=$arr['menu'];
        $this->active=$arr['active'];
    }
    public function GenerarNavegacion(){
        $ret_nav ='<div class="container" ><ul class="breadcrumb">';
        
        foreach ($this->arr_nav as $opcion){
            if($this->active == $opcion){
            $ret_nav.='<li class="active">'.$opcion.'</li>';
            }else{
                $ret_nav.='<li ><a href="#">'.$opcion.'</a> <span class="divider">&rsaquo;</span></li>';
            }
        }
        
        $ret_nav.='</ul></div>';
        return $ret_nav;
    }

}

?>
