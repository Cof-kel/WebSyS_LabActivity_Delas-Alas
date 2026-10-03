<?php
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = trim($_POST['task_name'] ?? '');

    if (!empty($task_name)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (task_name) VALUES (:task_name)");
        $stmt->execute(['task_name' => $task_name]);
        header("Location: read.php?msg=Task created successfully");
        exit;
    } else {
        $error = "Task name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px; display: flex; justify-content: center; }
        .container { background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        a { text-decoration: none; color: #666; margin-left: 10px; font-size: 14px; }
        .error { color: #dc3545; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Task</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="create.php">
        <input type="text" name="task_name" placeholder="Enter task name..." required>
        <button type="submit">Save Task</button>
        <a href="read.php">Cancel</a>
    </form>
</div>

</body>
</html>