<?php
    if( !isUserLoggedIn()){
        header("Location: /");
        exit;
      }

    $database = connectToDB();

    require "parts/header.php"
?>
    <div class="container my-5 mx-auto" style="max-width: 500px;">
        <h1>Edit Profile</h1>
        <form method = "POST" action="/profile/edit">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" 
                class="form-control" 
                id="name" 
                name="name"
                >
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" 
                class="form-control" 
                id="email"
                name="email" 
                >
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input type="password" 
                    class="form-control" 
                    id="password"
                    name="password" 
                    > 
            </div>
            <a href="/manage-profile-changepwd">Change password?</a> 

            <div class="pt-4 d-grid d-flex">
                <a href="/profile">
                    <button type="button" class="btn btn-primary me-2">Back</button>
                </a>
            
                <a href="/profile">
                    <button type="submit" class="btn btn-success">Update</button>
                </a>
            </div> 
        </form>
<?php
    require "parts/footer.php"
?>