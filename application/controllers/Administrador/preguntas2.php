<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preguntas2 extends CI_Controller {
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
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Encuesta','Preguntas parte 2'),'active'=>'Preguntas parte 2'));
      $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
      //      
      
      
      //carga menu sidebar
      $this->load->library('sidebar',array('menu'=>array('Preguntas parte 2'),'paginas'=>array('Preguntas parte 2'=>  base_url()."preguntas2/"),'active'=>'Preguntas parte 2'));
      $this->data['sidebar'] = $this->sidebar->GenerarMenu();
      //    
      
      $this->data['segmento']  = $this->uri->segment(4);      
      $this->data['preguntas'] = $this->preguntas_model->ObtenerPreguntas2Paginadas('10',$this->data['segmento']);          
      $config['base_url']      = base_url().'administrador/preguntas2/index';      
      $config['total_rows']    = $this->preguntas_model->TotalRows2();      
      $config['per_page']      = '10';      
      $this->pagination->initialize($config);      
      $this->data['paginacion']  = $this->pagination->create_links();     
           
      $this->data['indicadores'] = $this->preguntas_model->ObtenerIndicadoresNoAsignados();      
      
      $vista['tab2'] = $this->load->view('Administrador/preguntas2/index.php',$this->data,TRUE);
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
                            $pregunta = $this->preguntas_model->ObtenerPregunta2($data,true)->row();
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
                                'idtipo'      => $this->input->post('idtipo'),
                                'idparte'     => '2'
                                );
                         
                        }
                        if ($this->form_validation->run() == true && $this->preguntas_model->NuevaPregunta2($data))
                        {
                            $pregunta = $this->preguntas_model->ObtenerPregunta2($this->preguntas_model->ultimo_id,true)->row();
                            $devolver = array(
                                'pregunta'      => $pregunta->pregunta,                                
                                'id'            => $pregunta->idpregunta,
                                'idindicador'   => $pregunta->idindicador,
                                'indicador'     => $pregunta->indicador,
                                'tipo'          => $pregunta->tipo,
                                'idtipo'        => $pregunta->idtipo,
                                'mensaje'       => 'Pregunta agregado exitosamente',
                                'ok'            => true, 
                                'contenido'     => $this->contenido->GenerarPregunta2($pregunta->idpregunta,$pregunta->indicador,$pregunta->pregunta,$pregunta->tipo),
                            );
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                               'pregunta'=> form_error('pregunta','<span class="help-inline">','</span>'),   
                               'validacion' => validation_errors(),
                               'ok' => false
                               );
                           echo json_encode($devolver);
                        }
                }   
           }
  } 
  
  
  
  function ObtenerTipos(){
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
                        $this->form_validation->set_rules('idindicador','Indicador','required|trim|xss_clean|integer');
                     
                        if ($this->form_validation->run() == true)
                        {                           
                            $id = $this->input->post('idindicador');
                           
                                                   
                      $query=   $this->preguntas_model->ObtenerTiposNoAsignados($id);
                      $options =" <option value='' disabled>Seleccione un tipo</option>";
                      if($query){
                          foreach ($query->result() as $q){
                              $options = $options."<option value='".$q->idtipo."'>".$q->nombre.'</option>';
                          }
                      }
                           
                        $devolver = array(
                                'contenido'  => $options,                               
                                'ok'       => true
                            );                            
                            echo json_encode($devolver);
                        }
                        else {
                           $devolver = array( 
                              'mensaje' => validation_errors(),
                               'ok' => false
                               );
                           echo json_encode($devolver);
                        }
                       
                    
                }
		
           }
        }
        
  function ObtenerIndicadores(){
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
                      
                           
                                                   
                      $query=   $this->preguntas_model->ObtenerIndicadoresNoAsignados();
                      $options =" <option value='' disabled>Seleccione un indicador</option>";
                      if($query){
                          foreach ($query->result() as $q){
                              $options = $options."<option value='".$q->idindicador."'>".$q->nombre.'</option>';
                          }
                      }
                           
                        $devolver = array(
                                'contenido'  => $options,                               
                                'ok'       => true
                            );                            
                            echo json_encode($devolver);
                        }
           
                       
                    
                
		
           }
        }
       
}
?>

