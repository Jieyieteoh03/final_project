<?php
    $database = connectToDB();

    $sql = "SELECT * FROM posts";
    $query = $database->prepare( $sql );
    $query->execute();
    // fetch
    $posts = $query->fetchAll();
  

    require "parts/header.php";
    require "parts/navbar.php"
?>
     <div class="container mx-auto my-5" style="max-width: 500px;">
      <?php foreach ($posts as $post) : ?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?= $post['title']; ?></h5>
          <p class="card-text"><?php 
            $excerpt = str_split( $post['content'], 100 );
            echo $excerpt[0]; ?>
            ...
          </p>
          <div class="text-end">
            <a href="/login" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

<?php
    require "parts/footer.php";
?>