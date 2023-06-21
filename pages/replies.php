<?php
  if( !isUserLoggedIn()){
    header("Location: /");
    exit;
  }
    
    $database = connectToDB();

    if(isset($_GET["id"])){
    $sql = "SELECT * FROM comments WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
    'id' => $_GET['id']
    ]);

    // fetch
    $comment = $query->fetch();
    

    if ( !$comment ) {
    header("Location: /");
    exit;
    }

    }else{
    header("Location: /");
    exit;
    }

    require "parts/header.php"
?>

  <div class="container mx-auto my-5" style="max-width: 500px;">
        <h1 class="h1 mb-4 text-center">Comment</h1>
        <p><?= $comment['comments']; ?></p>
        <!-- reply -->
        <div class="mt-3">
            <h4>Reply</h4>
            <?php
                $sql ="SELECT
                replies.*,
                users.name
                FROM replies
                JOIN users
                ON replies.user_id = users.id
                JOIN posts
                ON replies.post_id = posts.id
                JOIN comments
                ON replies.comment_id = comments.id
                WHERE replies.comment_id = :comment_id";

              $query = $database->prepare($sql);
              $query -> execute([
                "comment_id" => $comment['id']
              ]);
              $replies= $query->fetchAll();


              foreach ($replies as $reply) :
            ?>
            <div class="card mt-2 <?php echo ( $reply["user_id"] === $_SESSION['user']['id'] ? "bg-secondary-subtle" : '' ); ?>">
              <?php require "parts/message_error.php"; ?>
                <div class="card-body">
                    <p class="card-text"><?= $reply['reply']; ?></p>
                    <p class="card-text"><small class="text-muted" style="font-size: 10px;" >Reply by <?= $reply['name']; ?></small></p>
                </div>
                <?php
                if($_SESSION["user"]["id"] === $reply["user_id"]) : ?>
                  <div class="delete text-end">
                    <!-- Delete comment button -->
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete-comment-modal-<?= $reply['id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>

                    <!-- Delete comment modal -->
                    <div class="modal fade" id="delete-comment-modal-<?= $reply['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this reply?</h1>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <!-- 
                              Delete Form 
                              1. add action
                              2. add method
                              3. add input hidden field for id
                              -->
                              <form method= "POST" action="/home/replies-delete">
                                <input type="hidden" name="id" value= "<?= $reply['id']; ?>" />
                                <input type="hidden" name="comment_id" value= "<?= $comment['id']; ?>" />
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
            action="/replies/add"
            method="POST">
            <div class="mt-3">
              <textarea class="form-control" id="replies" rows="3" name="replies"></textarea>
            </div>
            <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>" />
            <input type="hidden" name="post_id" value="<?= $comment['post_id']; ?>" />
            <button type="submit" class="btn btn-primary my-2">Post</button>
          </form>

        </div>

        <div class="text-center mt-3">
            <a href="/home" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back</a
            >
        </div>
    </div>

<?php
    require "parts/footer.php"
?>

