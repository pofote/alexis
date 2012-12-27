<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Capture
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Capture")
 * @ORM\Entity()
 */
class Capture extends ApiMethod
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
     * @var string $transaction
     *
     * @ORM\Column(name="transaction", type="string", length=255, nullable=true)
     */
    private $transaction;

    /**
     * @var string $sms_text
     *
     * @ORM\Column(name="sms_text", type="string", length=1024, nullable=true)
     */
    private $sms_text;

    /**
     * @var string $sms_url
     *
     * @ORM\Column(name="sms_url", type="string", length=255, nullable=true)
     */
    private $sms_url;



    /** SETTERS */
    private function setAction($action){ $this->action = $action; }
    public function setAmount($amount){ $this->amount = $amount; }
    public function setTransaction($transaction){ $this->transaction = $transaction; }
    public function setSmsText($sms_text){ $this->sms_text = $sms_text; }
    public function setSmsUrl($sms_url){ $this->sms_url = $sms_url; }

    /** GETTERS */
    public function getAction(){ return $this->action; }
    public function getAmount(){ return $this->amount; }
    public function getTransaction(){ return $this->transaction; }
    public function getSmsText(){ return $this->sms_text; }
    public function getSmsUrl(){ return $this->sms_url; }

    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $action, $amount, $transaction, $sms_text, $sms_url)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setAction('authorize');
        $this->setcallbackUrl($url_callback);
        $this->setAction($action);
        $this->setAmount($amount);
        $this->setTransaction($transaction);
        $this->setSmsText($sms_text);
        $this->setSmsUrl($sms_url);
    }


    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['action'] = $this->getAction();
        $requestParameters['amount'] = $this->getAmount();
        $requestParameters['transaction'] = $this->getTransaction();
        $requestParameters['sms_text'] = $this->getSmsText();
        $requestParameters['sms_url'] = $this->getSmsUrl();
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