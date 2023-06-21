<?php
  if(!isUserLoggedIn()){
    header("Location: /");
    exit;
  }


   $database = connectToDB();

   if(isset($_GET["id"])){
   $sql = "SELECT * FROM posts WHERE id = :id";
   $query = $database->prepare( $sql );
   $query->execute([
    'id' => $_GET['id']
   ]);

   // fetch
   $post = $query->fetch();

   if ( !$post ) {
    header("Location: /home");
    exit;
    }
  }else{
      header("Location: /home");
      exit;
  }
   
  require "parts/header.php";

?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_error.php";?>
        <form method="POST" action="/posts/edit" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="post-title"
              value="<?= $post['title'];?>"
              name="title"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea class="form-control" id="post-content" rows="10" name="content"><?=$post['content'];?></textarea>
          </div>
          <div class="mb-3">
            <label for="post-image" class="form-label">Image</label>
            <input type="file" name="image" id="post-image" />
            <?php if ( $post['image'] ) : ?>
              <input type="hidden" name="original_image" value="<?= $post['image']; ?>" />
              <p><img src="uploads/<?= $post['image']; ?>" width="150px" /></p>
            <?php endif; ?>
          </div>
          <div class="text-end">
          <input type="hidden" name="id" value="<?= $post['id']; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/home" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i>Back to Home</a
        >
      </div>
    </div>
<?php

require "parts/footer.php";