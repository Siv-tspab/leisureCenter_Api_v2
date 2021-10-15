<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    /**
     * Ask open weather map api with coordinates to get the current weather of a location 
     * @param $coordinates | array, Coordinates of the location 
     * @return $weather | array, weather infos
     */
    public function getWeather(array $coordinates): array
    {
        $url = 'https://api.openweathermap.org/data/2.5/weather';
        $param = '?lat=' . $coordinates[1] . '&lon=' . $coordinates[0];
        $apikey = '&appid=' . $_SERVER["OWM_API_KEY"];

        $response = $this->client->request('GET', $url . $param . $apikey);
        return $response->toArray()["weather"];
    }
}
