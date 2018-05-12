<?php
namespace App\Controllers\Admin;

use App\Models\Post;
use App\Controllers\BaseController;

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
    $post = new Post([
      'title' => $_POST['title'],
      'content' => $_POST['content'],
    ]);

    $post->save();

    $result = true;

    return $this->render('admin/create-post.twig', ['result' => $result]);
  }
}