<?php namespace Mothership;

interface DataBuilderInterface
{
    public function makeData($level, $toLog, $context);
}
