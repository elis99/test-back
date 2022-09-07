<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AvailibilityApiException extends Exception
{
    public function __construct(private string $serviceName, protected $statusCode, private $errBody)
    {
        
    }

    public function render()
    {
        $response = sprintf(
            'Request to %s API failed with code %s and message %s',
            $this->serviceName,
            $this->statusCode,
            $this->errBody
        ); 

        return response($response, Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
