<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encuesta extends CI_Controller {
      function __construct() {
          parent::__construct();
           $this->load->library('menu',array('active'=>'encuesta'));
           $this->data['head']    = $this->header->GenerarHeader();
            $this->data['foot']    = $this->footer->GenerarFooter();
            $this->data['menu']    = $this->menu->GenerarMenuEncuesta();
            $this->data['usuario'] = $this->session->userdata('username');
         
             
         
          
      }

      function index()
      {

           //carga menu navegacion
          $this->load->library('navegacion',array('menu'=>array('Encuesta','Nueva Encuesta'),'active'=>'Nueva Encuesta'));
          $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
                
          
            $this->load->view('encuestador/encuesta.php',$this->data);  
      }

}


