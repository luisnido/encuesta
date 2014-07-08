<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Menu{

    private $inicio='';
    private $configuracion='';
    private $encuesta='';
    private $usuarios='';
    private $previa='';
    private $cuenta='';
    private  $active='';
   private $nombreusu='';
   private  $idusu='';


    public function __construct($arr) {
         $CI =& get_instance();
   $CI->load->library('session');
        $this->active=$arr['active'];
        $this->nombreusu=$CI->session->userdata('username');
        $this->idusu=$CI->session->userdata('user_id');
  //      $this->arr_pag=$arr['paginas'];
    }
    public function GenerarMenu()
    {
        
        
                         switch($this->active)
                         {
                             
                         case 'inicio': $this->inicio = 'class = "active"';
                             break;
                         case 'configuracion': $this->configuracion = 'class = "active"';
                             break;
                         case 'encuesta': $this->encuesta = 'class = "active"';
                             break;
                         case 'usuarios': $this->usuarios = 'class = "active"';
                             break;
                         case 'previa': $this->previa = 'class = "active"';
                             break;
                         case 'cuenta': $this->cuenta = 'class = "active"';
                             break;
                             
                         }
        
        
         $blabla='<div class="navbar">     
                          <div class="navbar-inner">  
                          <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                      <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                <ul class="nav">
                <li '.$this->inicio.'><a id="inicio" href="'.base_url().'administrador">Inicio</a></li>
                <li '.$this->configuracion.'><a id="configuracion"  href="'.base_url().'administrador/entorno">Configuracion</a></li>
                <li '.$this->encuesta.'><a id="encuesta"   href="'.base_url().'administrador/encuestas">Encuestas realizadas</a></li>
                <li '.$this->usuarios.'><a id="usuarios"  href="'.base_url().'administrador/usuarios">Cuentas de usuario</a></li>
                <li '.$this->previa.'><a id="previa"  href="'.base_url().'administrador/vista">Vista previa</a></li>
                 </ul>
                      <!-- .nav, .navbar-search, .navbar-form, etc -->
                      <ul class="nav pull-right">
                <li '.$this->cuenta.' class="dropdown">
                  <a class="dropdown-toggle"
                     data-toggle="dropdown"
                     href="#">
                    Mi cuenta
                      <b class="caret"></b>
                    </a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                      <li><a tabindex="-1" href="#">Perfil</a></li>
                      <li><a tabindex="-1" href="#">Cambiar contraseña</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="'.base_url().'auth/logout">Cerrar sesión</a></li>
                  </ul>
                </li>
                    
                  </ul>    
                        </div>
                </div></div>';
        
        
        return $blabla;
    }

     public function GenerarMenuEncuesta()
    {
        
        
                         switch($this->active)
                         {
                             
                         case 'Inicio': $this->inicio = 'class = "active"';
                             break;
                         case 'Encuesta': $this->configuracion = 'class = "active"';
                             break;
                        
                             
                         }
        
        
         $blabla='<div class="navbar">     
                          <div class="navbar-inner">  
                          <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                      <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                <ul class="nav">
                <li '.$this->inicio.'><a id="inicio" href="'.base_url().'encuestador">Inicio</a></li>
                <li '.$this->encuesta.'><a id="encuesta"  href="'.base_url().'encuestador/encuesta">Encuesta</a></li>
                  </ul>
                      <!-- .nav, .navbar-search, .navbar-form, etc -->
                      <ul class="nav pull-right">
                <li '.$this->cuenta.' class="dropdown">
                  <a class="dropdown-toggle"
                     data-toggle="dropdown"
                     href="#">
                    Mi cuenta
                      <b class="caret"></b>
                    </a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                      <li><a tabindex="-1" href="#">Perfil</a></li>
                      <li><a tabindex="-1" href="#">Cambiar contraseña</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="'.base_url().'auth/logout">Cerrar sesión</a></li>
                  </ul>
                </li>
                    
                  </ul>    
                        </div>
                </div></div>';
        
        
        return $blabla;
    }

}

?>
