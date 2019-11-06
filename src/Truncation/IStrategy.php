<?php namespace Mothership\Truncation;

use \Mothership\Payload\EncodedPayload;

interface IStrategy
{
    /**
     * @param array $payload
     * @return array
     */
    public function execute(EncodedPayload $payload);
    
    /**
     * @param array $payload
     * @return array
     */
    public function applies(EncodedPayload $payload);
}
