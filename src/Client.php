<?php

namespace OpenXBL;

use GuzzleHttp\Client as GuzzleClient;

class Client extends HttpService
{
    private string $baseUrl = 'https://xbl.io/api/v2/';

    public function __construct(string $apiKey)
    {
        $client = $this->buildClient($apiKey);
        parent::__construct($client);
    }

    private function buildClient(string $apiKey): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'X-Authorization' => $apiKey,
            ],
        ]);
    }
}
