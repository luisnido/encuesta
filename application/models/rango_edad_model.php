<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rango_edad_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevoRango($data){
    return    $this->db->insert('rangos_edad',array('min'=>$data['min'],'max'=>$data['max']));        
    }
    
    function ObtenerRangos(){
        $this->db->order_by("idrango", "desc");
         
       $query =   $this->db->get('rangos_edad');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerRangosPaginados($limit,$offset=0){
        $this->db->order_by('idrango','desc');
          $query =   $this->db->get('rangos_edad',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('rangos_edad');
    }
            
    function ObtenerRango($id){
      
        $this->db->where('idrango',$id);
       $query =   $this->db->get('rangos_edad');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ModificarRango($data){
      
      $datos = array('min'=>$data['min'],'max'=>$data['max']);
      
      $this->db->where('idrango',$data['idrango']);
      
       return   $this->db->update('rangos_edad',$datos);
        
    }
    
    function EliminarRango($id){
        
      return  $this->db->delete('rangos_edad',array('idrango'=>$id));
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idrangoedad',$id);
       $query =   $this->db->get('encuestas');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
