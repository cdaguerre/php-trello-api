<?php

namespace Trello\Exception;

/**
 * MissingArgumentException
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class MissingArgumentException extends ErrorException
{
    /**
     * @param string $required
     */
    public function __construct($required, $code = 0, $previous = null)
    {
        if (is_string($required)) {
            $required = array($required);
        }

        parent::__construct(sprintf('One or more of required ("%s") parameters are missing!', implode('", "', $required)), $code, $previous);
    }
}
