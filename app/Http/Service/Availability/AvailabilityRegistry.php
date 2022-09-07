<?php

namespace App\Http\Service\Availability;

use Exception;

final class AvailabilityRegistry
{
    private $handlers = [];

    public function register($name, AbstractAvailability $instance) 
    {
        $this->handlers[$name] = $instance;

        return $this;
    }
  
    public function get($name): AbstractAvailability
    {
        if (!array_key_exists($name, $this->handlers)) {
            throw new Exception('No handler found.');
        }

        return $this->handlers[$name];
    }
}