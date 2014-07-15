<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encuesta extends CI_Controller {
      function __construct() {
          parent::__construct();
           $this->load->library('menu',array('active'=>'encuesta'));
           $this->data['head']    = $this->header->GenerarHeader();
           $this->data['foot']    = $this->footer->GenerarFooter();
           $this->data['menu']    = $this->menu->GenerarMenuEncuesta();
           $this->data['usuario'] = $this->session->userdata('username');
         
             $this->load->model('encuesta_model');
             $this->load->model('entorno_model');
         
          
      }

      function index()
      {

           //carga menu navegacion
          $this->load->library('navegacion',array('menu'=>array('Encuesta','Nueva Encuesta'),'active'=>'Nueva Encuesta'));
          $this->data['navegacion'] = $this->navegacion->GenerarNavegacion();
          $this->data['parte1']     = $this->encuesta_model->ObtenerPreguntasParte1();  
          $this->data['parte2']     = $this->encuesta_model->ObtenerPreguntasParte2();  
          $this->data['entornos']   = $this->entorno_model->ObtenerEntornos();
          $this->data['rangos']     = $this->encuesta_model->ObtenerRangos();
          $this->load->view('encuestador/encuesta.php',$this->data);  
      }

}


