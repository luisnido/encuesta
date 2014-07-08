<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Situacion_laboral_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevaSituacion($data){
    return    $this->db->insert('situacion_laboral',array('situacionlaboral'=>$data['situacionlaboral']));        
    }
    
    function ObtenerSituaciones(){
        $this->db->order_by("idsituacionlaboral", "desc");
         
       $query =   $this->db->get('situacion_laboral');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerSituacionesPaginadas($limit,$offset=0){
        $this->db->order_by('idsituacionlaboral','desc');
          $query =   $this->db->get('situacion_laboral',$limit,$offset);
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('situacion_laboral');
    }
            
    function ObtenerSituacion($id){
      
        $this->db->where('idsituacionlaboral',$id);
       $query =   $this->db->get('situacion_laboral');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ModificarSituacion($data){
      
      $datos = array('situacionlaboral'=>$data['situacionlaboral']);
      
      $this->db->where('idsituacionlaboral',$data['idsituacionlaboral']);
      
       return   $this->db->update('situacion_laboral',$datos);
        
    }
    
    function EliminarSituacion($id){
        
      return  $this->db->delete('situacion_laboral',array('idsituacionlaboral'=>$id));
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idsituacionlaboral',$id);
       $query =   $this->db->get('encuestas');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
