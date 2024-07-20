<?php

declare(strict_types=1);

class Task
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function add(string $text): bool
    {
        $status = false;
        $stmt   = $this->pdo->prepare("INSERT INTO tasks (text, status) VALUES (:text, :status)");
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }


    public function getAll(): false|array
    {
        return $this->pdo->query("SELECT * FROM tasks")->fetchAll();
    }

    public function complete(int $id): bool
    {
        $status = true;
        $stmt   = $this->pdo->prepare("UPDATE tasks SET status=:status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }


    public function uncompleted(int $id): bool
    {
        $status = false;
        $stmt   = $this->pdo->prepare("UPDATE tasks SET status=:status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }


    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}