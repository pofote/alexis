<?php

namespace Fufu\DimocoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fufu\DimocoBundle\Dimoco\Util\Util;
use Fufu\DimocoBundle\Entity\Status;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Fufu\CoreBundle\Net\XMLHTTPRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DimocoBundle:Default:index.html.twig', array('name' => $name));
    }

    public function getStatusAction($id)
    {

        return $this->render('DimocoBundle:Default:index.html.twig', array('id' => $id));

        //    public function __construct($apiUrl, $merchant, $password, $url_callback, $subscription = null, $transaction = null)

        $em = $this->getDoctrine()->getEntityManager();
        $status = new Status(URL_TEST_SYSTEM, FUFU_MERCHANT, FUFU_PASSWORD, '¿¿¿url_callback???', $id, null);
        $algo = $status->doRequest($this);


        return new Response(print_r($algo, true));

    }

    protected function getRequestParameters() {
        $requestParameters = array();
        $requestParameters['merchant'] = FUFU_MERCHANT;
        $requestParameters['password'] = FUFU_PASSWORD;
        $requestParameters['subscription'] = FUFU_PASSWORD;
        return $requestParameters;
    }

}

