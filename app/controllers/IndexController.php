<?php
namespace App\Controllers;

class IndexController
{
  public function getIndex()
  {
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
    $query->execute();

    $posts = $query->fetchAll(\PDO::FETCH_ASSOC);

    return render('../views/index.php', ['posts' => $posts]);
  }
}