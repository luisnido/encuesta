<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zona extends CI_Controller {
  function __construct() {
      parent::__construct();
        $this->load->library('menu',array('active'=>'configuracion'));
    
      $this->data['head']    = $this->header->GenerarHeader();
      $this->data['foot']    = $this->footer->GenerarFooter();
      $this->data['menu']    = $this->menu->GenerarMenu();
      $this->data['usuario'] = $this->session->userdata('username');
      $this->load->model('zona_model');
      $this->load->model('usuario_model');
   
      
  }

  function index()
  {
      if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

      //carga menu navegacion
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Sectores','Zonas'),'active'=>'Zonas'));
      $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
      //      
      
      
      //carga menu sidebar
      $this->load->library('sidebar',array('menu'=>array('Zonas','Prefecturas','Comisarias'),'paginas'=>array('Zonas'=>  base_url()."administrador/zona/",'Prefecturas'=>  base_url()."administrador/prefectura/",'Comisarias'=>  base_url()."administrador/comisaria/"),'active'=>'Zonas'));
      $this->data['sidebar'] = $this->sidebar->GenerarMenu();
      //    
      
      $this->data['segmento']=  $this->uri->segment(3);
      
      $this->data['zonas'] = '';//$this->zona_model->ObtenerZonasPaginadas('10',$contenidos['segmento']);
      
      
     
      
      
      
      $config['base_url'] = base_url().'administrador/zona/index';
      $config['total_rows'] = $this->zona_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $this->data['paginacion'] = $this->pagination->create_links();
             
      
   
      
      
    
      
      $vista['tab3'] = $this->load->view('Administrador/zona/index.php',$this->data,TRUE);
     $vista['active3']=true;
        $this->load->view('Administrador/tabfoot.php',$vista);  
           
           
           
           
  }
  function crear(){
 
      $contenido['usuarios'] = $this->usuario_model->ObtenerUsuariosPorRoles(3);
      
      
     $this->load->view('Administrador/zona/crear.php',$contenido);
       
  } 
  
  function editar(){
      $idzona = $this->uri->segment(4); 
      $contenido['zona'] = $this->zona_model->ObtenerZona($idzona,false);
    $contenido['usuarios'] = $this->usuario_model->ObtenerUsuariosPorRoles(3);
      $this->load->view('Administrador/zona/editar.php',$contenido);
  }
  function crearPost(){
      
      $data = array(
          'zona'=>  $this->input->post('zona'),
              'idjefezona'=>  $this->input->post('idjefezona')
              ); 
      $config = array(
          array( 
              'field' => 'zona',
              'label' => 'Nombre Zona',
              'rules' => 'trim|required|max_length[100]'
              ),
          array('field'=>'idjefezona',
              'label'=>'Jefe Zona',
              'rules'=>'integer')
                   );     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
        }
        else{
            if($this->zona_model->NuevaZona($data)){
                $this->session->set_flashdata('crear', 'Registro creado exitosamente');
                echo json_encode(array('crear'=>'ok'));   
                }else{
                    echo json_encode(array('crear'=>'error')); 
                }
        }         
  }
  
  
  function editarPost(){
      $data = array(
          'idzona'=>$this->input->post('idzona'),
     
          'zona'=>  $this->input->post('zona'),
              'idjefezona'=>  $this->input->post('idjefezona')
              ); 
      $config = array(
          array( 
              'field' => 'zona',
              'label' => 'Nombre Zona',
              'rules' => 'trim|required|max_length[100]'
              ),
          array('field'=>'idjefezona',
              'label'=>'Jefe Zona',
              'rules'=>'integer')
                   );       
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {echo json_encode(array('error' => validation_errors()));
        }
        else{
            if($this->zona_model->ModificarZona($data)){
                 $this->session->set_flashdata('modificar', 'Registro modificado correctamente');
         echo json_encode(array('editar'=>'ok'));    
            }else{
                  echo json_encode(array('editar'=>'error'));    
            }
       
        }   
     }
  
  function eliminar(){
      $id=  $this->uri->segment(4);
      
       $contenido['zona'] = $this->zona_model->ObtenerZona($id,true); 
       $this->load->view('Administrador/zona/eliminar.php',$contenido);
      
  }
  
  function eliminarPost(){
      $id = $this->input->post('idzona');
      $asociado = $this->zona_model->RegistrosAsociados($id);
      if($asociado){
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
             echo json_encode(array('eliminar'=>'ok'));  
      }
      else{
     if( $this->zona_model->EliminarZona($id))
         {
     
      $this->session->set_flashdata('eliminar', 'Eliminado exitosamente');
     echo json_encode(array('eliminar'=>'ok'));  
         }
         else{
               echo json_encode(array('eliminar'=>'error'));  
         }
     }
  }
  
}
?>
