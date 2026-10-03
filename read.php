<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM tasks ORDER BY id DESC");
$tasks = $stmt->fetchAll();

$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Read</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px; display: flex; justify-content: center; }
        .container { background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { margin-top: 0; color: #333; }
        .btn { padding: 8px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; color: white; display: inline-block; }
        .btn-add { background-color: #28a745; margin-bottom: 15px; }
        .btn-edit { background-color: #ffc107; color: #333; }
        .btn-delete { background-color: #dc3545; }
        .alert { background-color: #e2f0d9; color: #2e6b27; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        ul { list-style: none; padding: 0; margin: 0; }
        li { padding: 12px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .actions { display: flex; gap: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Task Manager</h2>

    <?php if ($msg): ?>
        <div class="alert"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <a href="create.php" class="btn btn-add">+ Add New Task</a>

    <ul>
        <?php if (count($tasks) > 0): ?>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <span><?= htmlspecialchars($task['task_name']) ?></span>
                    <div class="actions">
                        <a href="update.php?id=<?= $task['id'] ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $task['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No tasks found.</li>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>