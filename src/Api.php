<?php
# Copyright (c) xTACTICSx
# OpenXBL, https://xbl.io
#
# OpenXBL is an unofficial Xbox Live API that provides
# user-friendly documentation, support and examples.
#
#
/**
 * This file contains code about \OpenXBL\Api class
 */

namespace OpenXBL;


/**
 * Wrapper to manage exchanges with OpenXBL API
 *
 * @package  OpenXBL
 * @category OpenXBL
 */
class Api
{

	    /**
	     * Base URL for OpenXBL 2.0
	     *
	     * @var string
	     */
		public $base_url = 'https://xbl.io/api/v2/';

	    /**
	     * Format for expected response
	     *
	     * @var string
	     */
		public $format = 'json';

	    /**
	     * Preferred language of content, if applicable
	     *
	     * @var string
	     */
		public $language = 'en-US, en';

	    /**
	     * Flag to determine type of call to make
	     *
	     * @var string
	     */
		public $isApp = FALSE;

	    /**
	     * Body content of POST request, if any
	     *
	     * @var array
	     */
		protected $payload = array();

	    /**
	     * Type of call to make (https://xbl.io/console)
	     *
	     * @var string
	     */
		protected $endpoint;

	    /**
	     * Type of request to make (POST, GET)
	     *
	     * @var string
	     */
		protected $method;

	    /**
	     * API or APP token to use
	     *
	     * @var string
	     */
		public $token;

	    /**
	     * Construct a new wrapper instance
	     *
	     * @param string $token    			 API or APP key
	     *
	     * @throws Exceptions\InvalidParameterException if missing a required parameter
	     */
		public function __construct($token)
		{

	        if (!isset($token)) 
	        {
	            throw new Exceptions\InvalidParameterException("API Key is not set.");
	        }

			$this->token = $token;
		}

	    /**
	     * Magic setter
	     *
	     * @param string $method    			 API or APP key
	     * @param array $arguments	   			 Endpoint and payload (if any)
	     *
	     * @throws Exceptions\InvalidParameterException if missing method or endpoint
	     */
		public function  __call($method, $arguments)
		{

	        if (!isset($method)) 
	        {
	            throw new Exceptions\InvalidParameterException("Method is not set.");
	        }

	        if (!isset($arguments[0])) 
	        {
	            throw new Exceptions\InvalidParameterException("Endpoint not set.");
	        }

			$this->method = $method;

			$this->endpoint = $arguments[0];

			if(isset($arguments[1]))
			{

				$this->payload = $arguments[1];

			}

			return $this->curl_request();

		}

	    /**
	     * This is the main method of this wrapper. It will build and return its result.
	     *
	     * @return string
	     */
		protected function curl_request()
		{

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $this->base_url . $this->endpoint );

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($this->method));

	        $header = array();

	        $header[] = 'Accept: ' . (($this->format == 'json') ? 'application/json' : 'application/xml');

	        $header[] = 'X-Authorization: ' . $this->token;

	        $header[] = 'Accept-Language: ' . $this->language;

	        if($this->isApp)
	        {
	        	$header[] = 'X-Contract: 100';
	        }

	        if($this->payload)
	        {

	        	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($this->payload) );

	        	curl_setopt($ch, CURLOPT_POST, 1);

	        }

		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

		    curl_setopt($ch, CURLOPT_VERBOSE, 1);

	        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);

			curl_setopt($ch, CURLOPT_TIMEOUT, 30);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$response = curl_exec($ch);

			if (curl_error($ch)) {

			    die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));

			}

			curl_close($ch);

			return $response;

		}

}
