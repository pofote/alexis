<?php

namespace Fufu\DimocoBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Mapping as ORM;


/**
 * Fufu\DimocoBundle\Entity\ApiMethod
 *
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 *
 * @ORM\MappedSuperclass
 */
abstract class ApiMethod
{
    const ERROR_NO_XML_RESPONSE = 'ERROR_NO_XML_RESPONSE';

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $apiUrl
     *
     * @ORM\Column(name="apiUrl", type="string", length=255, nullable=false)
     */
    protected $apiUrl;

    /**
     * @var string $merchant
     *
     * @ORM\Column(name="merchant", type="string", length=255, nullable=false)
     */
    protected $merchant;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected $password;

    /**
     * @var string $url_callback
     *
     * @ORM\Column(name="url_callback", type="string", length=1024, nullable=true)
     */
    protected $url_callback;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    protected $createdAt;


    public function __construct($apiUrl, $merchant, $password, $url_callback)
    {
        $this->apiUrl = $apiUrl;
        $this->setMerchant($merchant);
        $this->setPassword($password);
        $this->setUrlCallback($url_callback);
        $this->setCreatedAt(new \DateTime());
    }


    /** SETTERS */
    public function setMerchant($merchant){ $this->merchant = $merchant; }
    public function setPassword($password){ $this->password = $password; }
    public function setUrlCallback($url_callback){ $this->url_callback = $url_callback; }
    protected function setCreatedAt($createdAt){ $this->createdAt = $createdAt; }

    /** GETTERS */
    public function getId(){ return $this->id; }
    public function getMerchant(){ return $this->merchant; }
    public function getPassword(){ return $this->password; }
    public function getUrlCallback(){ return $this->url_callback; }
    public function getCreatedAt(){ return $this->createdAt; }
    protected function getApiUrl(){ return $this->apiUrl; }


    protected function getRequestParameters() {
        $requestParameters = array();
        $requestParameters['merchant'] = FUFU_MERCHANT;
        $requestParameters['password'] = FUFU_PASSWORD;
        return $requestParameters;
    }

    protected function setResponseParameters($xmlRequestResponse) {

        $this->setResponseReturnCode($xmlRequestResponse->ReturnCode);
        $this->setResponseNextRetryPeriod($xmlRequestResponse->NextRetry->Period);
        $this->setResponseNextRetryValue($xmlRequestResponse->NextRetry->Value);
        $this->setResponseReason($xmlRequestResponse->Reason);
    }


    /**
     * Makes the API call.
     *
     * @param Symfony\Bundle\FrameworkBundle\Controller\Controller $controller
     * @return mixed
     * @throws \Exception
     */
    final public function doRequest(Controller $controller) {

        $em = $controller->getDoctrine()->getEntityManager();

        // Prepare and make the API call.
        $xmlHttpRequest = new XMLHTTPRequest($this->getApiUrl());
        $xmlHttpRequest->setPostParameters($this->getRequestParameters());
        $xmlRequestResponse = $xmlHttpRequest->doRequest();

        // Save the info about the user's session.
        $this->setSessionName(session_name());
        $this->setSessionId(session_id());
        $this->setIp($controller->getRequest()->getClientIp());

        // Process the API response.
        if($xmlRequestResponse !== null && $xmlRequestResponse !== false && $xmlRequestResponse->count() > 0) {

            $this->setResponseParameters($xmlRequestResponse);

            $em->persist($this);
            $em->flush();

            return $this->processRequestResponse($xmlRequestResponse);
        } else {

            $em->persist($this);
            $em->flush();

            throw new \Exception(self::ERROR_NO_XML_RESPONSE);
        }
    }

    /**
     * This method is called after the API call.
     *
     * @param $xmlRequestResponse
     * @return mixed
     */
    protected function processRequestResponse($xmlRequestResponse) {

        return $xmlRequestResponse;
    }

}
