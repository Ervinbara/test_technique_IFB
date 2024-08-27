<?php

require_once 'Database.php';
require_once 'Task.php';

class TaskManager {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    // Créer une nouvelle tâche
    public function addTask($title, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
        $stmt->execute(['title' => $title, 'description' => $description]);
    }

    // Supprimer une tâche
    public function deleteTask($taskId) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $taskId]);
    }

    // Mettre à jour le statut d'une tâche
    public function updateTaskStatus($taskId, $status) {
        $stmt = $this->pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        $stmt->execute(['status' => $status, 'id' => $taskId]);
    }

    // Récupérer toutes les tâches
    public function getTasks() {
        $stmt = $this->pdo->query("SELECT * FROM tasks");
        $tasks = [];
        while ($row = $stmt->fetch()) {
            $tasks[] = new Task($row['id'], $row['title'], $row['description'], $row['status']);
        }
        return $tasks;
    }
}
