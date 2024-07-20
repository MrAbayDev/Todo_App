<?php

declare(strict_types=1);

use GuzzleHttp\Client;

class Bot {
    const TOKEN = "7247419216:AAFhEMoTi5Two1IHqkn8EKsUZr0Q-7Sqz04";
    const API = "https://api.telegram.org/bot".self::TOKEN."/";

    public Client $http;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => self::API]);
    }

    public function handleStartCommand(int $chatId): void
    {
        $this->http->post('sendMessage', [
            'json' => [
                'chat_id' => $chatId,
                'text' => 'Welcome to my bot'
            ]
        ]);
    }
    public function addHandlerCommand ($chatId) {
        $this->http->post('sendMessage',[
            'form_params'=>[
                'chat_id'=>$chatId,
                'text'=>"enter task"
            ]
        ]);
    }
    public function addTask()
    {

    }
}
