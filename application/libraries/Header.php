<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Header{
   
    public function __construct() { 
     //   $this->arr_nav=$arr['menu'];
     
  //      $this->arr_pag=$arr['paginas'];
    }
    public function GenerarHeader(){
        $ret_head ='<!DOCTYPE html>
            <html lang="en" >
                <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Carabineros de Chile</title>
                     <link href="'.base_url().'application/views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                     <link href="'.base_url().'application/views/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
                     <link href="'.base_url().'application/views/css/jquery.lighter.css" rel="stylesheet" type="text/css" />
                     <script src="'.base_url().'application/views/js/jquery-1.11.0.js"></script>         
                     <script src="'.base_url().'application/views/bootstrap/js/bootstrap.min.js"></script>
                     <script src="'.base_url().'application/views/js/jquery.Rut.js"></script>
                     <script src="'.base_url().'application/views/holder/holder.js"></script>
                     <script src="'.base_url().'application/views/js/jquery.lighter.js" type="text/javascript"></script>
                     <link rel="shortcut icon" href="'.base_url().'application/views/img/icon_carabineros.ico" type="image/x-icon">

<style type="text/css">

.navbar-inner {
  background: #4d9307; /* Old browsers */

  background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2VhYjkyZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjNzk4MTAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
  background: -moz-linear-gradient(top,  #4d9307 0%, #007f00 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#4d9307), color-stop(100%,#007f00)); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top,  #4d9307 0%,#007f00 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top,  #4d9307 0%,#007f00 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(top,  #4d9307 0%,#007f00 100%); /* IE10+ */
  background: linear-gradient(to bottom,  #4d9307 0%,#007f00 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#4d9307", endColorstr="#007f00",GradientType=0 ); /* IE6-8 */
}

.navbar-inner, .navbar .btn-navbar {
    background: #4d9307; /* Old browsers */
   
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2VhYjkyZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjNzk4MTAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: -moz-linear-gradient(top,  #4d9307 0%, #007f00 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#4d9307), color-stop(100%,#007f00)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #4d9307 0%,#007f00 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #4d9307 0%,#007f00 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #4d9307 0%,#007f00 100%); /* IE10+ */
    background: linear-gradient(to bottom,  #4d9307 0%,#007f00 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#4d9307", endColorstr="#007f00",GradientType=0 ); /* IE6-8 */
    }
         
.navbar .divider-vertical {
    background-color: #007f00;
    border-right: 1px solid #4d9307;
    }
    .navbar .nav .active > a, .navbar .nav .active > a:hover {
    background-color: #007f00;
    }
    .navbar .nav > li > a {
    color: #0df714;
    text-shadow:0 0px 0;
    }
    .navbar-fixed-top .brand {
    color: #634c08;color: #f4dc87;
    text-shadow:0 0px 0;
    }
.navbar .nav > li > a:hover {color:white;}

.navbar .nav .active > a, .navbar .nav .active > a:hover {color:white; }
.nav-tabs > li {
    float:none;
    display:inline-block;
    *display:inline; /* ie7 fix */
     zoom:1; /* hasLayout ie7 trigger */
}
input[type="text"]{
height:auto;
}
.nav-tabs {
  text-align:center;
}

body > .navbar .brand {
  padding-right: 0;
  padding-left: 0; 
  margin-left:30px;
 text-shadow: 0 0px 0;
  color: #007f00;
 
  -webkit-transition: all .2s linear;
     -moz-transition: all .2s linear;
          transition: all .2s linear;
}
body > .navbar .brand:hover {
  text-decoration: none;
  color: #fff;
  text-shadow: 0 0px 0 rgba(255,255,255,.1), 0 0 30px rgba(255,255,255,.4);
}


           </style>
           <script>$(document).ready(function() {
  $("a").tooltip();
  $("button").tooltip();
});</script>
    </head>
    <body>
';
        
        
        return $ret_head;
    }

}

?>
