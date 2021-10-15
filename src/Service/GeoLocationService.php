<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoLocationService
{
    
    public function __construct(private HttpClientInterface $client)
    {
    }

    /**
     * Ask map box api with an address to get the current coordinates of a location 
     * @param $address | string, Address of the location
     * @return $coordinates | array, Coordinates of the location 
     */
    public function getCoordinates(string $address): array
    {
        $url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/';
        $param = urlencode($address) . '.json';
        $apikey = '?access_token=' . $_SERVER["MB_API_KEY"];

        $response = $this->client->request('GET', $url . $param . $apikey);
        return json_decode($response->getContent())->features[0]->geometry->coordinates;
    }
}