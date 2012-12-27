<?php

namespace Pruebas\YoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Direcciones
 *
 * @author Alexis Calatayud <alexiscalatayud@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table
 */

class Direcciones {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $iso;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $country;
    
       /**
     * @ORM\Column(type="datetime", length=100)
     */
    private $createdAt;
    
    
    
    function __construct($status, $ip, $iso, $country) {
        $this->status = $status;
        $this->ip = $ip;
        $this->iso = $iso;
        $this->country = $country;
        $this->createdAt=  new \DateTime();
    }
    
    public function __toString() {
        return $this->country;
    }
    
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function getIso() {
        return $this->iso;
    }

    public function setIso($iso) {
        $this->iso = $iso;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }




}

?>
