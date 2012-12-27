<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Status
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Status")
 * @ORM\Entity()
 */
class Status extends ApiMethod
{

    /**
     * @var string $subscription
     *
     * @ORM\Column(name="subscription", type="string", length=255, nullable=true)
     */
    private $subscription;

    /**
     * @var string $transaction
     *
     * @ORM\Column(name="transaction", type="string", length=255, nullable=true)
     */
    private $transaction;


    /** SETTERS */
    public function setSubscription($subscription){ $this->subscription = $subscription; }
    public function setTransaction($transaction){ $this->transaction = $transaction; }

    /** GETTERS */
    public function getSubscription(){ return $this->subscription; }
    public function getTransaction(){ return $this->transaction; }


    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $subscription = null, $transaction = null)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setcallbackUrl($url_callback);
        $this->setSubscription($subscription);
        $this->setTransaction($transaction);
    }

    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['subscription'] = $this->getSubscription();
        $requestParameters['transaction'] = $this->getTransaction();
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