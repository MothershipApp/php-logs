<?php namespace Mothership\Senders;

use Mothership\Payload\Payload;
use Mothership\Payload\EncodedPayload;

interface SenderInterface
{
    public function send(EncodedPayload $payload, $accessToken);
    public function sendBatch($batch, $accessToken);
    public function wait($accessToken, $max);
    public function toString();
}
