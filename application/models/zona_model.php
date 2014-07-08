<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zona_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevaZona($data){
        
      
     if(isset($data['idjefezona']) && $data['idjefezona']==0){
          $data['idjefezona']= null;
      }
        return   $this->db->insert('zonas',array('zona'=>$data['zona'],'idjefezona'=>$data['idjefezona']));        
    }
    
    function ObtenerZonas(){
        $this->db->order_by("zona", "asc");         
        $query =   $this->db->get('zonas');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }
    
    function ObtenerZonasPaginadas($limit,$offset=0){
        if($offset==""){$offset=0;}
        
        $this->db->select('zonas.idzona,zonas.zona,usuarios.nombre')->from('zonas')->join('usuarios','zonas.idjefezona = usuarios.idusuario','left')->limit($limit,$offset);
        $query = $this->db->get();
        
        if($query->num_rows()>0)
            {
            return $query;
            }
        else {return false;}
    }
        
    function TotalRows(){
        return $this->db->count_all('zonas');
    }
            
    function ObtenerZona($id,$compuesto){
      if($compuesto)
          { 
              
         $this->db->select('zonas.idzona,zonas.zona,usuarios.nombre')->from('zonas')->join('usuarios','zonas.idjefezona = usuarios.idusuario','left')->where('idzona',$id);
     
         $query = $this->db->get();
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
          }
          else{  
              $this->db->where('idzona',$id);
              $query =   $this->db->get('zonas');
          if($query->num_rows()>0){
              return $query;
              }
              else {return false;}
              
          }
    }
    
    function ModificarZona($data){
       if(isset($data['idjefezona']) && $data['idjefezona']==0){
          $data['idjefezona']= null;
      }
      $datos = array('zona'=>$data['zona'],'idjefezona'=>$data['idjefezona']);
      
      $this->db->where('idzona',$data['idzona']);
      
       return $this->db->update('zonas',$datos);
        
    }
    
    function EliminarZona($id){
        
    return  $this->db->delete('zonas',array('idzona'=>$id));
     
     
    }
    
    function RegistrosAsociados($id){
          $this->db->where('idzona',$id);
       $query =   $this->db->get('prefecturas');
        if($query->num_rows()>0){
            return true;
        }
 else {return false;}
    }
}

?>
