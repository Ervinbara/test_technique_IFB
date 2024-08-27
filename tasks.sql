CREATE DATABASE todo_list;

USE todo_list;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status INT DEFAULT 0
);

-- Insertion de données de tests
INSERT INTO tasks (title, description, status) VALUES 
('Tâche 1', 'Description de la tâche 1', 0),
('Tâche 2', 'Description de la tâche 2', 1),
('Tâche 3', 'Description de la tâche 3', 2);
