<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Indicador_model extends CI_Model {
public $ulitmo_id='';
function __construct() {
        parent::__construct();
        $this->load->database();
    }
function NuevoIndicador($data){
       
        $this->db->insert('indicadores',$data);
          $this->ultimo_id= $this->db->insert_id();
          if($this->db->affected_rows() >0){           
          return true;
          }else{
          
              return false;
          }       
    }
    
function ObtenerEntornos(){
      $this->db->order_by("nombre", "asc");
         
      $query =   $this->db->get('entornos');
        if($query->num_rows()>0){
            return $query;
           }
     else {return false;}
  }
    
function ObtenerIndicadoresPaginados($limit,$offset=0){
        if($offset==""){$offset=0;}
       /* $this->db->order_by('idindicador','desc');
          $query =   $this->db->get('indicadores',$limit,$offset);*/
        $q = 'select indicadores.idindicador,indicadores.nombre,entornos.nombre as entorno from indicadores inner join entornos ON indicadores.identorno = entornos.identorno order by indicadores.idindicador desc limit '.$limit.' offset '.$offset.' ';
       $query = $this->db->query($q);
        
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
function TotalRows(){
   return $this->db->count_all('indicadores');
}
            
function ObtenerIndicador($id,$compuesto){
      if($compuesto)
      { 
              $this->db->select('indicadores.idindicador,indicadores.nombre,indicadores.identorno,entornos.nombre as entorno');
              $this->db->from('indicadores');
              $this->db->join('entornos','indicadores.identorno = entornos.identorno');
              $this->db->where('idindicador',$id);
              $query = $this->db->get();
              
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
      }
      else{  
              $this->db->where('idindicador',$id);
              $query =   $this->db->get('indicadores');
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
              
          }
    }
  
function  ModificarIndicador($data){
      
      $datos = array('nombre'=>$data['nombre'],'identorno'=>$data['identorno']);
      
      $this->db->where('idindicador',$data['idindicador']);
      
      $this->db->update('indicadores',$datos);
       if($this->db->affected_rows() >0){
          return true;          
      }else{          
          return false;
          }
        
    }
    
function EliminarIndicador($id){
        
    $this->db->delete('indicadores',array('idindicador'=>$id));
    if($this->db->affected_rows() >0){
          return true;          
      }else{          
          return false;
          }
     
     
}

function MismoNombre($nombre){
      if(isset($_SESSION['id_m'])){
      
        $id = $_SESSION['id_m'];
        $this->db->where("(nombre = '$nombre' AND idindicador != '$id')");
       $query =   $this->db->get('indicadores');
       $_SESSION['id_m']='';
       unset($_SESSION['id_m']);
     }else{

       $this->db->where('nombre',$nombre);
       $query =   $this->db->get('indicadores');
     }
        
        if($query->num_rows()>0){
            return true;
        }
        else {return false;}
    }

function RegistrosAsociados($id){
          $this->db->where('idindicador',$id);
       $query =   $this->db->get('preguntas');
        if($query->num_rows()>0){
            return true;
         }
       else {return false;}
}

}
?>
