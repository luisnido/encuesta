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
    
    function ObtenerPreguntas2Paginadas($limit,$offset=0){
        $this->db->select('preguntas.idpregunta,preguntas.pregunta,preguntas.idtipo,preguntas.idindicador,indicadores.nombre as indicador, tipos_pregunta.nombre as tipo');
        $this->db->from('preguntas');
        $this->db->join('indicadores', 'preguntas.idindicador = indicadores.idindicador');
        $this->db->join('tipos_pregunta', 'preguntas.idtipo = tipos_pregunta.idtipo');
        $this->db->where('idparte',2);
        $this->db->order_by('idpregunta','desc');  
        $this->db->limit($limit,$offset);    
        $query = $this->db->get();
       //echo $this->db->last_query();
        if($query && $query->num_rows()>0)
            {
            return $query;
            }
        else{return false;}
    }
    
    function ObtenerPreguntas1Paginadas($limit,$offset=0){
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
    
    
    function ObtenerPregunta($id,$compuesto){      
        if($compuesto)
      { 
              $this->db->select('preguntas.idpregunta,preguntas.idindicador,preguntas.pregunta,preguntas.idparte,preguntas.idtipo,tipos_pregunta.nombre as tipo,indicadores.nombre as indicador');
              $this->db->from('preguntas');
              $this->db->join('tipo_preguntas','preguntas.idtipo = tipo_preguntas.idtipo');
              $this->db->join('indicadores','preguntas.idindicador = indicadores.idindicador');
              $this->db->where('idparte',2);
              $this->db->where('idpregunta',$id);
              $query = $this->db->get();
              
          if($query->num_rows()>0){
              return $query;
              }
          else {return false;}
      }
      else{  
              $this->db->where('idpregunta',$id);
              $query = $this->db->get('pregunta');
              if($query->num_rows()>0)
              {
                 return $query;
              }
              else{return false;}
              
          }
    }
    
    function ObtenerIndicadores(){
      $this->db->order_by("nombre", "asc");         
      $query = $this->db->get('indicadores');
        if($query->num_rows()>0){
            return $query;
           }
        else {return false;}
  }
  
    function ObtenerIndicadoresNoAsignados(){
        $q='select *
                from indicadores 
                where idindicador NOT IN (SELECT idindicador
                FROM preguntas
                WHERE  preguntas.idparte = 1 AND preguntas.idtipo = 1 ) or idindicador NOT IN (SELECT idindicador
                FROM preguntas
                WHERE  preguntas.idparte = 2 AND preguntas.idtipo = 2 )';  
        $query = $this->db->query($q);
          if($query->num_rows()>0){
              return $query;
             }
       else {return false;}
    }
    function ObtenerTiposNoAsignados($idindicador){
        $q='select *
            from tipos_pregunta
            where idtipo NOT IN (SELECT idtipo
            FROM preguntas
            WHERE  preguntas.idparte = 2 and preguntas.idindicador = '.$idindicador.' ) and (idtipo = 1 or idtipo =2)';  
        $query = $this->db->query($q);
          if($query->num_rows()>0){
              return $query;
             }
       else {return false;}
    }
    
    function ModificarPregunta($data){      
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
