<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opcion extends CI_Controller {
  function __construct() {
      parent::__construct();
    
      
      $this->load->model('opcion_model');
   
      
  }

  function index()
  {
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Datos Encuesta','Opciones'),'active'=>'Opciones'));
      $contenidos['navegacion'] = $this->navegacion->GenerarNavegacion();
      
      $this->load->library('sidebar',array('menu'=>array('Opciones','Situacion Laboral','Rango Edad','Nivel Estudio','Ingreso Familiar'),'paginas'=>array('Opciones'=>  base_url()."administrador/opcion/",'Situacion Laboral'=>  base_url()."administrador/situacion/",'Rango Edad'=>  base_url()."administrador/rango_edad/",'Nivel Estudio'=>  base_url()."administrador/nivel_estudio/",'Ingreso Familiar'=>  base_url()."administrador/ingreso_familiar/"),'active'=>'Opciones'));
      $contenidos['sidebar'] = $this->sidebar->GenerarMenu();
    
      
      $contenidos['segmento']=  $this->uri->segment(4);
      
      $config['base_url'] = base_url().'administrador/opcion/index';
      $config['total_rows'] = $this->opcion_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $contenidos['paginacion'] = $this->pagination->create_links();
      $contenidos['opciones'] = $this->opcion_model->ObtenerOpcionesPaginadas('10',$contenidos['segmento']);
 
      
      $vista['active2h'] =true; 
      
            $this->load->view('Administrador/header.php',$vista);
      $vista['tab2'] = $this->load->view('Administrador/opcion/index.php',$contenidos,TRUE);
      $vista['active2'] = true;
     
      $this->load->view('Administrador/menu.php',$vista);
      $this->load->view('Administrador/footer.php');
           
           
           
           
           
  }
  function crear(){
 
   $this->load->view('Administrador/opcion/crear.php');
       
  } 
  
  function editar(){
      $idopcion = $this->uri->segment(4); 
      $contenido['opcion'] = $this->opcion_model->ObtenerOpcion($idopcion);
  $this->load->view('Administrador/opcion/editar.php',$contenido);
 
  }
  function crearPost(){
      
      $data = array(
          'frase_percepcion'=>  $this->input->post('frase_percepcion'),
          'valor'=>  $this->input->post('valor')
              ); 
      $config = array(
          array(
              'field' => 'frase_percepcion',
              'label' => 'Opcion',
              'rules' => 'trim|required|max_leght[100]'
              ), array(
              'field' => 'valor',
              'label' => 'Valor',
              'rules' => 'trim|integer|required|max_leght[8]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
          //redirect(base_url()."Entorno");
        }
        else
        {
           if( $this->opcion_model->NuevaOpcion($data)){
               $this->session->set_flashdata('crear', 'Registro creado exitosamente');
               echo json_encode(array('crear'=>'ok'));
               }else{
                   echo json_encode(array('crear'=>'error'));
                   }        
        }
  }
  
  
  function editarPost(){
      $data = array(
          'idpercepcion'=>$this->input->post('idpercepcion'),
          'frase_percepcion'=>  $this->input->post('frase_percepcion'),
          'valor'=>  $this->input->post('valor')
              ); 
      
      
      $config = array(
          array(
              'field' => 'frase_percepcion',
              'label' => 'Opcion',
              'rules' => 'trim|required|max_leght[100]'
              ), array(
              'field' => 'valor',
              'label' => 'Valor',
              'rules' => 'trim|integer|required|max_leght[8]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
        }
        else
        {if($this->opcion_model->ModificarOpcion($data)){
        $this->session->set_flashdata('modificar', 'Registro modificado correctamente');
        echo json_encode(array('editar' => 'ok')); 
        }else{   echo json_encode(array('editar' => 'error')); }   }
     }
  
  function eliminar(){
      $id=  $this->uri->segment(4);
      
       $contenido['opcion'] = $this->opcion_model->ObtenerOpcion($id); 
       $this->load->view('Administrador/opcion/eliminar.php',$contenido);
      
  }
  
  function eliminarPost(){
      $id = $this->input->post('idpercepcion');
      $asociado = $this->opcion_model->RegistrosAsociados($id);
      if($asociado){
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
            echo json_encode(array('eliminar' => 'ok')); 
      }
      else{
          if($this->opcion_model->EliminarOpcion($id)){
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
