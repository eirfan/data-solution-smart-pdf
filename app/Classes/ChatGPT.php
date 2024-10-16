<?php 

namespace App\Classes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ChatGPT {
    protected $apiKey;
    protected $client;
    CONST URL = "https://api.openai.com/v1/chat/completions";

    public function __construct() {
        $this->apiKey = env("OPENAPI_API_KEY");
        $this->client = new Client();
    }

    public function ask($prompt) {
        try{
            $response = $this->client->post(
                self::URL,
                [
                    "headers" => [
                        "Authorization" => 'Bearer '.$this->apiKey,
                        "Content-Type" => "application/json",
                    ],
                    "json" => [
                        "model" => "gpt-3.5-turbo",
                        "messages" => [
                            [
                                "role" => "user",
                                "content" => $prompt,
                            ],
                        ],
                        "max_tokens" => 200,
                    ],
                ],
            );
            $content = json_decode($response->getBody(),true);
            return $content["choices"][0]["message"]["content"] ?? "No response"; 

        }catch(RequestException $exception) {
            throw $exception;
        }
    }


}