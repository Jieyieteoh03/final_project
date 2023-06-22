<?php
   if ( !isUserLoggedIn()  ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
  }

  $database = connectToDB();

  $sql = "SELECT * FROM posts";
  $query = $database->prepare( $sql );
  $query->execute();
  // fetch
  $posts = $query->fetchAll();

  require "parts/header.php";
  require "parts/navbar.php";
?>
  <div class="container mx-auto my-5" style="max-width: 500px;">
    <?php require "parts/message_error.php"; ?>
    <?php require "parts/message_success.php"; ?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="/manage-posts-add">
        <button class="btn btn-primary me-md-2 mb-3" type="button">Add new post</button>
      </a>
    </div>

    <?php foreach ($posts as $post) : ?>
    <div class="card mb-4">
      <?php if($_SESSION["user"]["id"] === $post["user_id"]) : ?>
        <div class="card-header text-end">
        <!-- Setting -->
          <div class="settings">
            <button 
              type="button" 
              class="btn btn-outline-secondary dropdown-toggle" 
              data-bs-toggle="dropdown" 
              aria-expanded="false">
              <i class="bi bi-gear"></i>
            </button>
            <ul class="dropdown-menu">
              <li>
                <a href="/manage-posts-edit?id=<?=$post['id'];?>">
                  <button class="dropdown-item" type="button">Edit post</button>
                </a>
              </li>
              <li>
                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $post['id']; ?>">
                  Delete post
                </button>
              </li>
            </ul>
          </div>
        </div>
      <?php endif; ?>
      <div class="post-content px-3">
        <!-- <h4 class="h4 mb-4 text-start"><?= $_SESSION["user"]["name"]; ?></h4> -->
        <h1 class="h1 mb-4 text-start"><?=$post['title']; ?></h1>
        <p><?= $post['content']; ?></p>
        <?php if ( $post['image'] ) : ?>
        <div class="text-center">
            <img src="uploads/<?= $post['image']; ?>" class="img-fluid" style="max-width: 300px;"/>
        </div>
        <?php endif; ?>
      </div>

      <div class="comment">
        <div class="card-footer border-0">
          <h5>Comment</h5>
        </div>
        <div class="card-footer m-2 overflow-y-scroll" style="height: 200px;">
            <?php
              $sql ="SELECT
              comments.*,
              users.name
              FROM comments
              JOIN users
              ON comments.user_id = users.id
              JOIN posts
              ON comments.post_id = posts.id
              WHERE comments.post_id = :post_id";
              $query = $database->prepare($sql);
              $query -> execute([
                "post_id" => $post['id']
              ]);
              $comments = $query->fetchAll();


              foreach ($comments as $comment) :
            ?>
            <div class="card mt-2 <?php echo ( $comment["user_id"] === $_SESSION['user']['id'] ? "bg-secondary-subtle" : '' ); ?>">
                <div class="card-body">
                    <p class="card-text"><?= $comment['comments']; ?></p>
                    <p class="card-text"><small class="text-muted" style="font-size: 10px;" >Commented By <?= $comment['name']; ?></small></p>
                    <a href="/replies?id=<?= $comment['id'] ?>">
                      <button type="button" class="btn btn-primary">
                        Reply
                      </button>
                    </a>
                </div>
                <?php
                if($_SESSION["user"]["id"] === $comment["user_id"]) : ?>
                  <div class="delete text-end">
                    <!-- Delete comment button -->
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete-comment-modal-<?= $comment['id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>

                    <!-- Delete comment modal -->
                    <div class="modal fade" id="delete-comment-modal-<?= $comment['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this comment?</h1>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <!-- 
                              Delete Form 
                              1. add action
                              2. add method
                              3. add input hidden field for id
                              -->
                              <form method= "POST" action="/home/comment-delete">
                                <input type="hidden" name="id" value= "<?= $comment['id']; ?>" />
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php endif; ?>
            </div>
            <?php endforeach; ?>

        </div>
        <div class="mx-3">

          <form
            action="/comments/add"
            method="POST">
            <div class="mt-3">
              <textarea class="form-control" id="comments" rows="3" name="comments"></textarea>
            </div>
            <input type="hidden" name="post_id" value="<?= $post['id']; ?>" />
            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>" />
            <button type="submit" class="btn btn-primary my-2">Post</button>
          </form>

        </div>
      </div>
    

   
      
      <!-- Delete modal -->
      <div class="modal fade" id="delete-modal-<?= $post['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this post?</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- 
                Delete Form 
                1. add action
                2. add method
                3. add input hidden field for id
                -->
                <form method= "POST" action="/home/post-delete">
                  <input type="hidden" name="id" value= "<?= $post['id']; ?>" />
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    
  </div>
      
<?php
  require "parts/footer.php";
?>


  