
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comisaria extends CI_Controller {
  function __construct() {
      parent::__construct();
        $this->load->library('menu',array('active'=>'configuracion'));
         
      $this->data['head']    = $this->header->GenerarHeader();
      $this->data['foot']    = $this->footer->GenerarFooter();
      $this->data['menu']    = $this->menu->GenerarMenu();
      $this->data['usuario'] = $this->session->userdata('username');
      $this->load->model('prefectura_model');
      $this->load->model('usuario_model');
      $this->load->model('comisaria_model');
      
  }

  function index()
  { 
      if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
      //carga menu navegacion
      $this->load->library('navegacion',array('menu'=>array('Configuracion','Sectores','Comisarías'),'active'=>'Comisarías'));
      $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
            
      //carga menu sidebar
      $this->load->library('sidebar',array('menu'=>array('Zonas','Prefecturas','Comisarias'),'paginas'=>array('Zonas'=>  base_url()."administrador/zona/",'Prefecturas'=>  base_url()."administrador/prefectura/",'Comisarías'=>  base_url()."administrador/comisaria/"),'active'=>'Comisarías'));
      $this->data['sidebar'] = $this->sidebar->GenerarMenu();
           
      $this->data['segmento']=  $this->uri->segment(4);      
      $this->data['prefecturas'] = $this->prefectura_model->ObtenerPrefecturasPaginadas('10',$this->data['segmento']);
            
      $config['base_url'] = base_url().'administrador/comisaria/index';
      $config['total_rows'] = $this->comisaria_model->TotalRows();
      $config['per_page'] = '10';
      $this->pagination->initialize($config);
      $this->data['paginacion'] = $this->pagination->create_links();
            
         
      $vista['tab3'] = $this->load->view('Administrador/comisaria/index.php',$this->data,TRUE);
      $vista['active3']=true;
         $this->load->view('Administrador/tabfoot.php',$vista);  
                 
  }
  function crear()
  { 
      $contenido['usuarios'] = $this->usuario_model->ObtenerUsuariosPorRoles(4);
      $contenido['prefecturas'] =  $this->prefecturas_model->ObtenerZonas();
      $this->load->view('Administrador/comisaria/crear.php',$contenido);       
  } 
  
  function editar()
  {
      $id = $this->uri->segment(4); 
      $contenido['comisaria'] = $this->comisaria_model->ObtenerComisaria($id,false);
      $contenido['usuarios'] = $this->usuario_model->ObtenerUsuariosPorRoles(4);    
      $contenido['prefecturas'] =  $this->prefectura_model->ObtenerPrefecturas();      
      $this->load->view('Administrador/comisaria/editar.php',$contenido);
  }
  function crearPost()
  {      
      $data = array(
          'prefectura'=>  $this->input->post('prefectura'),
          'idprefecto'=>  $this->input->post('idprefecto'),
          'idzona'=>  $this->input->post('idzona')
              );
      $config = array(
          array( 
              'field' => 'prefectura',
              'label' => 'Nombre prefectura',
              'rules' => 'trim|required|max_length[100]'
              ),
          array(
              'field'=>'idprefecto',
              'label'=>'Prefecto',
              'rules'=>'integer|max_length[4]'
              ),
          array(
              'field'=>'idzona',
              'label'=>'Zona',
              'rules'=>'integer|max_length[4]'
              ));     
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        { echo json_encode(array('error' => validation_errors()));
        }
        else{
            if($this->prefectura_model->NuevaPrefectura($data)){
                $this->session->set_flashdata('crear', 'Registro creado exitosamente');
                echo json_encode(array('crear'=>'ok'));   
            }else{
                    echo json_encode(array('crear'=>'error')); 
                 }
        }         
  }
  
  
  function editarPost(){
     $data = array(
          'prefectura'=>  $this->input->post('prefectura'),
              'idprefecto'=>  $this->input->post('idprefecto'),
          'idzona'=>  $this->input->post('idzona')
              ); 
      $config = array(
          array( 
              'field' => 'prefectura',
              'label' => 'Nombre prefectura',
              'rules' => 'trim|required|max_length[100]'
              ),
          array('field'=>'idprefecto',
              'label'=>'Prefecto',
              'rules'=>'integer|max_length[4]'),
          array('field'=>'idzona',
              'label'=>'Zona',
              'rules'=>'integer|max_length[4]')
          
                   );          
      
      $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {echo json_encode(array('error' => validation_errors()));
        }
        else{
            if($this->prefectura_model->ModificarPrefectura($data)){
                 $this->session->set_flashdata('modificar', 'Registro modificado correctamente');
         echo json_encode(array('editar'=>'ok'));    
            }else{
                  echo json_encode(array('editar'=>'error'));    
            }
       
        }   
     }
  
  function eliminar()
     {
       $id = $this->uri->segment(4);      
       $contenido['prefectura'] = $this->prefectura_model->ObtenerPrefectura($id,true); 
       $this->load->view('Administrador/prefectura/eliminar.php',$contenido);        
     }
  
  function eliminarPost(){
      $id = $this->input->post('idprefectura');
      $asociado = $this->prefectura_model->RegistrosAsociados($id);
      if($asociado)
      {
          $this->session->set_flashdata('eliminar', 'No se puede eliminar por que posee registros asociados');
          echo json_encode(array('eliminar'=>'ok'));  
      }
      else{
     if($this->prefectura_model->EliminarPrefectura($id))
         {     
            $this->session->set_flashdata('eliminar', 'Eliminado exitosamente');
            echo json_encode(array('eliminar'=>'ok'));  
         }
         else
         {
            echo json_encode(array('eliminar'=>'error'));  
         }
     }
  }
  
}
?>
