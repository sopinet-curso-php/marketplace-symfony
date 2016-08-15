<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\Table(name="trayecto")
 */
class Trayecto {
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $origen;
    /**
     * @ORM\Column(type="string")
     */
    protected $destino;
    /**
     * @ORM\Column(type="string")
     */
    protected $calle;
    /**
     * @ORM\Column(type="date")
     */
    protected $fechaDeViaje;
    /**
     * @ORM\Column(type="time")
     */
    protected $horaDeViaje;
    /**
     * @ORM\Column(type="float")
     */
    protected $precio;
    /**
     * @ORM\Column(type="text")
     */
    protected $descripcion;
    /**
     * @ORM\Column(type="integer")
     */
    protected $plazas;
    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     */
    protected $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="trayectos")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    protected $conductor;

    /**
     * Inicializa nuestro objeto Trayecto para cuando se vaya a crear uno nuevo, con la fecha y hora actuales
     *
     * Trayecto constructor.
     */
    public function __construct()
    {
        $this->fechaDeViaje = new \DateTime();
        $this->horaDeViaje = new \DateTime();
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
     * Set origen
     *
     * @param string $origen
     * @return Trayecto
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string 
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set destino
     *
     * @param string $destino
     * @return Trayecto
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string 
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set calle
     *
     * @param string $calle
     * @return Trayecto
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set fechaDeViaje
     *
     * @param \DateTime $fechaDeViaje
     * @return Trayecto
     */
    public function setFechaDeViaje($fechaDeViaje)
    {
        $this->fechaDeViaje = $fechaDeViaje;

        return $this;
    }

    /**
     * Get fechaDeViaje
     *
     * @return \DateTime 
     */
    public function getFechaDeViaje()
    {
        return $this->fechaDeViaje;
    }

    /**
     * Set horaDeViaje
     *
     * @param \DateTime $horaDeViaje
     * @return Trayecto
     */
    public function setHoraDeViaje($horaDeViaje)
    {
        $this->horaDeViaje = $horaDeViaje;

        return $this;
    }

    /**
     * Get horaDeViaje
     *
     * @return \DateTime 
     */
    public function getHoraDeViaje()
    {
        return $this->horaDeViaje;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Trayecto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Trayecto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set plazas
     *
     * @param integer $plazas
     * @return Trayecto
     */
    public function setPlazas($plazas)
    {
        $this->plazas = $plazas;

        return $this;
    }

    /**
     * Get plazas
     *
     * @return integer 
     */
    public function getPlazas()
    {
        return $this->plazas;
    }

    /**
     * Set conductor
     *
     * @param \AppBundle\Entity\Persona $conductor
     * @return Trayecto
     */
    public function setConductor(\AppBundle\Entity\Persona $conductor = null)
    {
        $this->conductor = $conductor;

        return $this;
    }

    /**
     * Get conductor
     *
     * @return \AppBundle\Entity\Persona 
     */
    public function getConductor()
    {
        return $this->conductor;
    }

    public function __toString()
    {
        return "Viaje de " . $this->getOrigen() . " a " . $this->getDestino();
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Trayecto
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
