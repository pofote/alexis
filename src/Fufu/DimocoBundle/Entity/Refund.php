<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Refund
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Refund")
 * @ORM\Entity()
 */
class Refund extends ApiMethod
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


    /** SETTERS */
    private function setAction($action){ $this->action = $action; }
    public function setTransaction($transaction){ $this->transaction = $transaction; }
    public function setAmount($amount){ $this->amount = $amount; }

    /** GETTERS */
    public function getAction(){ return $this->action; }
    public function getTransaction(){ return $this->transaction; }
    public function getAmount(){ return $this->amount; }

    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $action, $transaction, $amount)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setAction('refund');
        $this->setcallbackUrl($url_callback);
        $this->setTransaction($transaction);
        $this->setAmount($amount);
    }


    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['action'] = $this->getAction();
        $requestParameters['transaction'] = $this->getTransaction();
        $requestParameters['amount'] = $this->getAmount();
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