<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Authorize
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Authorize")
 * @ORM\Entity()
 */
class Authorize extends ApiMethod
{

    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string $amount
     *
     * @ORM\Column(name="amount", type="string", length=255, nullable=true)
     */
    private $amount;

    /**
     * @var string $url_return
     *
     * @ORM\Column(name="url_return", type="string", length=255, nullable=true)
     */
    private $url_return;

    /**
     * @var string $subscription
     *
     * @ORM\Column(name="subscription", type="string", length=255, nullable=true)
     */
    private $subscription;

    /**
     * @var string $pin
     *
     * @ORM\Column(name="pin", type="string", length=255, nullable=true)
     */
    private $pin;




    /** SETTERS */
    private function setAction($action){ $this->action = $action; }
    public function setAmount($amount){ $this->amount = $amount; }
    public function setUrlReturn($url_return){ $this->url_return = $url_return; }
    public function setSubscription($subscription){ $this->subscription = $subscription; }
    public function setPin($pin){ $this->pin = $pin; }

    /** GETTERS */
    public function getAction(){ return $this->action; }
    public function getAmount(){ return $this->amount; }
    public function getUrlReturn(){ return $this->url_return; }
    public function getSubscription(){ return $this->subscription; }
    public function getPin(){ return $this->pin; }

    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $action, $amount, $url_return, $subscription, $pin)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setAction('authorize');
        $this->setcallbackUrl($url_callback);
        $this->setAmount($amount);
        $this->setReturnUrl($url_return);
        $this->setSubscription($subscription);
        $this->setPin($pin);
    }


    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['action'] = $this->getAction();
        $requestParameters['amount'] = $this->getAmount();
        $requestParameters['url_return'] = $this->getReturnUrl();
        $requestParameters['subscripcion'] = $this->getSubscription();
        $requestParameters['pin'] = $this->getPin();
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