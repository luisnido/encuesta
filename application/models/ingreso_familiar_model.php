<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ingreso_familiar_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevoIngreso($data){
    return    $this->db->insert('ingresos_familiar',array('ingresomin'=>$data['ingresomin'],'ingresomax'=>$data['ingresomax']));        
    }
    
    function ObtenerIngresos(){
        $this->db->order_by("idingresofamiliar", "desc");
         
       $query =   $this->db->get('ingresos_familiar');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerIngresosPaginados($limit,$offset=0){
        $this->db->order_by('idingresofamiliar','desc');
          $query =   $this->db->get('ingresos_familiar',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('ingresos_familiar');
    }
            
    function ObtenerIngreso($id){
      
        $this->db->where('idingresofamiliar',$id);
       $query =   $this->db->get('ingresos_familiar');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ModificarIngreso($data){
      
      $datos = array('ingresomin'=>$data['ingresomin'],'ingresomax'=>$data['ingresomax']);
      
      $this->db->where('idingresofamiliar',$data['idingresofamiliar']);
      
       return   $this->db->update('ingresos_familiar',$datos);
        
    }
    
    function EliminarIngreso($id){
        
      return  $this->db->delete('ingresos_familiar',array('idingresofamiliar'=>$id));
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idingresofamiliar',$id);
       $query =   $this->db->get('encuestas');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
