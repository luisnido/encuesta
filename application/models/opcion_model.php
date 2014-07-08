<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Opcion_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevaOpcion($data){
    return    $this->db->insert('opciones',array('frase_percepcion'=>$data['frase_percepcion'],'valor'=>$data['valor']));        
    }
    
    function ObtenerOpciones(){
        $this->db->order_by("idpercepcion", "desc");
         
       $query =   $this->db->get('opciones');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerOpcionesPaginadas($limit,$offset=0){
        $this->db->order_by('idpercepcion','desc');
          $query =   $this->db->get('opciones',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('opciones');
    }
            
    function ObtenerOpcion($id){
      
        $this->db->where('idpercepcion',$id);
       $query =   $this->db->get('opciones');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ModificarOpcion($data){
      
      $datos = array('frase_percepcion'=>$data['frase_percepcion'],'valor'=>$data['valor']);
      
      $this->db->where('idpercepcion',$data['idpercepcion']);
      
       return   $this->db->update('opciones',$datos);
        
    }
    
    function EliminarOpcion($id){
        
      return  $this->db->delete('opciones',array('idpercepcion'=>$id));
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idpercepcion',$id);
       $query =   $this->db->get('respuestas');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
