<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PrivateController extends Controller
{
    /**
     * @Route("/nuevoTrayecto", name="private_nuevoTrayecto")
     */
    public function nuevoTrayectoAction(Request $request)
    {
        return $this->render('nuevoTrayecto/index.html.twig');
    }
    
    /**
     * @Route("/publicarTrayecto", name="private_publicarTrayecto")
     */ 
    public function publicarTrayectoAction(Request $request)
    {
        /**
         * Guarda los datos enviados por el formulario nuevoTrayecto
         * 
         * 1. Habría que guardar los datos recibiendos en $_GET en un nuevoTrayecto
         * 2. Podríamos poner una redirección a HomeAction (pantalla principal) o a ListAction (a la pantalla de listado de trayectos)
         * 
         **/ 
        die("Pendiente de hacer");
        //return $this->render('building/index.html.twig');
    }
}