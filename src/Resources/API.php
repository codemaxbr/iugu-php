<?php

namespace Iugu\Resources;

use Iugu\Base\RequestOptions;
use Iugu\Iugu;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

abstract class API extends Iugu
{
    protected $baseUrl = 'https://api.iugu.com/v1';
    protected $endpoints = [];

    abstract public function loadEndpoints();

    public function getDefaultHeader()
    {
        return [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Basic " . base64_encode(self::$apiKey . ':'),
        ];
    }

    public function requestHttp(RequestOptions $option)
    {
        $http = new Client();

        try {
            $endpoint = $this->getEndpoint($option);
            $apiURL   = $this->baseUrl . $endpoint["route"];

            $options['headers'] = $option->headers ?? $this->getDefaultHeader();
            if ($endpoint["method"] == "GET") {
                $options['query'] = $option->payload;
            } else {
                $options['json'] = $option->payload;
            }

            if (!is_null($option->certificate)) {
                $options['cert'] = $option->certificate;
            }

            $response = $http->request($endpoint["method"], $apiURL, $options);
            return (object) [
                'action'     => $option->endpoint,
                'url'        => $endpoint['method'] .' '. $apiURL,
                'payload'    => $option->payload,
                'response'   => json_decode($response->getBody()->getContents()),
                'statusCode' => $response->getStatusCode(),
            ];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                return (object) [
                    'action'     => $option->endpoint,
                    'url'        => $endpoint['method'] .' '. $apiURL,
                    'payload'    => $option->payload,
                    'response'   => json_decode($response->getBody()->getContents()),
                    'statusCode' => $response->getStatusCode(),
                ];
            }

            return null;
        } catch (ConnectException $e) {
            return (object) [
                'action'     => $option->endpoint,
                'url'        => $endpoint['method'] .' '. $apiURL,
                'error'      => $e->getHandlerContext()['error'],
                'response'   => json_decode($e->getMessage()),
                'statusCode' => 500,
            ];
        }
    }

    /**
     * @param RequestOptions $option
     * endpoint,variables,queryString
     * @return mixed
     */
    public function getEndpoint(RequestOptions $option)
    {
        $tempEndpoint = $this->endpoints[$option->endpoint] ?? null;

        if (!empty($tempEndpoint)) {
            if (!empty($option->variables)) {
                $route = $tempEndpoint["route"];
                preg_match_all("/:(\w+)/im", $route, $matches);
                $varsRoute = $matches[1];
                $i = 0;
                foreach ($varsRoute as $value) {
                    if (isset($option->variables[$i])) {
                        $route = str_replace(":" . $value, $option->variables[$i], $route);
                    }
                    $i++;
                }
                $tempEndpoint["route"] = $route;
            }

            if (!empty($option->queryString)) {
                $route = $tempEndpoint["route"];

                $queryString = http_build_query($option->queryString, "=>");

                $tempEndpoint["route"] = $route . "?" . $queryString;
            }

            return $tempEndpoint;
        }
        return null;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}