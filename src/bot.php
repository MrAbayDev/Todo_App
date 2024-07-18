<?php
//
//declare(strict_types=1);
//
//use GuzzleHttp\Client;
//
//class Bot
//{
//    const TOKEN = "7247419216:AAFhEMoTi5Two1IHqkn8EKsUZr0Q-7Sqz04";
//    const API = "https://api.telegram.org/bot" . self::TOKEN . "/";
//    public Client $http;
//    private PDO $pdo;
//
//    public function __construct()
//    {
//        $this->http = new Client(['base_uri' => self::API]);
//        $this->pdo = DB::connect();
//    }
//
//    public function handleStartCommand(int $chatId): void
//    {
//        $welcomeText = "Welcome to the best TODO App ever. You can use these commands to handle your tasks:\n";
//        $welcomeText .= "/add - to add a new task \n/all - to view all tasks\n";
//        $this->http->post('sendMessage', [
//            'form_params' => [
//                'chat_id' => $chatId,
//                'text' => $welcomeText,
//                'reply_markup' => json_encode([
//                    'inline_keyboard' => [
//                        [
//                            ['text' => 'Add new task', 'callback_data' => 'add'],
//                        ],
//                    ]
//                ])
//            ]
//        ]);
//    }
//
//    public function handleAddCommand(int $chatId): void
//    {
//        $status = 'add';
//        $stmt = $this->pdo->prepare("INSERT INTO tasks (chat_id, status) VALUES (:chat_id, :status)");
//        $stmt->bindParam(':chat_id', $chatId);
//        $stmt->bindParam(':status', $status);
//        $result = $stmt->execute();
//        if ($result) {
//            $this->http->post('sendMessage', [
//                'form_params' => [
//                    'chat_id' => $chatId,
//                    'text' => "Please, add your task"
//                ]
//            ]);
//        }
//    }
//
//    public function handleAllCommand(int $chatId): void
//    {
//        $query = "SELECT tasks.text, tasks.status FROM tasks
//                    JOIN users ON users.id = tasks.chat_id
//                    WHERE chat_id = :chatId";
//        $stmt = $this->pdo->prepare($query);
//        $stmt->bindParam(':chatId', $chatId);
//        $stmt->execute();
//        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        if ($tasks) {
//            $tasksText = "Here are your tasks:\n";
//            foreach ($tasks as $task) {
//                $status = $task['status'] ? '✅' : '❌';
//                $tasksText .= $status . " " . htmlspecialchars($task['text']) . "\n";
//            }
//            $this->http->post('sendMessage', [
//                'form_params' => [
//                    'chat_id' => $chatId,
//                    'text' => $tasksText
//                ]
//            ]);
//        } else {
//            $this->http->post('sendMessage', [
//                'form_params' => [
//                    'chat_id' => $chatId,
//                    'text' => "You have no tasks."
//                ]
//            ]);
//        }
//    }
//}
