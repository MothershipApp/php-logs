<?php namespace Mothership;

interface ScrubberInterface
{
    public function scrub(&$data, $replacement);
}
