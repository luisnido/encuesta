<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivel_estudio extends CI_Controller {
  function __construct() {
      parent::__construct();
    
      
      $this->load->model('nivel_estudio_model');
   
      
  }

  function index()
  {
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Datos Encuesta','Nivel Estudio'),'active'=>'Nivel Estudio'));
      $contenidos['navegacion'] = $this->navegacion->GenerarNavegacion();
      
      $this->load->library('sidebar',array('menu'=>array('Opciones','Situacion Laboral','Rango Edad','Nivel Estudio','Ingreso Familiar'),'paginas'=>array('Opciones'=>  base_url()."administrador/opcion/",'Situacion Laboral'=>  base_url()."administrador/situacion/",'Rango Edad'=>  base_url()."administrador/rango_edad/",'Nivel Estudio'=>  base_url()."administrador/nivel_estudio/",'Ingreso Familiar'=>  base_url()."administrador/ingreso_familiar/"),'active'=>'Nivel Estudio'));
      $contenidos['sidebar'] = $this->sidebar->GenerarMenu();
    
      
      $contenidos['segmento']=  $this->uri->segment(4);
      
      $config['base_url'] = base_url().'administrador/nivel_estudio/index';
      $config['total_rows'] = $this->nivel_estudio_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $contenidos['paginacion'] = $this->pagination->create_links();
      $contenidos['niveles'] = $this->nivel_estudio_model->ObtenerNivelesPaginados('10',$contenidos['segmento']);
 
      
      $vista['active2h'] =true; 
      
            $this->load->view('Administrador/header.php',$vista);
      
      $vista['tab2'] = $this->load->view('Administrador/nivel_estudio/index.php',$contenidos,TRUE);
      $vista['active2'] = true;
     
      $this->load->view('Administrador/menu.php',$vista);
      $this->load->view('Administrador/footer.php');
           
           
           
           
           
  }
  function crear(){
 
   $this->load->view('Administrador/nivel_estudio/crear.php');
       
  } 
  
  function editar(){
      $idnivelestudio = $this->uri->segment(4); 
      $contenido['nivel'] = $this->nivel_estudio_model->ObtenerNivel($idnivelestudio);
  $this->load->view('Administrador/nivel_estudio/editar.php',$contenido);
 
  }
  function crearPost(){
      
      $data = array(
          'nivelestudio'=>  $this->input->post('nivelestudio')
              ); 
      $config = array(
          array(
              'field' => 'nivelestudio',
              'label' => 'Nivel de Estudios',
              'rules' => 'trim|required|max_length[100]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
          //redirect(base_url()."Entorno");
        }
        else
        {
           if( $this->nivel_estudio_model->NuevoNivel($data)){
               $this->session->set_flashdata('crear', 'Registro creado exitosamente');
               echo json_encode(array('crear'=>'ok'));
               }else{
                   echo json_encode(array('crear'=>'error'));
                   }        
        }
  }
  
  
  function editarPost(){
      $data = array(
          'idnivelestudio'=>$this->input->post('idnivelestudio'),
          'nivelestudio'=>  $this->input->post('nivelestudio')
              ); 
      
      
      $config = array(
          array(
              'field' => 'nivelestudio',
              'label' => 'Nivel de Estudios',
              'rules' => 'trim|required|max_length[100]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
        }
        else
        {if($this->nivel_estudio_model->ModificarNivel($data)){
        $this->session->set_flashdata('modificar', 'Registro modificado correctamente');
        echo json_encode(array('editar' => 'ok')); 
        }else{   echo json_encode(array('editar' => 'error')); }   }
     }
  
  function eliminar(){
      $id=  $this->uri->segment(4);
      
       $contenido['nivel'] = $this->nivel_estudio_model->ObtenerOpcion($id); 
       $this->load->view('Administrador/nivel_estudio/eliminar.php',$contenido);
      
  }
  
  function eliminarPost(){
      $id = $this->input->post('idnivelestudio');
      $asociado = $this->nivel_estudio_model->RegistrosAsociados($id);
      if($asociado){
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
            echo json_encode(array('eliminar' => 'ok')); 
      }
      else{
          if($this->nivel_estudio_model->EliminarNivel($id)){
              $this->session->set_flashdata('eliminar', 'Eliminado exitosamente');
              echo json_encode(array('eliminar' => 'ok')); 
              }
              else{
              echo json_encode(array('eliminar' => 'error')); 
              }
      
      }
  }
  
}
?>
