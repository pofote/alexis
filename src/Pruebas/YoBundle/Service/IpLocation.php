<?php

namespace Pruebas\YoBundle\Service;

use Doctrine\ORM\EntityManager;
use Pruebas\YoBundle\Entity\Direcciones;

/**
 * Description of IpLocation
 *
 * @author Alexis Calatayud <alexiscalatayud@gmail.com>
 */
class IpLocation {

    private $apiKey;
    private $apiUrl;
    private $em;

    function __construct($apiKey, $apiUrl, EntityManager $em) {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->em = $em;
    }

    public function getCountryCode($ip = null) {
        $url = $this->apiUrl . '?key=' . $this->apiKey . "&ip=" . $ip;
        if ($ip == null) {
            $url = $this->apiUrl . '?key=' . $this->apiKey;
        }


        $string_country = file_get_contents($url);

        $country = explode(';', $string_country);

        $dir = new Direcciones($country[0], $country[2], $country[3], $country[4]);
        $this->em->persist($dir);
        $this->em->flush();
        
        return $country;
    }

}

?>
