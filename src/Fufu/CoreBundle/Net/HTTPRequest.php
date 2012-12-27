<?php

namespace Fufu\CoreBundle\Net;

/**
 * @author Juan Carlos Ruiz Piqueras <juancarlos.ruiz@adsalsagroup.com>
 * @version 1.0
 */
class HTTPRequest {
	
	const ERROR_INITIALIZING = 'ERROR_INITIALIZING';
	const ERROR_REQUESTING = 'ERROR_REQUESTING';

	private $url;
	private $getParameters;
	private $postParameters;

	public function __construct($url) {

		$this->url = $url;
		$this->getParameters = array();
        $this->postParameters = array();
	}

	public function setGetParameter($parameter, $value) {

		$this->getParameters[$parameter] = $value;
	}

	public function setGetParameters($parameters) {

		if(is_array($parameters)) {

			foreach($parameters as $parameter => $value) {

				$this->getParameters[$parameter] = $value;
			}
		}
	}

	public function setPostParameter($parameter, $value) {

		$this->postParameters[$parameter] = $value;
	}

	public function setPostParameters($parameters) {

		if(is_array($parameters)) {

			foreach($parameters as $parameter => $value) {

				$this->postParameters[$parameter] = $value;
			}
		}
	}

	public function doRequest() {

		$url = $this->url;

		if(count($this->getParameters) > 0) {

			$getParameters = $this->getGetParameters();

			if(!empty($getParameters)) {

				$url .= '?'.$getParameters;
			}
		}

		if(($curl = curl_init($url)) === false) {

			throw new \Exception(self::ERROR_INITIALIZING);
		}

		if(count($this->postParameters) > 0) {

			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $this->getPostParameters());
		}

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		if(($requestResponse = curl_exec($curl)) === false) {

			curl_close($curl);
			throw new \Exception(self::ERROR_REQUESTING);
		}

		curl_close($curl);

		return $requestResponse;
	}

	private function getGetParameters() {

		$getParameters = '';

		if(count($this->getParameters) > 0) {

			foreach($this->getParameters as $parameter => $value) {

				if($value !== null) {

					$getParameters .= urlencode($parameter).'='.urlencode($value).'&';
				}
			}

			if(strlen($getParameters) > 0) {

				$getParameters = substr($getParameters, 0, -1);
			}
		}

		return $getParameters;
	}

	private function getPostParameters() {

		$postParameters = '';

		if(count($this->postParameters) > 0) {

			foreach($this->postParameters as $parameter => $value) {

				if($value !== null) {

					$postParameters .= urlencode($parameter).'='.urlencode($value).'&';
				}
			}

			if(strlen($postParameters) > 0) {

				$postParameters = substr($postParameters, 0, -1);
			}
		}

		return $postParameters;
	}
}