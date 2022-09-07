<?php

namespace App\Http\Service\Availability;

use App\Exceptions\AvailibilityApiException;
use App\Models\Doctor;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

final class DoctolibAvailabilityService implements AvailabilityInterface
{
    private $client;

    public function __construct(private string $apiUrl)
    {
        $this->client = new Client();
    }

    public function getList(Doctor $doctor)
    {
        $requestUrl = str_replace('{EXTERNAL_ID}', $doctor->id, $this->apiUrl);
        $response = $this->client->get($requestUrl);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new AvailibilityApiException('Doctolib', $response->getStatusCode(), $response->getBody());
        }
        $data = json_decode($response->getBody());

        return $data;
    }
}
