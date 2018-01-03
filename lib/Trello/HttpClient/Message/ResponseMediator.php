<?php

namespace Trello\HttpClient\Message;


use GuzzleHttp\Psr7\Response;

class ResponseMediator
{
    public static function getContent(Response $response)
    {
        $body    = $response->getBody()->getContents();

        $content = json_decode($body, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return $body;
        }

        return $content;
    }

    /*
    public static function getApiLimit(Response $response)
    {
        $remainingCalls = $response->getHeader('X-RateLimit-Remaining');

        if (null !== $remainingCalls && 1 > $remainingCalls) {
            throw new ApiLimitExceedException($remainingCalls);
        }
    }
    */
}
