<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidCredentials extends Exception
{
    public function render()
    {
        return response( 'Invalid Credentials.', Response::HTTP_UNAUTHORIZED);
    }
}
