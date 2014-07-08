<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comisaria_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevaComisaria($data){
        return   $this->db->insert('comisaria',$data);        
    }
    
    
    function ObtenerRegiones(){
        $this->db->order_by("idregion", "asc");         
        $query =   $this->db->get('regiones');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    
    
    function ObtenerComunarPorRegion($id){
        $this->db->where('idregion',$id);
             $this->db->order_by("nombre", "asc");  
         $query = $this->db->get('comunas');
        if($query->num_rows()>0){
            return $query;
        }
        else {return false;}
    }
    
    
    function ObtenerComisarias(){
        $this->db->order_by("idcomisaria", "asc");         
        $query =   $this->db->get('comisarias');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerComisariasPaginadas($limit,$offset=0){
        if($offset==""){$offset=0;}
        
        $this->db->select('comisarias.idcomisaria,comisarias.nombre,comisarias.direccion,comunas.nombre,usuarios.usuario,prefecturas.prefectura')->from('comisarias')->join('comunas','comisarias.idcomuna = comunas.idcomuna')->join('usuarios','comisarias.idcomisario = usuarios.idusuario','left')->join('prefecturas','comisarias.idprefectura = prefecturas.idprefectura')->limit($limit,$offset);
        $query = $this->db->get();
        
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
    
    
    function TotalRows(){
        return $this->db->count_all('comisarias');
    }
            
    function ObtenerComisaria($id,$compuesto){
      if($compuesto)
          { 
              
       $this->db->select('comisarias.idcomisaria,comisarias.nombre,comisarias.direccion,comunas.nombre,usuarios.usuario,prefecturas.prefectura')->from('comisarias')->join('comunas','comisarias.idcomuna = comunas.idcomuna')->join('usuarios','comisarias.idcomisario = usuarios.idusuario')->join('prefecturas','comisarias.idprefectura = prefecturas.idprefectura')->where('idcomisaria',$id)->limit($limit,$offset);
     
        
         $query = $this->db->get();
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
          }
          else{  
              $this->db->where('idcomisaria',$id);
              $query =   $this->db->get('comisarias');
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
              
          }
    }
  function  ModificarComisaria($data){
      
      $datos = array('nombre'=>$data['nombre'],'direccion'=>$data['direccion'],'idcomuna'=>$data['idcomuna'],'idcomisario'=>$data['idcomisario'],'idprefectura'=>$data['idprefectura']);
      
      $this->db->where('idcomisaria',$data['idcomisaria']);
      
      return $this->db->update('comisarias',$datos);
        
    }
    
    function EliminarComisaria($id){
        
    return  $this->db->delete('comisarias',array('idcomisaria'=>$id));
     
     
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idcomisaria',$id);
       $query = $this->db->get('encuestas');
       
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
