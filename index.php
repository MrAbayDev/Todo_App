<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'src/Bot.php';
$bot = new Bot();
$update = json_decode(file_get_contents('php://input'));

if (isset($update->message)) {
    $message = $update->message;
    $chatId = $message->chat->id;
    $text = $message->text;

    if ($text === '/start') {
        $bot->handleStartCommand($chatId);
        return;
    }
    if ($text === '/add') {
        $bot->addHandlerCommand($chatId);
        return;
    }
}

if (isset($update->callback_query)) {
    $callbackQuery = $update->callback_query;
    $callbackData = $callbackQuery->data;
    $chatId = $callbackQuery->message->chat->id;
    $messageId = $callbackQuery->message->message_id;

    $bot->http->post('sendMessage', [
        'form_params' => [
            'chat_id' => $chatId,
            'text' => $callbackData,
        ]
    ]);
}
