<?php
    if( !isUserLoggedIn()){
        header("Location: /");
        exit;
    }

    require "parts/header.php"
?>
    
    <div class="container my-5 mx-auto" style="max-width: 500px;">
        <div class="text-end">
            <a href="/manage-profile-edit">
                <button type="button" class="btn btn-primary ms-3">
                    Edit profile
                </button>
            </a>
        </div>
        <h1>User Profile</h1>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <div class="d-flex col-12">
                <input type="email" 
                class="form-control d-flex" 
                id="exampleFormControlInput1" 
                placeholder="<?= $_SESSION['user']['name']?>"
                disabled readonly>
            </div>    

        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <div class="d-flex">
                <input type="email" 
                class="form-control d-flex" 
                id="exampleFormControlInput1" 
                placeholder="<?= $_SESSION['user']['email']?>"
                disabled readonly>
            </div>    
        </div>

        <div class="text-center">
            <a href="/home" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left pe-2"></i>Back</a
            >
      </div>
<?php
    require "parts/footer.php"
?>