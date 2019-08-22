<?php

namespace Voh\DataCollectLaravel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Voh\DataCollectLaravel\Exceptions\MissingCodeException;
use Voh\DataCollectLaravel\Exceptions\RequestFailException;

/**
 * Class ApiClient
 *
 * @package Voh\DataCollectLaravel
 */
class ApiClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $code;

    /**
     * ApiClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('data-collect.base_url'),
        ]);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setWebsiteCode($value): self
    {
        $this->code = $value;

        return $this;
    }

    /**
     * @param $data
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function push($data): bool
    {
        if (!$this->code) {
            throw new MissingCodeException();
        }

        try {
            $response = $this->client->request('POST', "/api/collect/{$this->code}", [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 201) {
                return true;
            }
        } catch (ClientException $ex) {
            if ($ex->hasResponse()) {
                throw new RequestFailException(Psr7\str($ex->getResponse()));
            }

            throw new RequestFailException(Psr7\str($ex->getRequest()));
        }
    }
}
