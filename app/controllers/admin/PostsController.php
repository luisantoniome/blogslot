<?php
namespace App\Controllers\Admin;

class PostsController
{
  // admin/posts || admin/posts/index
  public function getIndex()
  {
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
    $query->execute();

    $posts = $query->fetchAll(\PDO::FETCH_ASSOC);

    return render('../views/admin/posts.php', ['posts' => $posts]);
  }

  // admin/posts/new
  public function getNew()
  {
    return render('../views/admin/create-post.php');
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

    return render('../views/admin/create-post.php', ['result' => $result]);
  }
}