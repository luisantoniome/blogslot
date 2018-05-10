<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../config.php';

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

$route = $_GET['route'] ?? '/';

function render($fileName, $params = []) {
  ob_start();

  extract($params);
  include $fileName;
  
  return ob_get_clean();
}

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

$router->get('/admin', function () {
  return render('../views/admin/index.php');
});

$router->get('/admin/posts', function () use ($pdo) {
  $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
  $query->execute();

  $posts = $query->fetchAll(PDO::FETCH_ASSOC);

  return render('../views/admin/posts.php', ['posts' => $posts]);
});

$router->get('/admin/posts/new', function () {
  return render('../views/admin/create-post.php');
});

$router->post('/admin/posts/new', function () use ($pdo) {
  $query = "INSERT INTO posts (title, content) VALUES (:title, :content)";
  $preparedQuery = $pdo->prepare($query);
  $result = $preparedQuery->execute([
    'title' => $_POST['title'],
    'content' => $_POST['content'],
  ]);

  return render('../views/admin/create-post.php', ['result' => $result]);
});

$router->get('/', function () use ($pdo) {
  $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
  $query->execute();

  $posts = $query->fetchAll(PDO::FETCH_ASSOC);

  return render('../views/index.php', ['posts' => $posts]);
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;