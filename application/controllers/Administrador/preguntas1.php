<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preguntas1 extends CI_Controller {
  function __construct() {
      parent::__construct();
      $this->load->library('menu',array('active'=>'configuracion'));
      $this->load->model('preguntas_model');   
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
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Encuesta','Preguntas parte 1'),'active'=>'Preguntas parte 1'));
      $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
      //      
      
      
      //carga menu sidebar
      $this->load->library('sidebar',array('menu'=>array('Preguntas parte 1','Preguntas parte 2'),'paginas'=>array('Preguntas parte 1'=>  base_url()."preguntas1/",'Preguntas parte 2'=>  base_url()."preguntas2/"),'active'=>'Preguntas parte 1'));
      $this->data['sidebar'] = $this->sidebar->GenerarMenu();
      //    
      
      $this->data['segmento']=  $this->uri->segment(3);      
      $this->data['preguntas'] = $this->preguntas_model->ObtenerPreguntas1Paginadas('10',$this->data['segmento']);          
      $config['base_url'] = base_url().'preguntas1/index';      
      $config['total_rows'] = $this->preguntas_model->TotalRows1();      
      $config['per_page'] = '10';      
      $this->pagination->initialize($config);
      
      $this->data['paginacion'] = $this->pagination->create_links();     
           
      $vista['tab2'] = $this->load->view('Administrador/preguntas1/index.php',$this->data,TRUE);
      $vista['active2']=true;
      $this->load->view('Administrador/tabfoot.php',$vista); 
      
      
    }
 
  function obtenerPreguntaPost(){
      if(!$this->input->is_ajax_request())
           {
               redirect('404');
           }
           else
           {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){     echo '';    }else{
                        $this->form_validation->set_rules('id', 'id pregunta', 'required|trim|xss_clean|integer');
                        
                        if ($this->form_validation->run() == true)
                        {
                            $data =  $this->input->post('id');                      
                            $pregunta = $this->preguntas_model->ObtenerPregunta1($data,true)->row();
                            $devolver = array(
                                'pregunta'      => $pregunta->pregunta,                                
                                'id'            => $pregunta->idpregunta,
                                'idindicador'   => $pregunta->idindicador,
                                'indicador'     => $pregunta->indicador,
                                'tipo'          => $pregunta->tipo,
                                'idtipo'        => $pregunta->idtipo,
                                'mensaje'       => 'Pregunta obtenido exitosamente',
                                'ok'            => true,                               
                            );
                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                               'pregunta'=> $this->form_validation->set_value('pregunta'),   
                               'validacion' => validation_errors(),
                               'mensaje' => 'Error al obtener pregunta',
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
                        $this->form_validation->set_rules('idindicador', 'Indicador', 'required|trim|xss_clean|integer');
                        $this->form_validation->set_rules('pregunta', 'Pregunta', 'required|trim|xss_clean');
                        $this->form_validation->set_rules('idtipo', 'Tipo', 'required|trim|xss_clean|integer');
                        
                        if ($this->form_validation->run() == true)
                        {
                            $data = array(
                                'idindicador' => $this->input->post('idindicador'),
                                'pregunta'    => $this->input->post('pregunta'),
                                'idtipo'      => $this->input->post('idtipo')
                                );
                         
                        }
                        if ($this->form_validation->run() == true && $this->preguntas_model->NuevaPregunta1($data))
                        {
                            $pregunta = $this->preguntas_model->ObtenerPregunta1($this->preguntas_model->ultimo_id,true)->row();
                            $devolver = array(
                                'pregunta'      => $pregunta->pregunta,                                
                                'id'            => $pregunta->idpregunta,
                                'idindicador'   => $pregunta->idindicador,
                                'indicador'     => $pregunta->indicador,
                                'tipo'          => $pregunta->tipo,
                                'idtipo'        => $pregunta->idtipo,
                                'mensaje'       => 'Pregunta agregado exitosamente',
                                'ok'            => true, 
                                'contenido'     => $this->contenido->GenerarPregunta($pregunta->idpregunta,$pregunta->indicador,$pregunta->pregunta,$pregunta->tipo),
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
  
}
?>

