<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Idenfity
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Identify")
 * @ORM\Entity()
 */
class Identify extends ApiMethod
{

    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string $url_return
     *
     * @ORM\Column(name="url_return", type="string", length=1024, nullable=true)
     */
    private $url_return;

    /**
    * @var string $channel
    *
    * @ORM\Column(name="channel", type="string", length=255, nullable=true)
    */
    private $channel;

    /**
     * @var string $operator
     *
     * @ORM\Column(name="operator", type="string", length=255, nullable=true)
     */
    private $operator;

    /**
     * @var string $msisdn
     *
     * @ORM\Column(name="msisdn", type="string", length=255, nullable=true)
     */
    private $msisdn;



    /** SETTERS */
    private function setAction($action){ $this->action = $action; }
    public function setReturnUrl($url_return){ $this->url_return = $url_return; }
    public function setChannel($channel){ $this->channel = $channel; }
    public function setOperator($operator){ $this->operator = $operator; }
    public function setMsisdn($msisdn){ $this->msisdn = $msisdn; }

    /** GETTERS */
    public function getReturnUrl(){ return $this->url_return; }
    public function getAction(){ return $this->action; }
    public function getChannel(){ return $this->channel; }
    public function getOperator(){ return $this->operator; }
    public function getMsisdn(){ return $this->msisdn; }


    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $action, $url_return, $channel, $operator, $msisdn)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setAction('identify');
        $this->setcallbackUrl($url_callback);
        $this->setReturnUrl($url_return);
        $this->setChannel($channel);
        $this->setOperator($operator);
        $this->setMsisdn($msisdn);
    }

    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['action'] = $this->getAction();
        $requestParameters['url_return'] = $this->getReturnUrl();
        $requestParameters['channel'] = $this->getChannel();
        $requestParameters['operator'] = $this->getOperator();
        $requestParameters['msisdn'] = $this->getMsisdn();
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