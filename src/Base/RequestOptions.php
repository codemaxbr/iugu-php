<?php

namespace Codemax\Base;

class RequestOptions
{
    public $baseUrl;
    public $endpoint;
    public $payload;
    public $headers;
    public $certificate;
    public $variables;
    public array $queryString;

    public function __construct(array $data)
    {
        if (isset($data['baseUrl'])) {
            $this->baseUrl = $data['baseUrl'];
        }

        if (isset($data['endpoint'])) {
            $this->endpoint = $data['endpoint'];
        }

        if (isset($data['payload'])) {
            $this->payload = $data['payload'];
        }

        if (isset($data['headers'])) {
            $this->headers = $data['headers'];
        }

        if (isset($data['certificate'])) {
            $this->certificate = $data['certificate'];
        }

        if (isset($data['variables'])) {
            $this->variables = $data['variables'];
        }

        if (isset($data['queryString'])) {
            $this->queryString = $data['queryString'];
        }
    }

    public function getPayload()
    {
        if (is_array($this->payload)) {
            return json_encode($this->payload);
        }

        return $this->payload;
    }
}