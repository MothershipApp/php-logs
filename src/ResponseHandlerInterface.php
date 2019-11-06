<?php namespace Mothership;

interface ResponseHandlerInterface
{
    public function handleResponse($payload, $response);
}
