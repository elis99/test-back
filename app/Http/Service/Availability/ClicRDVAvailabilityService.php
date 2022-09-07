<?php

namespace App\Http\Service\Availability;

use App\Models\Doctor;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use App\Exceptions\AvailibilityApiException;
use App\Http\DTO\AvailabilityDTO;

final class ClicRDVAvailabilityService extends AbstractAvailability
{
    private $client;

    public function __construct(private string $apiUrl)
    {
        $this->client = new Client();
    }

    /**
     * @return AvailabilityDTO[]
     */
    public function getList(Doctor $doctor): array 
    {
        $requestUrl = str_replace('{EXTERNAL_ID}', $doctor->external_agenda_id, $this->apiUrl);
        $response = $this->client->get($requestUrl);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new AvailibilityApiException('ClicRDV', $response->getStatusCode(), $response->getBody());
        }
        $data = json_decode($response->getBody(), true);

        return $this->prepareDto($data);
    }
}