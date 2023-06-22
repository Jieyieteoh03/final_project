<?php
    if( !isUserLoggedIn()){
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    // load the user data based on the id
    $sql = "SELECT * FROM users WHERE id = :id ";
    $query = $database->prepare( $sql );
    $query->execute([
        'id' => $_SESSION['user']['id']
    ]);

    // fetch
    $user = $query->fetch();

    require "parts/header.php"
?>
    
    <div class="container my-5 mx-auto" style="max-width: 500px;">
    <?php require "parts/message_error.php"; ?>
    <?php require "parts/message_success.php"; ?>
    <div class="text-end">
        <a href="/manage-profile-edit">
            <button type="button" class="btn btn-primary ms-3 mb-3">
                Edit profile
            </button>
        </a>
    </div>


    <div class="card p-4">
        <h1 class="pb-4">User Profile</h1>

        <?php if ( $user['image'] ) : ?>
            <div class="text-start">
                <img src="uploads-profile/<?= $user['image']; ?>" class="img-fluid rounded-circle" style="width: 200px; height: 200px;"/>
            </div>
        <?php endif; ?>

        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <div class="d-flex col-12">
                <input type="email" 
                class="form-control d-flex" 
                id="exampleFormControlInput1" 
                placeholder="<?= $user['name'] ?>"
                disabled readonly>
            </div>    
            
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <div class="d-flex">
                <input type="email" 
                class="form-control d-flex" 
                id="exampleFormControlInput1" 
                placeholder="<?= $user['email'] ?>"
                disabled readonly>
            </div>    
        </div>
        
        <div class="text-center">
            <a href="/home" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left pe-2"></i>Back</a
            >
        </div>
    </div>
<?php
    require "parts/footer.php"
?>