<?php

include_once("config.php");
include_once("database.php");
include_once("process.php");
include_once("indexController.php");
include_once("indexModel.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

$model = new TodoModel($db);
$controller = new TodoController($model);
$todos = $controller->getTodos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
* {
  margin: 0;
  box-sizing: border-box;
}

body {
  background: url('IMG_9880.JPG') center/cover;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Roboto', sans-serif;
  color: #fff;
}

.todo-form,
.todo-table {
  background: rgba(66, 43, 107, 0.9);
  border-radius: 20px;
  padding: 2em;
  position: relative;
  width: clamp(450px, 80vw, 850px);
}

.todo-form input {
  font-size: 1.5em;
  line-height: 1.6em;
  padding: 15px;
  border: none;
  border-radius: 20px;
  width: 100%;
  outline: none;
  margin-top: 1em;
  background: rgba(66, 43, 107, 0.9);
}

.todo-form button {
  font-size: 1.5em;
  line-height: 1.5em;
  padding: 10px 20px;
  border: none;
  border-radius: 20px;
  background: #3D39AA;
  color: #EAEAEA;
  position: absolute;
  right: 1em;
  margin-top: 7px;
  outline: none;
  cursor: pointer;
}

/* Table */

.todo-table h1 {
  font-family: 'Roboto';
  font-weight: bold;
  font-size: 2em;
  line-height: 1.2em;
  color: #fff;
}

.todo-table small {
  font-family: 'Roboto';
  font-weight: bold;
  font-size: 1em;
  line-height: 1.1em;
  color: #ddd;
}

.todo-table table {
  border-spacing: 0;
  margin-top: 1em;
  width: 100%;
  background-color: rgba(66, 43, 107, 0.8);
  border-radius: 20px;
}

.todo-table thead tr {
  background: #3D39AA;
  font-family: Inter;
  font-weight: bold;
  font-size: 14px;
  line-height: 18px;
  color: #FFFFFF;
  height: 40px;
}

.todo-table thead tr th:first-child {
  border-radius: 10px 0 0 0;
}

.todo-table thead tr th:nth-child(2) {
  text-align: left;
}

.todo-table thead tr th:last-child {
  border-radius: 0 10px 0 0;
}

.todo-table tbody tr {
  font-family: Inter;
  font-size: 14px;
  line-height: 18px;
  height: 40px;
}

.todo-table tbody tr td:first-child {
  text-align: center;
  padding: 5px;
}

.todo-table tbody tr td:last-child {
  text-align: center;
  padding: 5px;
}

.todo-table tbody tr:nth-child(even) {
  background: #F0F0F0;
}

.todo-table tbody tr:last-child td:first-child {
  border-radius: 0 0 0 10px;
}

.todo-table tbody tr:last-child td:last-child {
  border-radius: 0 0 10px 0;
}

.todo-table tbody tr.complete {
  background-color: rgb(188, 255, 182);
  text-decoration: line-through;
}


.hide-modal {
    display: none;
    visibility: hidden;
}

.confirm-modal {
    position: fixed;
    background-color: rgba(255, 255, 255, 0.803);
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-container {
    background-color: rgb(255, 255, 255);
    padding: 20px;
    border-radius: 5px;
    width: clamp(400px, 50vw ,500px);
    box-shadow: 2px 2px 4px;
}

.modal-container h4 {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.modal-container h4 img {
    width: 80px;
    padding: 15px;
}

.modal-container h4 span {
    font-size: 1.5em;
}

.btns {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
    margin-top: 25px;
}

.btns button {
    padding: 10px 15px;
    border: none;
    outline: none;
    box-shadow: 2px 2px 2px gray;
    cursor: pointer;
}

.btns button:nth-child(1) {
    background-color: rgb(168, 16, 16);
    color: white;
    font-weight: bold;
}

.btns button:nth-child(2) {
    background-color: rgb(53, 53, 53);
    color: white;
    font-weight: bold;
}

.btn  {
    margin-top: .2em;
    padding: .5em 1em;
    
    outline: none;
    cursor: pointer;
    text-decoration: none;
    border-radius: 200px;
    font-size: .8rem;
    border: none;
}

.complete td:last-child {
    text-decoration: none;
}

.btn-primary {
    background-color: #252525;
    color: rgb(255, 255, 255);
}

.btn-danger {
    background-color: #a51010;
    color: rgb(255, 255, 255);
}

.btn-success {
    background-color: #008a3e;
    color: rgb(255, 255, 255);
}

.btn-secondary {
    background-color: #006da0;
    color: rgb(255, 255, 255);
}

.btn-orange {
    background-color: #a04000;
    color: rgb(255, 255, 255);
}

.btn-purple {
    background-color: #7b00ce;
    color: rgb(255, 255, 255);
}

.btn-holder {
    margin-top: 1em;
}

.form-elements input{
    font-size: 25px;
    line-height: 29px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    width: 100%;
    outline: none;
    margin-top: 1em;
    margin-bottom: 1em;
}

</style>
</head>
<body>
    <div class="container">
        <form action="process.php" method='POST'>
            <div class="todo-table">
                <h1>Ma CheckList</h1>
                <h6> <?php
                        $sql = "SELECT * FROM todos";
                        $result = mysqli_query($db, $sql);
                        $todos = mysqli_fetch_all($result);
                        $total = count($todos);
                        $complete = 0;
                        foreach ($todos as $todo) {

                            if($todo[2] == true){
                                $complete++;
                            }
                        }
                        echo $total." tâches au total, ".$complete." tâches compléter, ".($total-$complete)." tâches en attente. ";
                        ?>
                        </h6>
                <div class="btn-holder">
                    <a href="/add-todo.php" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter une nouvelle tâche</a>
                    <button name="action" value="edit" class="btn btn-secondary"><i class="fa fa-edit"></i> Modifier une tâche</button>
                    <button name="action" value="delete" class="btn btn-danger"><i class="fa fa-times"></i> Supprimer une tâche</button>
                    <button name="action" value="complete" class="btn btn-purple"><i class="fa fa-thumbs-up"></i> Tâche Accompli </button>
                    <button name="action" value="pending" class="btn btn-orange"><i class="fa fa-thumbs-down"></i> Tâche en attente </button>
                </div>
                <p style = "margin-top : 10px">
                <?php if(!empty($_GET['error'])) echo "Error : ".$_GET['error']; ?>
                <?php if(!empty($_GET['success'])) echo "Success : ".$_GET['success']; ?>
                    
                </p>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th> Mes tâches</th>
                            <th> Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    
                        foreach ($todos as $todo) {
                        
                        ?>
                        <tr class = "<?php echo  $todo['2']?'complete':''; ?>">
                            <td><input type="radio" required name="todo" value="<?php echo $todo[0]; ?>" id=""></td>
                            <td><?php echo  $todo['1']; ?></td>
                            <td><?php echo  $todo['2']?'Accompli':'En attente'; ?></td>
                        </tr>
                        <?php } ?>
                        

                    </tbody>
                </table>
            </div>
        </form>
    </div>
</body>
</html>
