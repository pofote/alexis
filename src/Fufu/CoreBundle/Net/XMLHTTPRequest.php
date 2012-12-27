<?php

namespace Fufu\CoreBundle\Net;

/**
 * @author Juan Carlos Ruiz Piqueras <juancarlos.ruiz@adsalsagroup.com>
 * @version 1.0
 */
class XMLHTTPRequest extends HTTPRequest {

	public function doRequest() {

		return $xmlRequestResponse = simplexml_load_string(parent::doRequest());
	}
}