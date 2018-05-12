<?php
namespace App\Controllers;

use App\Models\Post;

class IndexController extends BaseController
{
  public function getIndex()
  {
    $posts = Post::query()->orderBy('id', 'desc')->get();

    return $this->render('index.twig', ['posts' => $posts]);
  }
}