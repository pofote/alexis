<?php

namespace Pruebas\YoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pruebas\YoBundle\Entity\Yo;
use Pruebas\YoBundle\Form\Frontend\YoType;

class DefaultController extends Controller {

    public function indexAction() {
        $peticion = $this->getRequest();

        $yo = new Yo();

        $form = $this->createForm(new YoType(), $yo);


        if ($peticion->getMethod() == 'POST') {
            $form->bindRequest($peticion);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($yo);
                $em->flush();
            }
        }

        return $this->render('YoBundle:Default:index.html.twig', array('formulario' => $form->createView()));
    }

}
