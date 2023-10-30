<?php
require_once(__DIR__ . '/../models/Todo.php');

class TodoController
{
  public function index()
  {
    $todoModel = new Todo();
    $todos = $todoModel->getAllTodos();
    include(__DIR__ . '/../views/index.php');
  }

  public function create()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $activity = $_POST['activity'];
  
          $todoModel = new Todo();
  
          if ($todoModel->isActivityUnique($activity)) {
              $todoModel->createTodo($activity);
              echo '<script>showSuccessAlert("Data berhasil ditambahkan.");</script>';
          } else {
              echo '<script>showErrorAlert("Aktivitas sudah ada dalam daftar.");</script>';
          }
      }
  
      header('Location: index.php');
  }
  
  public function update()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $id = $_POST['id'];
          $activity = $_POST['activity'];
  
          $todoModel = new Todo();
  
          if ($todoModel->isActivityUnique($activity, $id)) {
              $status = $_POST['status'];
              $todoModel->updateTodo($id, $activity, $status);
              echo '<script>showSuccessAlert("Data berhasil diperbarui.");</script>';
          } else {
              echo '<script>showErrorAlert("Aktivitas sudah ada dalam daftar.");</script>';
          }
      }
  
      header('Location: index.php');
  }  
  

  public function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $id = $_GET['id'];

      $todoModel = new Todo();
      $todoModel->deleteTodo($id);
    }

    header('Location: index.php');
  }
}