<?php

namespace Trello\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

abstract class AbstractEvent extends GenericEvent
{
    /**
     * @var array
     */
    protected $requestData;

    /**
     * Set request data
     *
     * @param array $requestData
     */
    public function setRequestData(array $requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * Get request data
     *
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }
}
