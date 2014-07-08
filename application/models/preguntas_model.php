<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Preguntas_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevaPregunta($data){
     $q=   $this->db->insert('preguntas',array(
          'idindicador' => $data['idindicador'],
              'pregunta' => $data['pregunta'],
              'idparte' => $data['idparte'],
            'idtipo'=>$data['idtipo']
              )); 
     }
     
    function ObtenerPreguntas(){
        $this->db->order_by("idpregunta", "desc");         
        $query = $this->db->get('preguntas');
        if($query->num_rows()>0){
            return $query;
        }
        else{
            return false;            
        }
    }
    
    function ObtenerPreguntas1Paginadas($limit,$offset=0){
        $this->db->select('preguntas.');
        $this->db->from('preguntas');
        $this->db->join('indicadores', 'preguntas.idindicador = indicadores.id');
        $this->db->where('idparte',1);
        $this->db->where('idtipo',1);
        $this->db->order_by('idpregunta','desc');        
        $query = $this->db->get('preguntas',$limit,$offset);
        if($query && $query->num_rows()>0)
            {
            return $query;
            }
        else{return false;}
    }
    
    function ObtenerPreguntas2Paginadas($limit,$offset=0){
        $this->db->where('idparte',2);
       
        $this->db->order_by('idpregunta','desc');
        
          $query = $this->db->get('preguntas',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
    
    function TotalRows1(){
         $this->db->where('idparte',1);
         $this->db->where('idtipo',1);
  return $this->db->count_all('preguntas');
    }
          
    function TotalRows2(){
         $this->db->where('idparte',2);      
  return $this->db->count_all('preguntas');
    }
    
    
    function ObtenerPregunta($id){      
       $this->db->where('idpregunta',$id);       
       $query = $this->db->get('preguntas');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    
    function  ModificarPregunta($data){      
      $datos = array(
          'idindicador'=>$data['idindicador'],
          'pregunta'=>$data['pregunta'],
          'idparte'=>$data['idparte'],
          'idtipo'=>$data['idtipo']
          );      
      $this->db->where('idpregunta',$data['idpregunta']);
      $query = $this->db->update('preguntas',$datos);
    }
    
    function EliminarPregunta($id){        
        $this->db->delete('entornos',array('idpregunta'=>$id));
    }
    
    function RegistrosAsociados($id){
        $this->db->where('idpregunta',$id);
        $query =  $this->db->get('preguntas');
        if($query->num_rows()>0){
            return true;
        }
        else {
            return false;            
        }
    }
}

?>
