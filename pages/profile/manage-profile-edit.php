<?php
    if( !isUserLoggedIn()){
        header("Location: /");
        exit;
      }

    $database = connectToDB();

    $sql = "SELECT * FROM users WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
    'id' => $_SESSION['user']['id']
    ]);

    // fetch
    $user = $query->fetch();

    require "parts/header.php"
?>
    <div class="container my-5 mx-auto" style="max-width: 500px;">
    <?php require "parts/message_error.php"?>
    <?php require "parts/message_success.php"?>
    <form method = "POST" action="/profile/edit" enctype="multipart/form-data">
        <div class="card p-4">
            <h1 class="pb-4">Edit Profile</h1>

                <label for="post-image" class="form-label">Image</label>
                <input type="file" name="image" id="image" />
                <?php if ( $user['image'] ) : ?>
                    <input type="hidden" name="profile_image" value="<?= $user['image']; ?>" />
                    <p><img src="uploads-profile/<?= $user['image']; ?>" width="150px" /></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" 
                    class="form-control" 
                    id="name" 
                    name="name"
                    value="<?= $user['name'] ?>"
                    >
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" 
                    class="form-control" 
                    id="email"
                    name="email" 
                    value="<?= $user['email'] ?>"
                    >
                </div>

                <a href="/manage-profile-changepwd">Change password?</a> 
        
        </div>
        <div class="pt-4 d-grid d-flex">
            <a href="/profile" class="btn btn-primary me-2">
                Back
            </a>
        
                <input type="hidden" name="id" value= "<?= $_SESSION["user"]["id"]; ?>" />
                <button type="submit" class="btn btn-success">Update</button>
        </div> 
    </form>
    </div>
<?php
    require "parts/footer.php"
?>