<?php namespace Mothership\Truncation;

use \Mothership\Payload\EncodedPayload;

class RawStrategy extends AbstractStrategy
{
    public function execute(EncodedPayload $payload)
    {
        return $payload;
    }
}
