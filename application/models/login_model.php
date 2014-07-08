<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
	$this->load->database();
    }
    
    
    public function agregar_admin(){
        $this->db->where('usuario','admin');
        $this->db->where('contrasena',  sha1('123456'));
        $query = $this->db->get('usuarios');
        
        if($query->num_rows() == 1)
        {
            return true;
        }else{
          
         if($this->db->insert('usuarios',array('usuario'=>'admin','contrasena'=>sha1('123456'),'email'=>'admin@admin.com','idroles'=>1))){
             return false;
         }else{
             return true;
         }
         
         
        }
    }
    
    
    public function login_user($usuario,$contrasena)
    {
        $this->db->where('usuario',$usuario);
        $this->db->where('contrasena',$contrasena);
        $query = $this->db->get('usuarios');
        if($query->num_rows() == 1)
        {
            return $query->row();
        }else{
            $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
            redirect(base_url().'login','refresh');
        }
    }
}