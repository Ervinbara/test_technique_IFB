<?php
// Inclusion des classes
require_once 'TaskManager.php';

// Initialiser le gestionnaire de tâches
$taskManager = new TaskManager();

// Gestion des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_task'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $taskManager->addTask($title, $description);
    } elseif (isset($_POST['delete_task'])) {
        $taskId = $_POST['task_id'];
        $taskManager->deleteTask($taskId);
    } elseif (isset($_POST['update_status'])) {
        $taskId = $_POST['task_id'];
        $status = $_POST['status'];

        // S'assurer que le statut est bien un entier entre 0 et 2
        if (in_array($status, [0, 1, 2])) {
            $taskManager->updateTaskStatus($taskId, $status);
        }
    }
}

// Récupération des tâches pour affichage
$tasks = $taskManager->getTasks();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des tâches</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gestionnaire de Tâches</h1>
        
        <!-- Formulaire d'ajout de tâche -->
        <form action="" method="POST">
            <input type="text" name="title" placeholder="Titre de la tâche" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button class="add-btn" type="submit" name="add_task">Ajouter Tâche</button>
        </form>

        <!-- Affichage des tâches -->
        <ul class="task-list">
            <?php if (!empty($tasks)) : ?>
                <?php foreach ($tasks as $task): ?>
                    <li class="task">
                        <h3><?= htmlspecialchars($task->title); ?></h3>
                        <p><?= htmlspecialchars($task->description); ?></p>
                        <form action="" method="POST">
                            <input type="hidden" name="task_id" value="<?= $task->id; ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="0" <?= $task->status == 0 ? 'selected' : ''; ?>>À faire</option>
                                <option value="1" <?= $task->status == 1 ? 'selected' : ''; ?>>En cours</option>
                                <option value="2" <?= $task->status == 2 ? 'selected' : ''; ?>>Terminée</option>
                            </select>
                            <input type="hidden" name="update_status" value="1">
                        </form>
                        <form action="" method="POST">
                            <input type="hidden" name="task_id" value="<?= $task->id; ?>">
                            <button class="add" type="submit" name="delete_task">Supprimer</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <li>Aucune tâche n'est disponible pour l'instant.</li>
            <?php endif; ?>
        </ul>
    </div>

</body>
</html>
