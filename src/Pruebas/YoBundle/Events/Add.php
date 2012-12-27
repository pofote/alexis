<?php

namespace Pruebas\YoBundle\Events;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Pruebas\YoBundle\Entity\Direcciones;

/**
 * Description of Add
 *
 * @author Alexis Calatayud <alexiscalatayud@gmail.com>
 */
class Add {

    public function prePersist(LifecycleEventArgs $arg) {
        $entity = $arg->getEntity();


        if ($entity instanceof Direcciones) {

            $country = $entity->getCountry();
            $iso = $entity->getIso();

            if ($country == 'SPAIN') {
                $entity->setCountry('ESPAÑA');
            }
            if ($iso == '-') {
                $entity->setIso('NO ISO CODE');
            }
            if ($country == '-') {
                $entity->setCountry('NO COUNTRY');
            }
        }
    }

}

?>
