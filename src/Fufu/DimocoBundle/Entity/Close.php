<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Close
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Close")
 * @ORM\Entity()
 */
class Close extends ApiMethod
{

    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string $subscription
     *
     * @ORM\Column(name="subscription", type="string", length=255, nullable=true)
     */
    private $subscription;


    /** SETTERS */
    private function setAction($action){ $this->action = $action; }
    public function setSubscription($subscription){ $this->subscription = $subscription; }

    /** GETTERS */
    public function getAction(){ return $this->action; }
    public function getSubscription(){ return $this->subscription; }

    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $action, $subscription)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setAction('close');
        $this->setcallbackUrl($url_callback);
        $this->setSubscription($subscription);
    }

    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['action'] = $this->getAction();
        $requestParameters['subscription'] = $this->getSubscription();
        return $requestParameters;
    }

    protected function setResponseParameters($xmlRequestResponse) {

        parent::setResponseParameters($xmlRequestResponse);
        /*
        $this->setResponseUrl($xmlRequestResponse->Url);
        $this->setResponseAuthenticateId($xmlRequestResponse->AuthenticateID);
        $this->setResponseLock($xmlRequestResponse->Lock);
        */
    }
}