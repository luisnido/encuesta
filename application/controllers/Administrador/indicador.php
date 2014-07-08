<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indicador extends CI_Controller {
  function __construct() {
      parent::__construct();
      $this->load->library('menu',array('active'=>'configuracion'));
      $this->load->model('indicador_model');
   
      $this->data['head']    = $this->header->GenerarHeader();
      $this->data['foot']    = $this->footer->GenerarFooter();
      $this->data['menu']    = $this->menu->GenerarMenu();
      $this->data['usuario'] = $this->session->userdata('username');
      
  }

function index(){ 
        if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
  		   {
  			   redirect('auth', 'refresh');
  		    }

       //carga menu navegacion
        $this->load->library('navegacion',array('menu'=>array('Configuracion','CMO','Indicadores'),'active'=>'Indicadores'));
        $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
        //            
        
        //carga menu sidebar
        $this->load->library('sidebar',array('menu'=>array('Entornos','Indicadores'),'paginas'=>array('Entornos'=>  base_url()."administrador/entorno/",'Indicadores'=>  base_url()."administrador/indicador/"),'active'=>'Indicadores'));
        $this->data['sidebar'] = $this->sidebar->GenerarMenu();
        //    
        
        $this->data['segmento']=  $this->uri->segment(4);
        
        $this->data['indicadores'] = $this->indicador_model->ObtenerIndicadoresPaginados('10',$this->data['segmento']);
        $this->data['entornos'] = $this->indicador_model->ObtenerEntornos();

        $config['base_url'] = base_url().'administrador/indicador/index';
        $config['total_rows'] = $this->indicador_model->TotalRows();
        $config['per_page'] = '10';
        $this->pagination->initialize($config);
        $this->data['paginacion'] = $this->pagination->create_links();      
          
        $vista['tab1'] = $this->load->view('Administrador/indicador/index.php',$this->data,TRUE);
        $vista['active1']=true;
        $this->load->view('Administrador/tabfoot.php',$vista);    
  }

function obtenerIndicadorPost(){
      if(!$this->input->is_ajax_request())
           {
               redirect('404');
           }
           else
           {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){     echo '';    }else{
                        $this->form_validation->set_rules('id', 'id indicador', 'required|trim|xss_clean|integer');
                        
                        if ($this->form_validation->run() == true)
                        {
                            $data =  $this->input->post('id');                      
                            $indicador = $this->indicador_model->ObtenerIndicador($data,true)->row();
                            $devolver = array(
                                'nombre'        => $indicador->nombre,                                
                                'id'            => $indicador->idindicador,
                                'identorno'     => $indicador->identorno,
                                'entorno'       => $indicador->entorno,
                                'mensaje'       => 'Indicador obtenido exitosamente',
                                'ok'            => true,                               
                            );
                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                               'nombre'=> $this->form_validation->set_value('nombre'),   
                               'validacion' => validation_errors(),
                               'mensaje' => 'Error al obtener indicador',
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
                        $this->form_validation->set_rules('identorno', 'Entorno', 'required|trim|xss_clean|integer');
                        if ($this->form_validation->run() == true)
                        {
                            $data = array(
                                'nombre' => $this->input->post('nombre'),  
                                'identorno' => $this->input->post('identorno'),       
                                );
                         
                        }
                        if ($this->form_validation->run() == true && $this->indicador_model->NuevoIndicador($data))
                        {
                            $indicador = $this->indicador_model->ObtenerIndicador($this->indicador_model->ultimo_id,true)->row();
                            $devolver = array(
                                'nombre'      => $indicador->nombre,                                
                                'id'          => $indicador->idindicador,
                                'entorno'     => $indicador->entorno,
                                'mensaje'     => 'Indicador agregado exitosamente',
                                'ok'          => true,
                                'contenido'   => $this->contenido->GenerarIndicador($indicador->idindicador,$indicador->nombre,$indicador->entorno),
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
                       $_SESSION['id_m'] = $this->input->post('id');
                        $this->form_validation->set_rules('id','id','required|trim|xss_clean|integer');
                        $this->form_validation->set_rules('nombre','Nombre','required|trim|xss_clean|max_length[35]|callback_nombre_check');
                        $this->form_validation->set_rules('identorno', 'Entorno', 'required|trim|xss_clean|integer');
                        

                        if ($this->form_validation->run() == true)
                        {  
                            $data = array( 
                                'idindicador' => $this->input->post('id'),
                                'nombre'      => $this->input->post('nombre'),  
                                'identorno'   => $this->input->post('identorno'),  
                                );
                        
                        }
                          if ($this->form_validation->run() == true &&  $this->indicador_model->ModificarIndicador($data))
                        {
                            $indicador  = $this->indicador_model->ObtenerIndicador($data['idindicador'],true)->row();
                            $devolver = array(
                                
                                'nombre'      => $indicador->nombre,                                
                                'id'          => $indicador->idindicador,
                                'identorno'   => $indicador->identorno,
                                'ok'          => true,
                                'mensaje'     => 'Indicador modificado exitosamente',                                
                                'contenido'   => $this->contenido->GenerarIndicador($indicador->idindicador,$indicador->nombre,$indicador->entorno),                         
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
                          if ($this->form_validation->run() == true && $this->indicador_model->EliminarIndicador($id))
                        {                            
                            $devolver = array(
                                'eliminado'   => $eliminado,                                
                                'ok'          => true,
                                'id'          => $id,
                                'mensaje'     => 'Indicador eliminado exitosamente',                                
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
     if($this->indicador_model->MismoNombre($nombre))  {  
      $this->form_validation->set_message('nombre_check', 'Ya existe un indicador con este nombre');
      return false;
     }else{return true;}
  }  
  
  function id_check($id){
     if($this->indicador_model->RegistrosAsociados($id))  {  
      $this->form_validation->set_message('id_check', 'El indicador posee registros asociados, no se puede eliminar');
      return false;
     }else{return true;}
  } 
  
  function _render_page($view, $data=null, $render=false){

    $this->viewdata = (empty($data)) ? $this->data: $data;

    $view_html = $this->load->view($view, $this->viewdata, $render);

    if (!$render) return $view_html;
  }



  
}?>
