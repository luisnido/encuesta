<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rango_edad extends CI_Controller {
  function __construct() {
      parent::__construct();   
      
      $this->load->model('rango_edad_model');  
      
  }

  function index()
  {
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Datos Encuesta','Rango Edad'),'active'=>'Rango Edad'));
      $contenidos['navegacion'] = $this->navegacion->GenerarNavegacion();
      
      $this->load->library('sidebar',array('menu'=>array('Opciones','Situacion Laboral','Rango Edad','Nivel Estudio','Ingreso Familiar'),'paginas'=>array('Opciones'=>  base_url()."administrador/opcion/",'Situacion Laboral'=>  base_url()."administrador/situacion/",'Rango Edad'=>  base_url()."administrador/rango_edad/",'Nivel Estudio'=>  base_url()."administrador/nivel_estudio/",'Ingreso Familiar'=>  base_url()."administrador/ingreso_familiar/"),'active'=>'Rango Edad'));
      $contenidos['sidebar'] = $this->sidebar->GenerarMenu();
    
      
      $contenidos['segmento']=  $this->uri->segment(4);
      
      $config['base_url'] = base_url().'administrador/rango_edad/index';
      $config['total_rows'] = $this->rango_edad_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $contenidos['paginacion'] = $this->pagination->create_links();
      $contenidos['rangos'] = $this->rango_edad_model->ObtenerRangosPaginados('10',$contenidos['segmento']);
 
      
      
      $vista['active2h'] =true; 
      
            $this->load->view('Administrador/header.php',$vista);
      
      $vista['tab2'] = $this->load->view('Administrador/rango_edad/index.php',$contenidos,TRUE);
      $vista['active2'] = true;
     
      $this->load->view('Administrador/menu.php',$vista);
      $this->load->view('Administrador/footer.php');
           
           
           
           
           
  }
  function crear(){
 
   $this->load->view('Administrador/rango_edad/crear.php');
       
  } 
  
  function editar(){
      $idrango = $this->uri->segment(4); 
      $contenido['rango'] = $this->rango_edad_model->ObtenerRango($idrango);
  $this->load->view('Administrador/rango_edad/editar.php',$contenido);
 
  }
  function crearPost(){
      
      $data = array(         
          'min'=>  $this->input->post('min'),
          'max'=>  $this->input->post('max')
              ); 
      $config = array(
          array(
              'field' => 'min',
              'label' => 'Minimo',
              'rules' => 'trim|integer|required|max_leght[2]'
              ), array(
              'field' => 'max',
              'label' => 'Maximo',
              'rules' => 'trim|required|max_leght[2]|integer'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { 
            echo json_encode(array('error' => validation_errors()));          
        }
        else
        {
           if( $this->rango_edad_model->NuevoRango($data)){
               $this->session->set_flashdata('crear', 'Registro creado exitosamente');
               echo json_encode(array('crear'=>'ok'));
               }else{
                   echo json_encode(array('crear'=>'error'));
                   }        
        }
  }
  
  
  function editarPost(){
     $data = array(
         'idrango'=> $this->input->post('idrango'),
          'min'=>  $this->input->post('min'),
          'max'=>  $this->input->post('max')
              ); 
      $config = array(
          array(
              'field' => 'min',
              'label' => 'Minimo',
              'rules' => 'trim|integer|required|max_leght[2]'
              ), array(
              'field' => 'max',
              'label' => 'Maximo',
              'rules' => 'trim|integer|required|max_leght[2]'
              ));       
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
        }
        else
        {if($this->rango_edad_model->ModificarRango($data)){
        $this->session->set_flashdata('modificar', 'Registro modificado correctamente');
        echo json_encode(array('editar' => 'ok')); 
        }else{   echo json_encode(array('editar' => 'error')); }   }
     }
  
  function eliminar(){
      $id=  $this->uri->segment(4);
      
       $contenido['rango'] = $this->rango_edad_model->ObtenerRango($id); 
       $this->load->view('Administrador/rango_edad/eliminar.php',$contenido);
      
  }
  
  function eliminarPost(){
      $id = $this->input->post('idrango');
      $asociado = $this->rango_edad_model->RegistrosAsociados($id);
      if($asociado){
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
            echo json_encode(array('eliminar' => 'ok')); 
      }
      else{
          if($this->rango_edad_model->EliminarRango($id)){
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
