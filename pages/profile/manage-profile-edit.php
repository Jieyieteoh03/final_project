<?php
    if( !isUserLoggedIn()){
        header("Location: /");
        exit;
      }

    $database = connectToDB();

    // $sql = "SELECT 
    // users.* ,
    // users.name,
    // users.email
    // FROM users
    // JOIN users
    // ON posts.user_id = users.id";
    // $query = $database->prepare( $sql );
    // $query->execute();

    // // fetch
    // $posts = $query->fetch();

    require "parts/header.php"
?>
    <div class="container my-5 mx-auto" style="max-width: 500px;">
        <h1>Edit Profile</h1>
        <form method = "POST" action="/profile/edit">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" 
                class="form-control" 
                id="username" 
                name="username"
                placeholder="<?= $_SESSION['user']['name']?>"
                >
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" 
                class="form-control" 
                id="email"
                name="email" 
                placeholder="<?= $_SESSION['user']['name']?>"
                >
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Bio</label>
                    <textarea 
                        class="form-control" 
                        id="exampleFormControlTextarea1" 
                        rows="3">
                    </textarea>      
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input type="password" 
                    class="form-control" 
                    id="password"
                    name="password" 
                    placeholder=""
                    > 

                    <a href="/manage-profile-changepwd">Change password?</a> 
            </div>

            <div class="pt-4 d-grid">
                <a href="/profile">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </a>
            </div> 
        </form>
<?php
    require "parts/footer.php"
?>