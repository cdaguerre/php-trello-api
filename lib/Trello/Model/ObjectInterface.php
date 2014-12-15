<?php

namespace Trello\Model;

use Trello\Exception\BadMethodCallException;

interface ObjectInterface
{
    /**
     * Get identifier
     *
     * @return string
     */
    public function getId();

    /**
     * Save the object through API
     *
     * @return AbstractObject
     *
     * @throws BadMethodCallException    If this method is not allowed by the API on the child object
     * @throws PermissionDeniedException If the client does not have sufficient privileges
     */
    public function save();

    /**
     * Remove the object through API
     *
     * @return AbstractObject
     *
     * @throws BadMethodCallException    If this method is not allowed by the API on the child object
     * @throws PermissionDeniedException If the client does not have sufficient privileges
     */
    public function remove();

    /**
     * Refresh the object through API
     *
     * @return AbstractObject
     */
    public function refresh();

    /**
     * Get data
     *
     * @return array
     */
    public function getData();

    /**
     * Set data
     *
     * @param array $data
     *
     * @return AbstractObject
     */
    public function setData(array $data);
}
