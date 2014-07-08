<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function NuevoUsuario($data){
        return   $this->db->insert('usuarios',array('usuario'=>$data['usuario'],'contrasena'=>$data['contrasena'],'email'=>$data['email'],'idroles'=>$data['idroles'],'nombre'=>$data['nombre'],'idrango'=>$data['idrango']));        
    }    
    
    function ObtenerUsuariosPorRoles($rol){
        $this->db->where('idroles',$rol);
         $query = $this->db->get('usuarios');
        if($query->num_rows()>0){
            return $query;
        }
        else {return false;}
        
    }    
    
    function ObtenerRoles(){
         $this->db->order_by("rol", "asc");
         
       $query =   $this->db->get('roles');
        if($query->num_rows()>0){
            return $query;
        }
 else {return false;}
    }    
    
    function ComprobarEmail($email){
          $this->db->where('email',$email);
       $query = $this->db->get('usuarios');
        if($query->num_rows()>0){
            return true;
        }
        else {return false;}
    }    
    
    function ComprobarUsuario($usuario){
          $this->db->where('usuario',$usuario);
       $query =   $this->db->get('usuarios');
        if($query->num_rows()>0){
            return true;
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
             
              
              
              $this->db->select('indicadores.idindicador,indicadores.nombre,entornos.nombre as entorno');
$this->db->from('indicadores');
$this->db->join('entornos', 'indicadores.identorno = entornos.identorno');
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
  
    function ModificarIndicador($data){
      
      $datos = array('nombre'=>$data['nombre'],'identorno'=>$data['identorno']);
      
      $this->db->where('idindicador',$data['idindicador']);
      
       return $this->db->update('indicadores',$datos);
        
    }
    
    function EliminarIndicador($id){
        
    return  $this->db->delete('indicadores',array('idindicador'=>$id));
     
     
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
