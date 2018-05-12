<?php
namespace App\Controllers;

class IndexController extends BaseController
{
  public function getIndex()
  {
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
    $query->execute();

    $posts = $query->fetchAll(\PDO::FETCH_ASSOC);

    return $this->render('index.twig', ['posts' => $posts]);
  }
}