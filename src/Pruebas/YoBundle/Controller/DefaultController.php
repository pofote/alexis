<?php

namespace Pruebas\YoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pruebas\YoBundle\Entity\Yo;
use Pruebas\YoBundle\Form\Frontend\YoType;
use Symfony\Component\Security\Core\SecurityContext;

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

    public function pag1Action() {
        $data = $this->getRequest()->get('data');
        $json = array('data' => $data);
        $respuesta = new \Symfony\Component\HttpFoundation\Response(json_encode($json));
        $respuesta->headers->set('Content-type', 'Application/json');

        return $respuesta;
    }

    public function pag2Action() {
        $datos = $this->getRequest()->get('data');

        return $this->render('YoBundle:Default:index3.html.twig', array('didi' => $datos));
    }

    public function locationAction() {

        $ip = $this->getRequest()->getClientIp();
        $ip = '62.82.228.34';
        $ipLoc = $this->get('iplocation');
        $country = $ipLoc->getCountryCode();


        return $this->render('YoBundle:Default:index3.html.twig', array('didi' => $country[3]));
    }

    public function loginAction() {

        $peticion = $this->getRequest();
        $session = $peticion->getSession();

        $error = $peticion->attributes->get(SecurityContext::AUTHENTICATION_ERROR, $session->get(SecurityContext::AUTHENTICATION_ERROR));
        if($error!=''){
             $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('No puedes PASAR');
          
           
        }

        return $this->render('YoBundle:Default:login.html.twig', array(
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error'                  => $error
                ));
    }

}
