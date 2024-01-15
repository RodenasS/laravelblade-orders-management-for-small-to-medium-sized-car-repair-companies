<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VinDecoderService
{
    protected $baseUrl;
    protected $apiKey;
    protected $httpClient;
    public function __construct(Http $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = env('VIN_DECODER_BASE_URL');
        $this->apiKey = env('VIN_DECODER_API_KEY');
    }
    public function decodeVin($vin)
    {
        try {
            $response = $this->sendRequest("vin/$vin");
            return $response;
        } catch (\Exception $e) {
            \Log::error("Error in decodeVin: " . $e->getMessage());
            return null;
        }
    }
    private function sendRequest(string $endpoint, string $method = 'get', array $data = []): array
    {
        try {
            $response = $this->httpClient::withOptions([
                'query' => [
                    'apikey' => $this->apiKey,
                ],
            ])
                ->{$method}($this->constructUrl($endpoint), $data);
            if ($response->successful()) {
                return [
                    'success' => true,
                    'result' => $response->json(),
                ];
            }
            return [
                'success' => false,
                'result' => $response->json(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'result' => ['message' => $e->getMessage()],
            ];
        }
    }
    private function constructUrl(string $endpoint): string
    {
        return rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');
    }
}
