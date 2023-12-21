<?php

class TodoController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getTodos() {
        return $this->model->getAllTodos();
    }
}

?>
