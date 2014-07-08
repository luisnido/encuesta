<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 */
class Inicio extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
         $this->load->library('menu',array('active'=>'inicio'));
    }
    
    public function index()
    {
       
            
          if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
           $data['head']    = $this->header->GenerarHeader();
           $data['foot']    = $this->footer->GenerarFooter();
           $data['menu']    = $this->menu->GenerarMenu();
           $data['usuario'] = $this->session->userdata('username');

	   $this->load->view('Administrador/admin.php',$data);
            
        
    }
    
      function _render_page($view, $data=null, $render=false){

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}
        
       
}