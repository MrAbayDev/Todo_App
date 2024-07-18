<?php
require "vendor/autoload.php";
require "database.php";
require "Task.php";

date_default_timezone_set('Asia/Tashkent');

$update = json_decode(file_get_contents('php://input'));

if (isset($update)) {
    require 'bot.php';
    return;
}
if (count($_GET) > 0 || count($_POST) > 0) {
    $task = new Task();

    if (isset($_POST['text'])) {
        $task->add($_POST['text']);
    }

    if (isset($_GET['complete'])) {
        $task->complete((int)$_GET['complete']);
    }

    if (isset($_GET['uncompleted'])) {
        $task->uncompleted((int)$_GET['uncompleted']);
    }

    if (isset($_GET['delete'])) {
        $task->delete((int)$_GET['delete']);
    }
}

require 'view/home.php';
