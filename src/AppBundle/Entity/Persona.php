<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Persona extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $avatar;

    /**
     * @ORM\OneToMany(targetEntity="Trayecto", mappedBy="conductor")
     */
    protected $trayectos;

    /**
     * @ORM\ManyToMany(targetEntity="Trayecto", mappedBy="pasajeros")
     */
    protected $trayectosPasajero;

    public function __construct()
    {
        // Llamamos al constructor "padre" de FOSUser, porque Persona extiende de dicha clase.
        parent::__construct();
        // Declaramos un array con 3 valores de avatares
        $avatars = array(
            "https://addons.cdn.mozilla.net/user-media/userpics/0/0/45.png?modified=1447324257",
            "http://megaforo.com/images/user4.png",
            "http://gh.nsrrc.org.tw/Content/img/male05.png"
        );
        // Elegimos un número aleatorio entre 0 y el número de elementos del array avatars - 1:
        $indexSel = rand(0, count($avatars) - 1);
        // Asignamos un avatar, según el número al azar elegido con la función rand
        $this->avatar = $avatars[$indexSel];

        $this->trayectosPasajero = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Persona
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add trayectos
     *
     * @param \AppBundle\Entity\Trayecto $trayectos
     * @return Persona
     */
    public function addTrayecto(\AppBundle\Entity\Trayecto $trayectos)
    {
        $this->trayectos[] = $trayectos;

        return $this;
    }

    /**
     * Remove trayectos
     *
     * @param \AppBundle\Entity\Trayecto $trayectos
     */
    public function removeTrayecto(\AppBundle\Entity\Trayecto $trayectos)
    {
        $this->trayectos->removeElement($trayectos);
    }

    /**
     * Get trayectos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrayectos()
    {
        return $this->trayectos;
    }

    /**
     * Add trayectosPasajero
     *
     * @param \AppBundle\Entity\Trayecto $trayectosPasajero
     *
     * @return Persona
     */
    public function addTrayectosPasajero(\AppBundle\Entity\Trayecto $trayectosPasajero)
    {
        $this->trayectosPasajero[] = $trayectosPasajero;

        return $this;
    }

    /**
     * Remove trayectosPasajero
     *
     * @param \AppBundle\Entity\Trayecto $trayectosPasajero
     */
    public function removeTrayectosPasajero(\AppBundle\Entity\Trayecto $trayectosPasajero)
    {
        $this->trayectosPasajero->removeElement($trayectosPasajero);
    }

    /**
     * Get trayectosPasajero
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrayectosPasajero()
    {
        return $this->trayectosPasajero;
    }
}
