<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prefectura_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevaPrefectura($data){
         if(isset($data['idprefecto']) && $data['idprefecto']==0){
          $data['idprefecto']= null;
      }
        return   $this->db->insert('prefecturas',array('prefectura'=>$data['prefectura'],'idprefecto'=>$data['idprefecto'],'idzona'=>$data['idzona']));        
    }
    function ObtenerPrefecturas(){
        $this->db->order_by("idprefectura", "asc");         
        $query =   $this->db->get('prefecturas');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerPrefecturasPaginadas($limit,$offset=0){
        if($offset==""){$offset=0;}
        
        $this->db->select('prefecturas.idprefectura,prefecturas.prefectura,usuarios.usuario,zonas.zona')->from('prefecturas')->join('usuarios','prefecturas.idprefecto = usuarios.idusuario','left')->join('zonas','prefecturas.idzona = zonas.idzona')->limit($limit,$offset);
        $query = $this->db->get();
        
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
    
    
    function TotalRows(){
        return $this->db->count_all('prefecturas');
    }
            
    function ObtenerPrefectura($id,$compuesto){
      if($compuesto)
          { 
              
      
       $this->db->select('prefecturas.idprefectura,prefecturas.prefectura,usuarios.usuario,zonas.zona')->from('prefecturas')->join('usuarios','prefecturas.idprefecto = usuarios.idusuario','left')->join('zonas','prefecturas.idzona = zonas.idzona')->where('idprefectura',$id);
       
         $query = $this->db->get();
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
          }
          else{  
              $this->db->where('idprefectura',$id);
              $query =   $this->db->get('prefecturas');
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
              
          }
    }
  function  ModificarPrefectura($data){
      if(isset($data['idprefecto']) && $data['idprefecto']==0){
          $data['idprefecto']= null;
      }
      $datos = array('prefectura'=>$data['prefectura'],'idprefecto'=>$data['idprefecto'],'idzona'=>$data['idzona']);
      
      $this->db->where('idprefectura',$data['idprefectura']);
      
       return $this->db->update('prefecturas',$datos);
        
    }
    
    function EliminarPrefectura($id){
        
    return  $this->db->delete('prefecturas',array('idprefectura'=>$id));
     
     
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idprefectura',$id);
       $query =   $this->db->get('comisarias');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
