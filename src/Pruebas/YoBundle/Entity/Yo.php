<?php

namespace Pruebas\YoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author alexis Calatayud Doe <Alexiscalatayud@gmail.com>
 */

/**
 * @ORM\Entity
 */
class Yo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pruebas\YoBundle\Entity\Empresa")
     */
    protected $empresa;

    /**
     * @ORM\Column(type="string", length=100)
     */
    
    protected $nombre;

    public function getId() {
        return $this->id;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa(\Pruebas\YoBundle\Entity\Empresa $empresa) {
        $this->empresa = $empresa;
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
