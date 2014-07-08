<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nivel_estudio_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevoNivel($data){
    return    $this->db->insert('niveles_estudio',array('nivelestudio'=>$data['nivelestudio']));        
    }
    
    function ObtenerNiveles(){
        $this->db->order_by("idnivelestudio", "desc");
         
       $query =   $this->db->get('niveles_estudio');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerNivelesPaginados($limit,$offset=0){
        $this->db->order_by('idnivelestudio','desc');
          $query =   $this->db->get('niveles_estudio',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('niveles_estudio');
    }
            
    function ObtenerNivel($id){
      
        $this->db->where('idnivelestudio',$id);
       $query =   $this->db->get('niveles_estudio');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ModificarNivel($data){
      
      $datos = array('nivelestudio'=>$data['nivelestudio']);
      
      $this->db->where('idnivelestudio',$data['idnivelestudio']);
      
       return   $this->db->update('niveles_estudio',$datos);
        
    }
    
    function EliminarNivel($id){
        
      return  $this->db->delete('niveles_estudio',array('idnivelestudio'=>$id));
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idnivelestudio',$id);
       $query =   $this->db->get('niveles_estudio');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
