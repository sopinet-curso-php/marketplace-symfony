<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends Controller
{
    /**
     * @Route("/", name="public_home")
     */
    public function homeAction(Request $request)
    {
        return $this->render('home/index.html.twig', array(
        ));
    }
    
    /**
     * @Route("/list", name="public_list") 
     */
    public function listAction(Request $request)
    {
        /**
         * Meteríamos el código de controller/list.php en esta acción de este controlador
         * Pasaríamos el fichero list.html y los includes que tiene a este proyecto
         * Haríamos un render a list.html pasando como parámetro el listado de trayectos a mostrar
         * 
        **/
        //die("Listado: Pendiente de hacer");
        return $this->render('building/index.html.twig');
    }
}
