<?php

  require_once 'config.php';
  $query = $pdo->prepare('SELECT * FROM posts ORDER BY id DESC');
  $query->execute();

  $posts = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blogslot</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Blogslot</h1>
      </div>
    </div>
    <div class="row">
      <main class="col">
        <?php foreach ($posts as $post) : ?>
          <div class="blog-post">
            <h2 class="display-4"><?= $post['title']; ?></h2>
            <p class="font-weight-light text-secondary">
              May 9, 2018 by <a href="#">Kate Austen</a>
            </p>
            <div class="blog-post-image">
              <img src="https://source.unsplash.com/random/1920x500" class="img-fluid" alt="">
            </div>
            <div class="blog-post-content mt-3">
              <p><?= $post['content'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </main>
      <aside class="col-lg-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia magni obcaecati facilis et, molestiae iste harum aperiam qui atque mollitia laboriosam! Non iste, eos mollitia in sapiente voluptates qui soluta?</aside>
    </div>
  </div>
  <footer class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col">
          <p>&copy; Blogslot</p>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>