<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Footer{
   
    public function __construct() { 
     //   $this->arr_nav=$arr['menu'];
     
  //      $this->arr_pag=$arr['paginas'];
    }
    public function GenerarFooter(){
        $ret_foot ='</body></html>';
        
        
        return $ret_foot;
    }

}

?>