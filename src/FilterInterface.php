<?php namespace Mothership;

interface FilterInterface
{
    public function shouldSend($payload, $accessToken);
}
