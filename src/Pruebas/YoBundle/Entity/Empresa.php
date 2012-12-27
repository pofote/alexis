<?php

namespace Pruebas\YoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping;


/**
 * @ORM\Entity
 */
class Empresa {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="Cuenta")
     * @ORM\JoinTable(name="empresa_cuenta",
     *      joinColumns={@ORM\JoinColumn(name="empresa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="cuenta_id", referencedColumnName="id")}
     *      )
     */
    protected $cuenta;

    public function __construct() {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __toString() {
        return $this->getNombre();
    }

}

?>
