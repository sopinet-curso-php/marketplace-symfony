<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ciudad;
use AppBundle\Entity\Trayecto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
        // Creamos entidad Trayecto
        $nuevoTrayecto = new Trayecto();

        // Asignamos los datos recogidos por Request del Form
        $entityManager = $this->getDoctrine()->getManager();
        $repositorioCiudad = $entityManager->getRepository("AppBundle:Ciudad");
        $origen = $repositorioCiudad->findOneByNombre($request->get('origen'));
        if ($origen == null) {
            $origen = new Ciudad();
            $origen->setNombre($request->get('origen'));
            $entityManager->persist($origen);
            $entityManager->flush();
        }

        $destino = $repositorioCiudad->findOneByNombre($request->get('destino'));
        if ($destino == null) {
            $destino = new Ciudad();
            $destino->setNombre($request->get('destino'));
            $entityManager->persist($destino);
            $entityManager->flush();
        }

        $nuevoTrayecto->setOrigen($origen);
        $nuevoTrayecto->setDestino($destino);
        $nuevoTrayecto->setCalle($request->get('calle'));
        $fechaDateTime = new \DateTime($request->get('fechaDeViaje'));
        $nuevoTrayecto->setFechaDeViaje($fechaDateTime);
        $horaDateTime = new \DateTime($request->get('horaDeViaje'));
        $nuevoTrayecto->setHoraDeViaje($horaDateTime);
        $nuevoTrayecto->setPrecio($request->get('precio'));
        $nuevoTrayecto->setDescripcion($request->get('descripcion'));
        $nuevoTrayecto->setPlazas($request->get('plazas'));

        // Asignamos el Conductor, que será el usuario logueado
        $usuarioLogueado = $this->getUser();
        $nuevoTrayecto->setConductor($usuarioLogueado);

        // Guardamos el nuevo Trayecto
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($nuevoTrayecto);
        $entityManager->flush();

        /**
         * TODO:
         *  Dejamos pendiente la redirección a la pantalla list, que la haremos cuando completemos dicha pantalla.
         *  Por ahora redireccionamos a public_home
         */
        $this->addFlash(
            'notice',
            'Ha creado su Trayecto correctamente'
        );
        return $this->redirect($this->generateUrl('public_home'));
    }

    /**
     * @Route("/reservarPlaza/{trayecto}", name="private_reservarPlaza")
     * @ParamConverter("trayecto", class="AppBundle:Trayecto")
     */
    public function reservarPlazaAction(Trayecto $trayecto) {
        if ($trayecto->getPlazasDisponibles() <= 0) {
            die("No hay plazas disponibles");
        }

        $pasajero = $this->getUser();
        if ($trayecto->hasPasajero($pasajero)) {
            $this->addFlash(
                'notice',
                'Ya ha reservado para este viaje'
            );
            return $this->redirect($this->generateUrl('public_list'));
        }
        $trayecto->addPasajero($pasajero);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($trayecto);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('public_list'));
    }
}