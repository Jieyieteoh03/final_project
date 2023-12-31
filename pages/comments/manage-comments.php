<?php
  if( !isAdminOrEditor()){
    header("Location: /home");
    exit;
  }

$database = connectToDB();

$sql ="SELECT
comments.*,
users.name,
users.email
FROM comments
JOIN users
ON comments.user_id = users.id
JOIN posts
ON comments.post_id = posts.id";
$query = $database->prepare($sql);
$query -> execute();

//fetch
$comments = $query->fetchAll();



require "parts/header.php"

?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <?php require "parts/message_success.php"?>
    <div class="d-flex justify-content-between align-items-center mb-2">
    <h1 class="h1 text-light">Manage Comments</h1>
    </div>
    <div class="card mb-2 p-4">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col" style="width: 10%;">Title</th>
            <th scope="col">Created By</th>
            <th scope="col">Email</th>
            <th scope="col" class="text-end">Actions</th>
        </tr>
        </thead>
        <tbody>
            <!-- display out all the posts using foreach -->
            <?php foreach ($comments as $comment) { ?>
                <tr class="<?php
                if ( 
                    isset( $_SESSION['new_comment'] ) && 
                    $_SESSION['new_comment'] == $comment['title'] ) {
                    echo "table-success";
                    unset( $_SESSION['new_comment'] );
                }
                ?>">
                <th scope="row"><?= $comment['id']; ?></th>
                <td><?= $comment['id']; ?></td>
                <td><?= $comment['name']; ?></td>
                <td><?=$comment['email'];?> </td>
                
                <td class="text-end">
                <div class="buttons">
                    <!-- Comment button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#comment-modal-<?= $comment['id']; ?>">
                    <i class="bi bi-eye"></i
                    >
                    </button>

                    <!-- Comment: Modal -->
                    <div class="modal fade" id="comment-modal-<?= $comment['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $comment['comments']; ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div> 
                    </div>
                    </div>
                    <!-- Delete button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $comment['id']; ?>">
                    <i class="bi bi-trash"></i
                    >
                    </button>

                        <!-- Delete modal -->
                        <div class="modal fade" id="delete-modal-<?= $comment['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this comment: <?= $comment['comments']; ?>?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                You're currently deleting <?= $comment['comments']; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- 
                                Delete Form 
                                1. add action
                                2. add method
                                3. add input hidden field for id
                                -->
                                <form method= "POST" action="/comments/delete">
                                <input type="hidden" name="id" value= "<?= $comment['id']; ?>" />
                                <button type="submit" class="btn btn-danger">Yes, please delete</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <div class="text-center">
    <a href="/dashboard" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
    >
    </div>
</div>
<?php
require "parts/footer.php";
?>