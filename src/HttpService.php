<?php

namespace OpenXBL;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class HttpService
{
	// Format for expected response.
	public string $format = 'json';

	// Preferred language of content.
	public string $language = 'en-US,en';

	// Flag to determine type of call to make.
	public bool $isApp = false;

	// Body content of POST request, if any.
    private array $payload = array();

	// Type of call to make (https://xbl.io/console).
    private string $endpoint;

	// Type of request to make (POST, GET).
	private string $method;

    private ClientInterface $client;

	public function __construct(ClientInterface $client)
	{
        $this->client = $client;
	}

    /**
     * @throws GuzzleException
     * @throws InvalidArgumentException
     */
	public function  __call(string $method, array $arguments): ?string
	{
		if (!isset($arguments[0])) {
			throw new InvalidArgumentException("Endpoint is not set.");
		}

		$this->method = $method;

		$this->endpoint = $arguments[0];

		if(isset($arguments[1])) {
			$this->payload = $arguments[1];
		}

		return $this->request();
	}

    /**
     * @throws GuzzleException
     */
	protected function request(): ?string
	{
        $options = [
            'headers' => [
                'Accept' => ($this->format == 'json') ? 'application/json' : 'application/xml',
                'Accept-Language' => $this->language,
                'X-Contract' => $this->isApp ? 100 : null,
            ],
        ];

        if ($this->payload) {
            $options['json'] = $this->payload;
        }

        $request = $this->client->request($this->method, $this->endpoint, $options);

        return $request->getBody()->getContents();
	}
}
