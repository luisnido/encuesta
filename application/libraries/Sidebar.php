<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Sidebar{
   private  $arr_nav;
    private $arr_pag;
    private  $active;
    public function __construct($arr) { 
        $this->arr_nav=$arr['menu'];
        $this->active=$arr['active'];
        $this->arr_pag=$arr['paginas'];
    }
    public function GenerarMenu(){
        $ret_nav ='<ul class="nav nav-pills nav-stacked">';
        
        foreach ($this->arr_nav as $opcion){
            if($this->active == $opcion){
            $ret_nav.='<li class="active"><a href="'.$this->arr_pag[$opcion].'"><i class="icon-chevron-right pull-right"></i>'.$opcion.'</a></li> ';
            }else{
                $ret_nav.='<li><a href="'.$this->arr_pag[$opcion].'"><i class="icon-chevron-right pull-right"></i>'.$opcion.'</a></li>';
            }
        }        
        $ret_nav.='</ul>';
        return $ret_nav;
    }

}

?>
