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
        $entityManager = $this->getDoctrine()->getManager();
        $repositorioTrayecto = $entityManager->getRepository("AppBundle:Trayecto");
        $trayectos = $repositorioTrayecto->findAll();

        // Si no se indica un filtro para la fecha, se muestran todos los trayectos
        if ($request->get("posted") != "" || $request->get('country') != "") {
            $parameters=array();
            $queryBuilder = $repositorioTrayecto->createQueryBuilder('trayecto');
            if ($request->get("country") != "") {
                $queryBuilder->where('trayecto.origen = :country')
                    ->orWhere('trayecto.destino = :country');
                $parameters['country'] = $request->get("country");
            }
            if($request->get("posted") != ""){
                if ($request->get("country") != "") {
                    $queryBuilder->andWhere('trayecto.createdAt > :posted');
                }
                else {
                    $queryBuilder->where('trayecto.createdAt > :posted');
                }
                $date=new \DateTime();
                $date->modify('-'.$request->get('posted').' day');
                $parameters['posted']=$date;
            }
            $trayectosFiltrados =$queryBuilder->setParameters($parameters)
                ->getQuery()->execute();
        } else {
            $trayectosFiltrados = $trayectos;
        }

        return $this->render('list/index.html.twig', array(
            'trayectos' => $trayectosFiltrados,
            'posted' => $request->get('posted'),
            'country' => $request->get('country')
        ));
    }
}
