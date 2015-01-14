<?php

namespace Trello\HttpClient\Listener;

use Trello\HttpClient\Message\ResponseMediator;
use Guzzle\Common\Event;
use Trello\Exception\ErrorException;
use Trello\Exception\RuntimeException;
use Trello\Exception\PermissionDeniedException;
use Trello\Exception\ValidationFailedException;

class ErrorListener
{
    /**
     * {@inheritDoc}
     */
    public function onRequestError(Event $event)
    {
        /** @var $request \Guzzle\Http\Message\Request */
        $request = $event['request'];
        $response = $request->getResponse();

        if ($response->isClientError() || $response->isServerError()) {
            $content = ResponseMediator::getContent($response);

            if (is_array($content) && isset($content['message'])) {
                if (400 == $response->getStatusCode()) {
                    throw new ErrorException($content['message'], 400);
                } elseif (401 == $response->getStatusCode()) {
                    throw new PermissionDeniedException($content['message'], 401);
                } elseif (422 == $response->getStatusCode() && isset($content['errors'])) {
                    $errors = array();
                    foreach ($content['errors'] as $error) {
                        switch ($error['code']) {
                            case 'missing':
                                $errors[] = sprintf('The %s %s does not exist, for resource "%s"', $error['field'], $error['value'], $error['resource']);
                                break;

                            case 'missing_field':
                                $errors[] = sprintf('Field "%s" is missing, for resource "%s"', $error['field'], $error['resource']);
                                break;

                            case 'invalid':
                                $errors[] = sprintf('Field "%s" is invalid, for resource "%s"', $error['field'], $error['resource']);
                                break;

                            case 'already_exists':
                                $errors[] = sprintf('Field "%s" already exists, for resource "%s"', $error['field'], $error['resource']);
                                break;

                            default:
                                $errors[] = $error['message'];
                                break;

                        }
                    }

                    throw new ValidationFailedException('Validation Failed: '.implode(', ', $errors), 422);
                }
            }

            throw new RuntimeException(isset($content['message']) ? $content['message'] : $content, $response->getStatusCode());
        };
    }
}
