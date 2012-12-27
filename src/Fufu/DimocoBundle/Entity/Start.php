<?php

namespace Fufu\DimocoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fufu\DimocoBundle\Entity\Start
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\Table(name="FUFU_DIMOCO_Start")
 * @ORM\Entity()
 */
class Start extends ApiMethod
{
    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string $order
     *
     * @ORM\Column(name="order", type="string", length=255, nullable=true)
     */
    private $order;

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
     * @var string $transaction
     *
     * @ORM\Column(name="transaction", type="string", length=255, nullable=true)
     */
    private $transaction;

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

    /**
     * @var string $mvno
     *
     * @ORM\Column(name="mvno", type="string", length=255, nullable=true)
     */
    private $mvno;


    /** SETTERS */
    private function setAction($action){ $this->action = $action; }
    public function setOrder($order){ $this->order = $order; }
    public function setAmount($amount){ $this->amount = $amount; }
    public function setUrlReturn($url_return){ $this->url_return = $url_return; }
    public function setSubscription($subscription){ $this->subscription = $subscription; }
    public function setTransaction($transaction){ $this->transaction = $transaction; }
    public function setChannel($channel){ $this->channel = $channel; }
    public function setOperator($operator){ $this->operator = $operator; }
    public function setMsisdn($msisdn){ $this->msisdn = $msisdn; }
    public function setMvno($mvno){ $this->mvno = $mvno; }

    /** GETTERS */
    public function getAction(){ return $this->action; }
    public function getOrder(){ return $this->order; }
    public function getAmount(){ return $this->amount; }
    public function getUrlReturn(){ return $this->url_return; }
    public function getSubscription(){ return $this->subscription; }
    public function getTransaction(){ return $this->transaction; }
    public function getChannel(){ return $this->channel; }
    public function getOperator(){ return $this->operator; }
    public function getMsisdn(){ return $this->msisdn; }
    public function getMvno(){ return $this->mvno; }

    /** CONSTRUCT */
    public function __construct($apiUrl, $merchant, $password, $url_callback, $action, $order, $amount, $url_return, $subscription,
                                $transaction, $channel, $operator, $msisdn, $mvno)
    {
        parent::__construct($apiUrl, $merchant, $password, $url_callback);
        $this->setAction('start');
        $this->setcallbackUrl($url_callback);
        $this->setOrder($order);
        $this->setAmount($amount);
        $this->setReturnUrl($url_return);
        $this->setSubscription($subscription);
        $this->setTransaction($transaction);
        $this->setChannel($channel);
        $this->setOperator($operator);
        $this->setMsisdn($msisdn);
        $this->setMvno($mvno);
    }

    protected function getRequestParameters()
    {
        $requestParameters = parent::getRequestParameters();
        $requestParameters['action'] = $this->getAction();
        $requestParameters['order'] = $this->getOrder();
        $requestParameters['amount'] = $this->getAmount();
        $requestParameters['url_return'] = $this->getUrlReturn();
        $requestParameters['subscription'] = $this->getSubscription();
        $requestParameters['transaction'] = $this->getTransaction();
        $requestParameters['channel'] = $this->getChannel();
        $requestParameters['operator'] = $this->getOperator();
        $requestParameters['msisdn'] = $this->getMsisdn();
        $requestParameters['mvno'] = $this->getMvno();
        return $requestParameters;
    }

    protected function setResponseParameters($xmlRequestResponse)
    {
        parent::setResponseParameters($xmlRequestResponse);
        /*
        $this->setResponseUrl($xmlRequestResponse->Url);
        $this->setResponseAuthenticateId($xmlRequestResponse->AuthenticateID);
        $this->setResponseLock($xmlRequestResponse->Lock);
        */
    }
}