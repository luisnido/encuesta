<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entorno extends CI_Controller {
  function __construct() {
      parent::__construct();
      $this->load->library('menu',array('active'=>'configuracion'));
      $this->load->model('entorno_model');
   
      $this->data['head']    = $this->header->GenerarHeader();
      $this->data['foot']    = $this->footer->GenerarFooter();
      $this->data['menu']    = $this->menu->GenerarMenu();
      $this->data['usuario'] = $this->session->userdata('username');
      
  }

  function index()
  { 
      if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
      {
		    redirect('auth', 'refresh');
	    }
                   
     //carga menu navegacion
      $this->load->library('navegacion',array('menu'=>array('Configuracion','CMO','Entorno'),'active'=>'Entorno'));
      $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
      //      
      
      //carga menu sidebar
      $this->load->library('sidebar',array('menu'=>array('Entornos','Indicadores'),'paginas'=>array('Entornos'=>  base_url()."administrador/entorno/",'Indicadores'=>  base_url()."administrador/indicador/"),'active'=>'Entornos'));
      $this->data['sidebar'] = $this->sidebar->GenerarMenu();
      //    
      
      $this->data['segmento']=  $this->uri->segment(4);   

      $this->data['entornos'] = $this->entorno_model->ObtenerEntornosPaginados('10',$this->data['segmento']); 
      
      $config['base_url'] = base_url().'administrador/entorno/index';
      $config['total_rows'] = $this->entorno_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $this->data['paginacion'] = $this->pagination->create_links();
      
      $vista['tab1'] = $this->load->view('Administrador/entorno/index.php',$this->data,TRUE);
      $vista['active1']=true;
      $this->load->view('Administrador/tabfoot.php',$vista);      
  }
  
  
  
  function obtenerEntornoPost(){
      if(!$this->input->is_ajax_request())
           {
               redirect('404');
           }
           else
           {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){			echo '';		}else{
                        $this->form_validation->set_rules('id', 'id entorno', 'required|trim|xss_clean|integer');
                        
                        if ($this->form_validation->run() == true)
                        {
                            $data =  $this->input->post('id');                      
                            $entorno = $this->entorno_model->ObtenerEntorno($data)->row();
                            $devolver = array(
                                'nombre'      => $entorno->nombre,                                
                                'id'          => $entorno->identorno,
                                'mensaje'     => 'Entorno obtenido exitosamente',
                                'ok'          => true,                               
                            );
                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                               'nombre'=> $this->form_validation->set_value('nombre'),   
                               'validacion' => validation_errors(),
                               'mensaje' => 'Error al obtener entorno',
                               'ok' => false
                               );
                           echo json_encode($devolver);
                        }
                }		
           }
  }
  
  function crearPost(){     
       if(!$this->input->is_ajax_request())
          {
             redirect('404');
          }
           else
           {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
                {
                			echo '';
                      		}else{
                        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|xss_clean|max_length[35]|callback_nombre_check');
                    
                        if ($this->form_validation->run() == true)
                        {
                            $data = array(
				'nombre' => $this->input->post('nombre'),
				
                                );
                         
                        }
                        if ($this->form_validation->run() == true && $this->entorno_model->NuevoEntorno($data))
                        {
                            $entorno = $this->entorno_model->ObtenerEntorno($this->entorno_model->ultimo_id)->row();
                            $devolver = array(
                                'nombre'      => $entorno->nombre,                                
                                'id'          => $entorno->identorno,
                                'mensaje'     => 'Entorno agregado exitosamente',
                                'ok'          => true,
                                'contenido'   => $this->contenido->GenerarEntorno($entorno->identorno,$entorno->nombre),
                            );
                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                               'nombre'=> form_error('nombre','<span class="help-inline">','</span>'),   
                               'validacion' => validation_errors(),
                               'ok' => false
                               );
                           echo json_encode($devolver);
                        }
                }		
           }
  } 
  
  function editarPost(){
     if(!$this->input->is_ajax_request())
           {
               redirect('404');
           }
           else
           {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
                 {
			             echo '';
		             }else{
                        $this->form_validation->set_rules('id','id','required|trim|xss_clean|integer');
                        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|xss_clean|max_length[35]|callback_nombre_check');
                        

                        if ($this->form_validation->run() == true)
                        {  
                            $data = array( 
                                'identorno'      => $this->input->post('id'),
			                         	'nombre'      => $this->input->post('nombre'),				
                                );
                        
                        }
                          if ($this->form_validation->run() == true &&  $this->entorno_model->ModificarEntorno($data))
                        {
                            $entorno  = $this->entorno_model->ObtenerEntorno($data['identorno'])->row();
                            $devolver = array(
                                
                                'nombre'      => $entorno->nombre,                                
                                'id'          => $entorno->identorno,
                                'ok'          => true,
                                'mensaje'     => 'Entorno modificado exitosamente',                                
                                'contenido'   => $this->contenido->GenerarEntorno($entorno->identorno,$entorno->nombre),                         
                            );
                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                               
                               'validacion' => validation_errors(),
                               'nombre'     => form_error('nombre','<span class="help-inline">','</span>'),                             
                               'ok'         => false
                               );
                           echo json_encode($devolver);
                        }
                }
              }
         }
   
  function eliminarPost(){
      if(!$this->input->is_ajax_request())
           {
               redirect('404');
           }
           else
           {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	    	{
		    	echo '';
		     }else{
                        $this->form_validation->set_rules('id','id','required|trim|xss_clean|integer|callback_id_check');
                        $eliminado=false;

                        if ($this->form_validation->run() == true)
                        {                           
                       
                            $id =  $this->input->post('id');
                       
                        }
                          if ($this->form_validation->run() == true && $this->entorno_model->EliminarEntorno($id))
                        {
                            
                            $devolver = array(
                                'eliminado'   => $eliminado,                                
                                'ok'          => true,
                                'id'          => $id,
                                'mensaje'     => 'Entorno eliminado exitosamente',                                
                            );
                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                              'eliminado'   => $eliminado,  
                               'validacion' => validation_errors(),
                               'id'         => form_error('id', '"', '"'),                              
                               'ok'         => false
                               );
                           echo json_encode($devolver);
                        }
                       
                    
                }
		
           }
  }
  
  function nombre_check($nombre){
     if($this->entorno_model->MismoNombre($nombre))  {  
      $this->form_validation->set_message('nombre_check', 'Ya existe un entorno con este nombre');
      return false;
     }else{return true;}
  }  
  
  function id_check($id){
     if($this->entorno_model->RegistrosAsociados($id))  {  
      $this->form_validation->set_message('id_check', 'El entorno posee registros asociados, no se puede eliminar');
      return false;
     }else{return true;}
  } 
  
  function _render_page($view, $data=null, $render=false){

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}
}
?>
