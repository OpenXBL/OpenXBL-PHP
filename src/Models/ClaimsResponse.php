<?php

namespace OpenXBL\Models;

class ClaimsResponse
{
	public string $appKey;
	public string $xuid;
	public string $gamertag;
	public string $email;
	public ?string $avatar = null;

	public function __construct(string $json) {
		$json = json_decode($json, true);
		foreach ($json as $key => $value) {
			if (property_exists(__CLASS__, $key)) {
				$this->$key = $value;
			}
		}
	}
}
