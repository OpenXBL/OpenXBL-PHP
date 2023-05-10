<?php

namespace OpenXBL;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use OpenXBL\Models\ClaimsResponse;

class Auth extends GuzzleClient
{
	private string $publicKey;
	private string $baseUrl = 'https://xbl.io/app/';

	public function __construct(string $publicKey)
	{
		$this->publicKey = $publicKey;
		parent::__construct([
			'base_uri' => $this->baseUrl,
		]);
	}

	/**
	 * @throws GuzzleException
	 */
	public function claim(string $code): ClaimsResponse
	{
		$options = [
			'headers' => [
				'Accept' => 'application/json',
			],
			'json' => [
				'code' => $code,
				'app_key' => $this->publicKey,
			],
		];

		$request = $this->request('POST', 'claim', $options);

		return new ClaimsResponse((string) $request->getBody());
	}

	public function getLoginUrl(): string
	{
		return "https://xbl.io/app/auth/{$this->publicKey}";
	}
}
