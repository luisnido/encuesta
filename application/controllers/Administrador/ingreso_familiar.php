<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingreso_familiar extends CI_Controller {
  function __construct() {
      parent::__construct();   
      $this->load->model('ingreso_familiar_model');    
  }

  function index()
  {
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Datos Encuesta','Situacion Laboral'),'active'=>'Situacion Laboral'));
      $contenidos['navegacion'] = $this->navegacion->GenerarNavegacion();
      
      $this->load->library('sidebar',array('menu'=>array('Opciones','Situacion Laboral','Rango Edad','Nivel Estudio','Ingreso Familiar'),'paginas'=>array('Opciones'=>  base_url()."administrador/opcion/",'Situacion Laboral'=>  base_url()."administrador/situacion/",'Rango Edad'=>  base_url()."administrador/rango_edad/",'Nivel Estudio'=>  base_url()."administrador/nivel_estudio/",'Ingreso Familiar'=>  base_url()."administrador/ingreso_familiar/"),'active'=>'Ingreso Familiar'));
      $contenidos['sidebar'] = $this->sidebar->GenerarMenu();
    
      
      $contenidos['segmento']=  $this->uri->segment(4);
      
      $config['base_url'] = base_url().'administrador/situacion/index';
      $config['total_rows'] = $this->ingreso_familiar_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $contenidos['paginacion'] = $this->pagination->create_links();
      $contenidos['ingresos'] = $this->ingreso_familiar_model->ObtenerIngresosPaginados('10',$contenidos['segmento']);
 
      
      
      $vista['active2h'] =true; 
      
            $this->load->view('Administrador/header.php',$vista);
      $vista['tab2'] = $this->load->view('Administrador/ingreso_familiar/index.php',$contenidos,TRUE);
      $vista['active2'] = true;
     
      $this->load->view('Administrador/menu.php',$vista);
      $this->load->view('Administrador/footer.php');
           
           
           
           
           
  }
  function crear(){
      
   $this->load->view('Administrador/ingreso_familiar/crear.php');
       
  } 
  
  function editar(){
      $idingreso = $this->uri->segment(4); 
      $contenido['ingreso'] = $this->ingreso_familiar_model->ObtenerIngreso($idingreso);
      $this->load->view('Administrador/ingreso_familiar/editar.php',$contenido);
 
  }
  function crearPost(){
      
      $data = array(
          'ingresomin'=>  $this->input->post('ingresomin'),
           'ingresomax'=>  $this->input->post('ingresomax')
              ); 
      $config = array(
          array(
              'field' => 'ingresomin',
              'label' => 'Ingreso Mínimo',
              'rules' => 'trim|integer|required|max_length[7]'
              ), array(
              'field' => 'ingresomax',
              'label' => 'Ingreso Máximo',
              'rules' => 'trim|integer|required|max_length[7]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
          //redirect(base_url()."Entorno");
        }
        else
        {
           if( $this->ingreso_familiar_model->NuevoIngreso($data)){
               $this->session->set_flashdata('crear', 'Registro creado exitosamente');
               echo json_encode(array('crear'=>'ok'));
               }else{
                   echo json_encode(array('crear'=>'error'));
                   }        
        }
  }
  
  
  function editarPost(){
      $data = array(
          'idingresofamiliar'=>$this->input->post('idingresofamiliar'),
          'ingresomin'=>  $this->input->post('ingresomin'),
                'ingresomax'=>  $this->input->post('ingresomax')
              ); 
      
      
      $config = array(
          array(
              'field' => 'ingresomin',
              'label' => 'Ingreso Mínimo',
              'rules' => 'trim|integer|required|max_length[7]'
              ), array(
              'field' => 'ingresomax',
              'label' => 'Ingreso Máximo',
              'rules' => 'trim|integer|required|max_length[7]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
        }
        else
        {if($this->ingreso_familiar_model->ModificarIngreso($data)){
        $this->session->set_flashdata('modificar', 'Registro modificado correctamente');
        echo json_encode(array('editar' => 'ok')); 
        }else{   echo json_encode(array('editar' => 'error')); }   }
     }
  
  function eliminar(){
      $id=  $this->uri->segment(4);
      
       $contenido['ingreso'] = $this->ingreso_familiar_model->ObtenerIngreso($id); 
       $this->load->view('Administrador/ingreso_familiar/eliminar.php',$contenido);
      
  }
  
  function eliminarPost(){
      $id = $this->input->post('idingresofamiliar');
      $asociado = $this->ingreso_familiar_model->RegistrosAsociados($id);
      if($asociado){
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
            echo json_encode(array('eliminar' => 'ok')); 
      }
      else{
          if($this->ingreso_familiar_model->EliminarIngreso($id)){
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
