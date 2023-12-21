<?php
include_once("edit-todoModel.php");

$model = new TodoModel();

if (empty($_GET['id'])) {
    header('Location: index.php?error=Select at least one todo');
    exit();
}

$todo = $model->getTodoById($_GET['id']);

if (!$todo) {
    header('Location: index.php?error=Todo not found');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edited') {
    $model->updateTodo($_POST['id'], $_POST['title']);
    header('Location: index.php?success=Todo updated successfully');
    exit();
    
}
?>


<?php include_once("edit-todo.php"); ?>
