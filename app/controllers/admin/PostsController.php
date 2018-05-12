<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PostsController extends BaseController
{
  // admin/posts || admin/posts/index
  public function getIndex()
  {
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
    $query->execute();

    $posts = $query->fetchAll(\PDO::FETCH_ASSOC);

    return $this->render('admin/posts.twig', ['posts' => $posts]);
  }

  // admin/posts/new
  public function getNew()
  {
    return $this->render('admin/create-post.twig');
  }

  public function postNew()
  {
    global $pdo;
    
    $query = "INSERT INTO posts (title, content) VALUES (:title, :content)";
    $preparedQuery = $pdo->prepare($query);
    $result = $preparedQuery->execute([
      'title' => $_POST['title'],
      'content' => $_POST['content'],
    ]);

    return $this->render('admin/create-post.twig', ['result' => $result]);
  }
}