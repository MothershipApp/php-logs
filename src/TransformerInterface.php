<?php namespace Mothership;

use Mothership\Payload\Level;
use Mothership\Payload\Payload;

interface TransformerInterface
{
    /**
     * @param Payload $payload
     * @param Level $level
     * @param \Exception | \Throwable $toLog
     * @param $context
     * @return Payload
     */
    public function transform(Payload $payload, $level, $toLog, $context);
}
