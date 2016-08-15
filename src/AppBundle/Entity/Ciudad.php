<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="ciudad")
 */
class Ciudad
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Trayecto", mappedBy="origen")
     */
    protected $trayectosDondeSoyOrigen;

    /**
     * @ORM\OneToMany(targetEntity="Trayecto", mappedBy="destino")
     */
    protected $trayectosDondeSoyDestino;

    public function __construct() {
        $this->trayectosDondeSoyOrigen = new ArrayCollection();
        $this->trayectosDondeSoyDestino = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add trayectosDondeSoyOrigen
     *
     * @param \AppBundle\Entity\Trayecto $trayectosDondeSoyOrigen
     *
     * @return Ciudad
     */
    public function addTrayectosDondeSoyOrigen(\AppBundle\Entity\Trayecto $trayectosDondeSoyOrigen)
    {
        $this->trayectosDondeSoyOrigen[] = $trayectosDondeSoyOrigen;

        return $this;
    }

    /**
     * Remove trayectosDondeSoyOrigen
     *
     * @param \AppBundle\Entity\Trayecto $trayectosDondeSoyOrigen
     */
    public function removeTrayectosDondeSoyOrigen(\AppBundle\Entity\Trayecto $trayectosDondeSoyOrigen)
    {
        $this->trayectosDondeSoyOrigen->removeElement($trayectosDondeSoyOrigen);
    }

    /**
     * Get trayectosDondeSoyOrigen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrayectosDondeSoyOrigen()
    {
        return $this->trayectosDondeSoyOrigen;
    }

    /**
     * Add trayectosDondeSoyDestino
     *
     * @param \AppBundle\Entity\Trayecto $trayectosDondeSoyDestino
     *
     * @return Ciudad
     */
    public function addTrayectosDondeSoyDestino(\AppBundle\Entity\Trayecto $trayectosDondeSoyDestino)
    {
        $this->trayectosDondeSoyDestino[] = $trayectosDondeSoyDestino;

        return $this;
    }

    /**
     * Remove trayectosDondeSoyDestino
     *
     * @param \AppBundle\Entity\Trayecto $trayectosDondeSoyDestino
     */
    public function removeTrayectosDondeSoyDestino(\AppBundle\Entity\Trayecto $trayectosDondeSoyDestino)
    {
        $this->trayectosDondeSoyDestino->removeElement($trayectosDondeSoyDestino);
    }

    /**
     * Get trayectosDondeSoyDestino
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrayectosDondeSoyDestino()
    {
        return $this->trayectosDondeSoyDestino;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Ciudad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
