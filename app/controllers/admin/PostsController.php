<?php
namespace App\Controllers\Admin;

use App\Models\Post;
use App\Controllers\BaseController;
use Sirius\Validation\Validator;

class PostsController extends BaseController
{
  // admin/posts || admin/posts/index
  public function getIndex()
  {
    $posts = Post::all();

    return $this->render('admin/posts.twig', ['posts' => $posts]);
  }

  // admin/posts/new
  public function getNew()
  {
    return $this->render('admin/create-post.twig');
  }

  public function postNew()
  {
    $errors = [];
    $result = false;

    $validator = new Validator();
    $validator->add('title', 'required');
    $validator->add('content', 'required');

    if ($validator->validate($_POST)) {
      $post = new Post([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
      ]);
  
      $post->save();
  
      $result = true;
    } else {
      $errors = $validator->getMessages();
    }

    return $this->render('admin/create-post.twig', [
      'result' => $result,
      'errors' => $errors
    ]);
  }
}