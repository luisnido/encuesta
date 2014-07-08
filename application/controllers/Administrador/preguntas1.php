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

  function index()
  { 
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
  function crear(){
 
      $contenido['preguntas'] = $this->preguntas_model->ObtenerPreguntas();
      
      
     $this->load->view('Administrador/preguntas1/crear.php',$contenido);
       
  } 
  
  function editar(){
      $idpregunta = $this->uri->segment(3); 
      $contenido['preguntas'] = $this->preguntas_model->ObtenerPregunta($idpregunta);
      $this->load->view('Administrador/preguntas_model/editar.php',$contenido);
  }
  function crearPost(){
      
      $data = array(
          'idindicador' => $this->input->post('idindicador'),
              'pregunta' => $this->input->post('pregunta'),
              'idparte' => 1
           //   'idtipo' => $this->input->post('idtipo'),     
              ); 
      $config = array(
          array( 
              'field' => 'idindicador',
              'label' => 'Indicador',
              'rules' => 'required'
              ),
          array('field'=>'pregunta',
              'label'=>'Pregunta',
              'rules'=>'trim|required|max_leght[255]')
                   );     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { validation_errors();
          redirect(base_url()."Pregunta1");
        }
        else
        { $this->preguntas_model->NuevaPregunta($data);    
        $this->session->set_flashdata('crear', 'Registro creado exitosamente');
          redirect(base_url()."Pregunta1");      
        }         
  }
  
  
  function editarPost(){
        
      $data = array(
          'idindicador' => $this->input->post('idindicador'),
              'pregunta' => $this->input->post('pregunta'),
              'idparte' => 1
           //   'idtipo' => $this->input->post('idtipo'),     
              ); 
      $config = array(
          array( 
              'field' => 'idindicador',
              'label' => 'Indicador',
              'rules' => 'required'
              ),
          array('field'=>'pregunta',
              'label'=>'Pregunta',
              'rules'=>'trim|required|max_leght[255]')
                   );     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { validation_errors();
          redirect(base_url()."Pregunta1");
        }
        else
        { $this->preguntas_model->ModificarPregunta($data);    
        $this->session->set_flashdata('crear', 'Registro creado exitosamente');
          redirect(base_url()."Pregunta1");      
        }   
     }
  
  function eliminar(){
      $id=  $this->uri->segment(3);
      
       $contenido['pregunta'] = $this->preguntas_model->ObtenerPregunta($id,true); 
       $this->load->view('Administrador/indicador/eliminar.php',$contenido);
      
  }
  
  function eliminarPost(){
      $id = $this->input->post('idpregunta');
      $asociado = $this->preguntas_model->RegistrosAsociados($id);
      if($asociado){
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
             redirect(base_url()."Pregunta1");
      }
      else{
     if( $this->preguntas_model->EliminarIndicador($id))
         {
     
      $this->session->set_flashdata('eliminar', 'Eliminado exitosamente');
      redirect(base_url()."Pregunta1");
         }
     }
  }
  
}
?>

