<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Entorno_model extends CI_Model {
public $ulitmo_id='';
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevoEntorno($data){
          $this->db->insert('entornos',$data);
            $this->ultimo_id= $this->db->insert_id();
          if($this->db->affected_rows() >0){  
         
          return true;
          }else{
          
              return false;
          }
    }
    
    function ObtenerEntornos(){
        $this->db->order_by("identorno", "desc");
         
       $query =   $this->db->get('entornos');
        if($query->num_rows()>0){
            return $query;
        }
        else {return false;}
    }
    
    function ObtenerEntornosPaginados($limit,$offset=0){
        
        
        
        $this->db->order_by('identorno','desc');
          $query =   $this->db->get('entornos',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('entornos');
    }
            
    function ObtenerEntorno($id){
      
        $this->db->where('identorno',$id);
       $query =   $this->db->get('entornos');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ModificarEntorno($data){      
      $datos = array('nombre'=>$data['nombre']);      
      $this->db->where('identorno',$data['identorno']);      
      $this->db->update('entornos',$datos);
      if($this->db->affected_rows() >0){
          return true;          
      }else{          
          return false;
          }
    }
    
    function EliminarEntorno($id){        
      $this->db->delete('entornos',array('identorno'=>$id));
      if($this->db->affected_rows() >0){
          return true;          
      }else{          
          return false;
          }
    }
    
    function RegistrosAsociados($id){
          $this->db->where('identorno',$id);
       $query =   $this->db->get('indicadores');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
    
    function MismoNombre($nombre){
        $this->db->where('nombre',$nombre);
       $query =   $this->db->get('entornos');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
